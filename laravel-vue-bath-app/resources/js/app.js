require('./bootstrap');
require('./top');
require('./components/header.js');
require('./components/popup.js');

window.Vue = require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
  el: '#app',
});
