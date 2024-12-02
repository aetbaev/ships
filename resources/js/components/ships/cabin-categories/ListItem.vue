<script setup>
import {computed, ref, watch} from "vue"

const {item, types, index} = defineProps(['item', 'types', 'index'])

const cabin = ref(item)

watch(() => item.description, async (value) => {
    cabin.description = value
})

const isEmptyDescription = computed(() =>
    !cabin.value?.description
    || (cabin.value?.description && !cabin.value.description.replace(/(<([^>]+)>)/gi, "").trim())
)

defineEmits(['remove', 'editDescription', 'editPhotos'])
</script>

<template>
    <div class="grid md:grid-cols-8 md:gap-4 mb-5">
        <input v-model="cabin.id" :name="`cabins[${index}][id]`" type="hidden">
        <input v-model="cabin.description" :name="`cabins[${index}][description]`" type="hidden">
        <input v-for="(url, index) in cabin.photos"
               :key="index"
               :name="`cabins[${index}][photos][]`"
               :value="url"
               type="hidden">
        <div class="col-span-1">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Код
                категории</label>
            <input v-model="cabin.vendor_code"
                   :name="`cabins[${index}][vendor_code]`"
                   type="text"
                   class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            />
        </div>
        <div class="col-span-2">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Тип
                категории</label>
            <select v-model="cabin.type"
                    :name="`cabins[${index}][type]`"
                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option v-for="type in types" :key="type" :value="type">{{ type }}</option>
            </select>
        </div>
        <div class="col-span-3">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Название</label>
            <input v-model="cabin.title"
                   :name="`cabins[${index}][title]`"
                   type="text"
                   class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            />
        </div>
        <div class="col-span-2 flex items-end justify-center pb-1">
            <div class="flex items-center gap-4">
                <button @click="$emit('editDescription', {
                    id: cabin.id,
                    description: cabin.description,
                })"
                        type="button"
                        class="inline-flex items-center text-sm w-full sm:w-auto font-medium px-2 py-1 text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                    <svg v-if="!isEmptyDescription" class="me-1 w-6 h-6 text-green-500 dark:text-white"
                         aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 11.917 9.724 16.5 19 7.5"/>
                    </svg>
                    <svg v-else class="me-1 w-6 h-6 text-orange-400 dark:text-white" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    Описание
                </button>
                <button @click="$emit('editPhotos', {
                    id: cabin.id,
                    photos: cabin.photos,
                })"
                        type="button"
                        class="inline-flex gap-1 items-center text-sm w-full sm:w-auto font-medium px-2 py-1.5 text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                    Фото
                    <span
                        :class="{
                            'bg-green-100 text-green-800 dark:bg-gray-700 dark:text-green-400 border-green-400': cabin.photos?.length,
                            'bg-orange-100 text-orange-800 dark:bg-gray-700 dark:text-orange-400 border-orange-400': !cabin.photos?.length,
                        }"
                        class="border text-xs font-medium px-1 rounded">{{
                            cabin.photos?.length || 0
                        }}</span>
                </button>
                <button type="button" @click="$emit('remove', cabin.id.toString())">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg"
                         width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m15 9-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</template>

