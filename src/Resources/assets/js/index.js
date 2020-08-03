import Vue from 'vue';
import App from './App';
import Dashboard from './views/Dashboard';
import Edit from './views/Edit';

new Vue({
  render: h => h(Edit)
}).$mount('#app');
