require('./bootstrap');
import VueCookies from 'vue3-cookies'
import { createApp } from 'vue';

import App from './App.vue';

import router from './router.js';

createApp(App).use(router).use(VueCookies).mount('#app');


