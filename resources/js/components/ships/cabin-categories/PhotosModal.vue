<script setup>
import {nextTick, reactive, ref} from "vue";
import {Modal} from 'flowbite';
import draggable from 'vuedraggable'
import {useImagePreview} from '@/composable/useImagePreview'
import PhotoItem from './PhotoItem.vue'

const {compressImage} = useImagePreview();

const emit = defineEmits(['change'])

const isVisible = ref(false)
const modalRef = ref()

let form, modal

const open = (data) => {
    data = JSON.parse(JSON.stringify(data))

    data.photos = data.photos ? data.photos.map(url => ({url})) : []

    form = reactive(data)

    nextTick(() => {
        modal = new Modal(modalRef.value, {
            onShow: () => isVisible.value = true,
            onHide: () => isVisible.value = false,
        });
        modal.show()
    })
}

const save = () => {
    form.photos = form.photos.map(o => o.url)
    emit('change', form)
    close()
}

const close = () => {
    modal.hide()
}

const removePhoto = (index) => {
    form.photos.splice(index, 1)
}

const upload = (event) => {
    const files = event.dataTransfer ? [...event.dataTransfer.files] : [...event.target.files]

    files.forEach((file) => {
        const reader = new FileReader();
        reader.onload = async (e) => {
            if (!form.photos) {
                form.photos = []
            }

            const compressedImage = await compressImage(e.target.result, 300, 300, 0.8)

            form.photos.push({
                url: compressedImage,
                file: file
            })
        };
        reader.readAsDataURL(file);
    })
};

const changeImage = (index, url) => {
    form.photos[index] = {url}
}

defineExpose({
    open
})
</script>

<template>
    <div ref="modalRef"
         tabindex="-1"
         class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div v-if="isVisible" class="relative w-full max-w-4xl max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                        Фотографии
                    </h3>
                    <button @click="close"
                            type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="p-4 md:p-5 space-y-4">
                    <div class="flex items-center justify-center w-full">
                        <label
                            @drag.prevent.stop=""
                            @dragstart.prevent.stop=""
                            @dragend.prevent.stop=""
                            @dragover.prevent.stop=""
                            @dragenter.prevent.stop=""
                            @dragleave.prevent.stop=""
                            @drop.prevent.stop="upload($event)"
                            for="dropzone-file"
                            class="flex flex-col items-center justify-center w-full h-36 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Нажмите, чтобы загрузить, или перетащите</span>
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG или GIF</p>
                            </div>
                            <input @change="upload" id="dropzone-file" type="file" multiple class="hidden"
                                   accept="image/png,image/jpeg,image/gif"/>
                        </label>
                    </div>
                    <draggable
                        v-if="form.photos?.length"
                        v-model="form.photos"
                        group="photos"
                        class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <template #item="{element, index}">
                            <photo-item :element="element"
                                        :index="index"
                                        @remove="removePhoto"
                                        @changeImage="changeImage"/>
                        </template>
                    </draggable>
                </div>
                <div
                    class="flex items-center p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button @click="save"
                            type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Сохранить
                    </button>
                    <button @click="close"
                            type="button"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        Отмена
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
