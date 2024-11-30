import './bootstrap';

import {createApp} from 'vue';
import Spec from './components/Spec.vue';

import 'flowbite';

createApp({})
    .component('Spec', Spec)
    .mount('#app')
