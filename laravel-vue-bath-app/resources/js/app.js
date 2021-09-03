require('./bootstrap');
require('./common.js');
require('./top');

require('./components/header.js');
require('./components/popup.js');

require('./post/topost.js');
require('./post/mypost.js');

require('./user/edit.js');
require('./user/register.js');

import Vue from 'vue';
import Search from './components/Search';
import ToPost from './components/ToPost';
import SelectOrder from './components/SelectOrder';
import FavoritedBath from './components/FavoritedBath';

const app = new Vue({
  el: '#app',
  components: {
    Search, ToPost, SelectOrder, FavoritedBath,
  }
})
