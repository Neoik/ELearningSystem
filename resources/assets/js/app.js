
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('status-component', require('./components/StatusComponent.vue'));
Vue.component('submission-component', require('./components/SubmissionComponent.vue'));
Vue.component('mine-submission', require('./components/MySubmissionsComponent.vue'));
Vue.component('problem-adder', require('./components/AddProblemComponent.vue'));
Vue.component('problem-updater', require('./components/UpdateProblemComponent.vue'));
Vue.component('problems-management', require('./components/ProblemsManagementComponent.vue'));
Vue.component('home-component', require('./components/HomeComponent.vue'));

import VueHighlightJS from 'vue-highlight.js';
Vue.use(VueHighlightJS);

import 'highlight.js/styles/default.css';

const app = new Vue({
    el: '#app'
});
