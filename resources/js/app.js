
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('app-patient-create', require('./components/CreatePatient.vue').default);
Vue.component('app-reception', require('./components/Reception.vue').default);
Vue.component('app-visit-details', require('./components/VisitDetails.vue').default);
Vue.component('app-dashboard', require('./components/Dashboard.vue').default);
Vue.component('app-referral-dashboard', require('./components/ReferralDashboard.vue').default);
Vue.component('app-visit', require('./components/Visit.vue').default);
Vue.component('app-referral', require('./components/Referral.vue').default);
Vue.component('app-reports-dashboard', require('./components/ReportsDashboard.vue').default);
Vue.component('app-report', require('./components/Report.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
