/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//----------------- GLOBAL DECLARATION OF COMPONENTS -----------------------//

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

                                    //-------------- INCLUDES -------------------//
// BASE

// ADMIN
Vue.component('admin-navbar-component', require('./components/includes/admin/TopNav.vue').default);
Vue.component('admin-sidebar-component', require('./components/includes/admin/SideBar.vue').default);
Vue.component('admin-footer-component', require('./components/includes/admin/Footer.vue').default);

                                    //------------------ ADMIN ---------------------//

                                    /*----------------- ACAD HEAD -----------------*/
// ACTIVITY
Vue.component('activity-create-form', require('./components/acad_head/activity/activity_create_form.vue').default);
Vue.component('activity-datatable', require('./components/acad_head/activity/activity_datatable.vue').default);

                                    //----------------- FACULTY -----------------//

                                    //----------------- CHECKER -----------------//

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
