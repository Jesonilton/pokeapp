import {createApp} from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import router from './router/routes.js'

import "https://kit.fontawesome.com/45c0b16403.js"
import './style.css'
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min';

const app = createApp(App);
app.use(createPinia());
app.use(router);
app.mount('#app')

