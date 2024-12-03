<script setup>
import {onMounted, watch} from "vue"
import {useFileUploader} from '@/composable/useFileUploader'

const {element, index} = defineProps(['element', 'index'])

const emit = defineEmits(['remove'])

const {progress, isLoading, error, uploadFile} = useFileUploader()

watch(error, (value) => {
    if (value) {
        setTimeout(() => {
            emit('remove', index)
        }, 3000)
    }
})

onMounted(async () => {
    if (element.file) {
        const result = await uploadFile('/images', element.file)

        if (result?.url) {
            emit('changeImage', index, result.url)
        }
    }
})

</script>

<template>
    <div class="relative">
        <div v-if="error" class="p-4 my-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
             role="alert">
            <span class="font-medium">{{ error }}</span>
        </div>
        <div v-else>
            <div v-if="isLoading" class="absolute top-0 right-0 w-full bg-gray-200 dark:bg-gray-700">
                <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none"
                     :style="`width: ${progress}%`"> {{ progress }}%
                </div>
            </div>
            <img class="h-auto w-full rounded-lg" :src="element.url">
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
            <button
                v-if="!isLoading"
                type="button"
                class="absolute text-sm top-2 right-2 bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline"
                @click="$emit('remove', index)"
            >
                Удалить
            </button>
        </div>
    </div>
</template>
