<script setup>
import {ref} from "vue";
import Item from "./Item.vue"

const {spec} = defineProps(['spec'])

const defaultSpec = [
    {
        "name": "Год постройки",
        "value": null
    },
    {
        "name": "Водоизмещение",
        "value": null
    },
    {
        "name": "Длина",
        "value": null
    },
    {
        "name": "Ширина",
        "value": null
    },
    {
        "name": "Количество палуб",
        "value": null
    },
    {
        "name": "Скорость (макс.)",
        "value": null
    },
    {
        "name": "Каюты",
        "value": null
    },
    {
        "name": "Пассажиры",
        "value": null
    },
    {
        "name": "Пассажиры (макс.)",
        "value": null
    },
    {
        "name": "Экипаж",
        "value": null
    },
    {
        "name": "Стабилизаторы качки",
        "value": null
    }
];

const items = ref(spec && spec.length ? spec : defaultSpec)

const add = () => items.value.push({
    name: '',
    value: ''
})

const remove = (index) => items.value.splice(index, 1)
</script>

<template>
    <div>
        <item v-for="(item, index) in items" @remove="remove" :item="item" :key="index" :index="index"/>

        <button @click="add"
                type="button"
                class="inline-flex items-center text-sm w-full sm:w-auto font-medium px-3 py-2 text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
            <svg class="w-6 h-6 text-gray-800 dark:text-white me-2" aria-hidden="true"
                 xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5 12h14m-7 7V5"/>
            </svg>
            Добавить параметр
        </button>
    </div>
</template>
