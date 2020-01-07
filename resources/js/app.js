/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


import router from './router/index'
import { Form, HasError, AlertError } from 'vform';
//global registration
import VueFormWizard from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
Vue.use(VueFormWizard)

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

Vue.component('pagination', require('laravel-vue-pagination'));

import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, {
  color: 'rgb(0, 119, 181)',
  failedColor: 'red',
  height: '3px'
})

import swal from 'sweetalert2'
window.swal = swal;

const toast = swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});

window.toast = toast;


import VeeValidate from 'vee-validate';
Vue.use(VeeValidate);

// Vue Filters
Vue.filter('substring', function(value){
  if (!value) return ''
  value = value.toString()
  return value.substring(11, 60)
})

/**
 * @ Vue Js Production 
 * Uncomment below when compiling to production
 * Comment below if compiling to development
 * @ Check your .env if prod or local
 **/
if(process.env.MIX_APP_ENV === 'prod'){
  Vue.config.devtools = false
  Vue.config.debug = false
  Vue.config.silent = true
}

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// General Components
Vue.component('Navbar', require('./components/inc/Navbar.vue').default);
Vue.component('Sidebar', require('./components/inc/Sidebar.vue').default);
Vue.component('Headerarea', require('./components/inc/Headerarea.vue').default);
Vue.component('Footerarea', require('./components/inc/Footerarea.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
