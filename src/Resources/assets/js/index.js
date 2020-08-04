import Vue from 'vue';

Vue.component('custom-app', require('./App.vue').default);
Vue.component('menu-link', require('./components/ui/Navbar/Link.vue').default);

new Vue({
  el: '#app',
});
