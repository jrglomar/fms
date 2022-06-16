require('./bootstrap');

import Vue from 'vue'

import VueRouter from 'vue-router';
import routes from './routes';

// import Vue from 'vue'   // in Vue 2
import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(VueRouter)

const app = new Vue({
    el: '#app',
    router: new VueRouter(routes)
});

