<script setup>
import {reactive, ref} from "vue";
import DescriptionModal from './DescriptionModal.vue'
import PhotosModal from './PhotosModal.vue'
import ListItem from "./ListItem.vue";

const {cabinCategories, types} = defineProps(['cabinCategories', 'types'])

const items = reactive(cabinCategories)

const descriptionModal = ref()
const photosModal = ref()

const add = () => items.push({
    id: '_' + Date.now().toString(),
    photos: []
})

const findIndex = (id) => items.findIndex(o => o.id.toString() === id.toString())

const editDescription = (data) => descriptionModal.value.open(data)

const remove = (id) => {
    const index = findIndex(id)

    if (index !== -1) {
        items.splice(index, 1)
    }
}

const updateDescription = (data) => {
    const index = findIndex(data.id)

    if (index !== -1) {
        items[index].description = data.description
    }
}

const editPhotos = (data) => photosModal.value.open(data)

const updatePhotos = (data) => {
    const index = findIndex(data.id)

    if (index !== -1) {
        items[index].photos = data.photos
    }
}
</script>

<template>
    <div>
        <description-modal ref="descriptionModal" @change="updateDescription"/>
        <photos-modal ref="photosModal" @change="updatePhotos"/>

        <list-item v-for="(item, index) in items"
                   :key="item.id"
                   :index="index"
                   :item="item"
                   :types="types"
                   @editDescription="editDescription"
                   @editPhotos="editPhotos"
                   @remove="remove"/>

        <button @click="add"
                type="button"
                class="inline-flex items-center text-sm w-full sm:w-auto font-medium px-3 py-2 text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
            <svg class="w-6 h-6 text-gray-800 dark:text-white me-2" aria-hidden="true"
                 xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5 12h14m-7 7V5"/>
            </svg>
            Добавить каюту
        </button>
    </div>
</template>
