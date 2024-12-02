import './bootstrap';

import {createApp} from 'vue';
import Editor from './components/Editor.vue';
import ShipCabinCategoriesList from './components/ships/cabin-categories/List.vue';
import ShipInfo from './components/ships/Info.vue';
import ShipSpec from './components/ships/spec/List.vue';
import ShipGallery from './components/ships/gallery/List.vue';

import 'flowbite';

createApp({})
    .component('Editor', Editor)
    .component('ShipInfo', ShipInfo)
    .component('ShipSpec', ShipSpec)
    .component('ShipGallery', ShipGallery)
    .component('ShipCabinCategoriesList', ShipCabinCategoriesList)
    .mount('#app')
