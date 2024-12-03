<script setup>
import {onMounted, watch} from "vue"
import {useFileUploader} from '@/composable/useFileUploader'

const {element, index} = defineProps(['element', 'index'])
const emit = defineEmits(['remove', 'changeImage'])

const {progress, isLoading, error, uploadFile} = useFileUploader()

watch(error, (value) => {
    if (value) {
       setTimeout(() => {
           emit('remove', element.id)
       }, 3000)
    }
})

onMounted(async () => {
    if (element.file) {
        const result = await uploadFile('/images', element.file)

        if (result?.url) {
            emit('changeImage', element.id, result.url)
        }
    }
})
</script>

<template>
    <div>
        <div v-if="error" class="p-4 my-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
             role="alert">
            <span class="font-medium">{{ error }}</span>
        </div>
        <div v-else
             class="flex my-4 items-center bg-white border-gray-200 md:flex-row hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
            <div class="relative">
                <div v-if="isLoading" class="absolute top-0 right-0 w-full bg-gray-200 dark:bg-gray-700">
                    <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none"
                         :style="`width: ${progress}%`"> {{ progress }}%
                    </div>
                </div>
                <img
                    :src="element.url"
                    class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg">
                <div v-if="isLoading"
                     class="absolute opacity-50 inset-0 flex items-center justify-center bg-gray-200 rounded-md">
                    <svg class="animate-spin h-8 w-8 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                strokeWidth="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291l.285.286a1 1 0 001.415-1.414l-1.414-1.414a1 1 0 00-1.415 1.414z"></path>
                    </svg>
                </div>
            </div>
            <div class="flex flex-col justify-between gap-y-4 p-4 leading-normal">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Название</label>
                    <input :name="`gallery[${index}][id]`"
                           :value="element.id"
                           type="hidden"
                    />
                    <input :name="`gallery[${index}][url]`"
                           :value="element.url"
                           type="hidden"
                    />
                    <input :name="`gallery[${index}][ordering]`"
                           :value="index"
                           type="hidden"
                    />
                    <input :value="element.title"
                           :name="`gallery[${index}][title]`"
                           type="text"
                           class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    />
                </div>
                <button
                    type="button"
                    class="text-sm bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded-lg focus:outline-none focus:shadow-outline"
                    @click="$emit('remove', element.id)"
                >
                    Удалить
                </button>
            </div>
        </div>
    </div>
</template>
