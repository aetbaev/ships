<script setup>
defineProps(['element', 'index'])

defineEmits(['remove'])
</script>

<template>
    <div
        class="flex my-4 items-center bg-white border-gray-200 md:flex-row hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
        <img
            :src="element.url"
            class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg">
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

</template>

<style scoped>

</style>
