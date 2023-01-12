require('./bootstrap');

window.Vue = require('vue').default;
import VueRouter from 'vue-router'
import axios from 'axios'
import VueAxios from 'vue-axios'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

import Donations from './components/views/Donations'
import Create from './components/views/Create'
import App from './components/App'
import 'bootstrap-vue/dist/bootstrap-vue.css'
axios.defaults.headers.Authorization = `Bearer ${window.accessToken}`
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(VueRouter)
Vue.use(VueAxios, axios)

Vue.component('App', App);

const router = new VueRouter({
    routes: [
        {path: '/donations', component: Donations},
        {path: '/donations/create', component: Create},
        // {path: '/', component: Profiles},
    ]
})

const app = new Vue({
    el: '#app',
    router,
})
