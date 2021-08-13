require('./bootstrap');
require('./common.js');
require('./top');
require('./components/header.js');
require('./components/popup.js');
require('./post/topost.js');
require('./post/mypost.js');

window.Vue = require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
  el: '#app',
});
