import Vue from 'vue';
import VueRouter from 'vue-router';

require('./bootstrap');
window.$ = window.jQuery = require('jquery');
require('magnific-popup/dist/jquery.magnific-popup.js');
require('slick-carousel/slick/slick.min.js');

Vue.config.devtools = true;
Vue.config.performance = true;

import router from './router';

import App from './App.vue';

window.app = new Vue({
  router: router,
  render: h => h(App)
}).$mount('#home');

$('#header_main .celebrities-slider').slick({
  slidesToShow: 13,
  slidesToScroll: 13,
  dots: false,
  arrows: true,
  rtl: true, 
});
