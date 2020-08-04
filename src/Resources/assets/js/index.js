import Vue from 'vue';
import App from './App';
import Home from './views/Home';
import Dashboard from './views/Dashboard';
import Edit from './views/Edit';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const routes = [
  { path: '/', name:'home', component: Home },
  { path: '/edit/', name:'edit', component: Edit },
  { path: '/dashboard/', name:'dashboard', component: Dashboard },
];

const router = new VueRouter({
  mode: 'history',
  base: window.data.baseUrl,
  routes,
});

new Vue({
  router,
  render: h => h(App),
}).$mount('#app');
