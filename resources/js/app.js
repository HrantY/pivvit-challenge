require('./bootstrap');

window.Vue = require('vue').default;
import VueRouter from 'vue-router'
import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(VueRouter)
Vue.use(VueAxios, axios)

Vue.component('App', require('./components/App.vue').default);


const router = new VueRouter({
    routes: []
})

const app = new Vue({
    el: '#app',
    router
})
