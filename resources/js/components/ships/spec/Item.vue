<script setup>
defineProps(['item', 'index'])

defineEmits(['remove'])
</script>

<template>
    <div class="grid md:grid-cols-3 md:gap-4 mb-5">
        <input :value="item.name"
               :name="`spec[${index}][name]`"
               placeholder="Название"
               type="text"
               class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
        <input :value="item.value"
               :name="`spec[${index}][value]`"
               placeholder="Значение"
               type="text"
               class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        />
        <div class="inline-flex items-center">
            <button type="button" @click="$emit('remove', index)">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg"
                     width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m15 9-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
            </button>
        </div>
    </div>
</template>
