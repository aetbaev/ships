<script setup>
import {ref} from "vue"
import draggable from 'vuedraggable'
import Item from "./Item.vue"
import {useImagePreview} from '@/composable/useImagePreview'

const {compressImage} = useImagePreview()

const props = defineProps(['items'])

const items = ref(JSON.parse(JSON.stringify(props.items)))

const remove = (id) => {
    const index = items.value.findIndex(o => o.id.toString() === id.toString())
    if (index !== -1) {
        items.value.splice(index, 1)
    }
}

const upload = (event) => {
    const files = event.dataTransfer ? [...event.dataTransfer.files] : [...event.target.files]

    files.forEach((file) => {
        const reader = new FileReader();
        reader.onload = async (e) => {
            const imageId = '_' + Date.now().toString()
            const compressedImage = await compressImage(e.target.result, 200, 200, 0.8)

            items.value.push({
                id: imageId,
                title: '',
                url: compressedImage,
                file: file
            });
        };
        reader.readAsDataURL(file)
    })
};

const changeImage = (id, url) => {
    const index = items.value.findIndex(o => o.id.toString() === id.toString())

    if (index !== -1) {
        items.value[index].url = url
        items.value[index].file = null
    }
}
</script>

<template>
    <div>
        <draggable
            v-if="items.length"
            v-model="items"
            item-key="id"
            group="gallery">
            <template #item="{element, index}">
                <item @remove="remove" @changeImage="changeImage" :element="element" :index="index"></item>
            </template>
        </draggable>

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
    </div>
</template>
