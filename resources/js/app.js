import './bootstrap';

import '../sass/app.scss'

import {createApp} from 'vue'
import { createRouter, createWebHistory } from 'vue-router'
import {routes} from "./routes.js"
//


const router = createRouter({
    history: createWebHistory(),
    routes
})
import App from './App.vue'
createApp(App).use(router).mount("#app")


