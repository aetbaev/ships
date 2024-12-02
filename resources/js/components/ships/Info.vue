<script setup>
import {reactive} from "vue";

const {title, description} = defineProps(['title', 'description'])

const ship = reactive({title, description})
</script>

<template>
    <div class="mb-5">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Название</label>
        <input v-model="ship.title"
               name="title"
               type="text"
               class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
    </div>
    <div>
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Описание</label>
        <input type="hidden" name="description" :value="ship.description">
        <editor v-model="ship.description"></editor>
    </div>
</template>
