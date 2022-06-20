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

Vue.component('sample-datatable', require('./components/sample/sample_datatable.vue').default);

                                    //-------------- INCLUDES -------------------//
// BASE

// ADMIN
Vue.component('admin-navbar-component', require('./components/includes/admin/TopNav.vue').default);
Vue.component('admin-sidebar-component', require('./components/includes/admin/SideBar.vue').default);
Vue.component('admin-footer-component', require('./components/includes/admin/Footer.vue').default);

                                    //------------------ ADMIN ---------------------//
// ACADEMIC RANK
Vue.component('academic-rank-create-form', require('./components/admin/academic_rank/academic_rank_create_form.vue').default);
Vue.component('academic-rank-datatable', require('./components/admin/academic_rank/academic_rank_datatable.vue').default);
Vue.component('academic-rank-update-modal', require('./components/admin/academic_rank/academic_rank_update_modal.vue').default);

// DESIGNATION
Vue.component('designation-create-form', require('./components/admin/designation/designation_create_form.vue').default);
Vue.component('designation-datatable', require('./components/admin/designation/designation_datatable.vue').default);
Vue.component('designation-update-modal', require('./components/admin/designation/designation_update_modal.vue').default);

// FACULTY TYPE
Vue.component('faculty-type-create-form', require('./components/admin/faculty_type/faculty_type_create_form.vue').default);
Vue.component('faculty-type-datatable', require('./components/admin/faculty_type/faculty_type_datatable.vue').default);

// ROLE
Vue.component('role-create-form', require('./components/admin/role/role_create_form.vue').default);
Vue.component('role-datatable', require('./components/admin/role/role_datatable.vue').default);

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
