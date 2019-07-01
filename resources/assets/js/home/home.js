import Vue from 'vue';
import VueRouter from 'vue-router';

require('./bootstrap');
window.$ = window.jQuery = require('jquery');
require('magnific-popup/dist/jquery.magnific-popup.js');
require('slick-carousel/slick/slick.min.js');
require('wowjs');

Vue.config.devtools = true;
Vue.config.performance = true;

import router from './router';

import App from './App.vue';

window.app = new Vue({
  router: router,
  render: h => h(App)
}).$mount('#home');



$('#header_main .celebrities-slider').slick({
  slidesToShow: 12,
  slidesToScroll: 12,
  dots: false,
  arrows: true,
  rtl: true,
  infinite: true,
  initialSlide: 2,
  responsive: [
      {
      breakpoint: 1500,
      settings: {
        slidesToShow: 10,
        slidesToScroll: 10
      }
    },
    {
      breakpoint: 1367,
      settings: {
        slidesToShow: 9,
        slidesToScroll: 9
      }
    },
    {
      breakpoint: 1200,
      settings: {
        slidesToShow: 8,
        slidesToScroll: 8
      }
    },
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 7,
        slidesToScroll: 7
      }
    },
    {
        breakpoint: 991,
        settings: {
            arrows: false,
            centerMode: true,
            variableWidth: true,
            slidesToShow: 1,
            slidesToScroll: 3,
        }
    }

    // {
    //     breakpoint: 991,
    //     settings: "unslick"
    // }
  ]
});
//run stroke
if($('.run-stroke').length){
    //calculate width of stroke
    var strokeWidth = $('.run-stroke').width();
    var strokeSpeed = 70;//20px per second
    var strokeAnimDuration = strokeWidth / strokeSpeed;

    $('.run-stroke').css('animation','animStroke '+strokeAnimDuration+'s linear infinite');
}

jQuery(document).ready(jQuery(".toggle-mnu").click(function() {
  jQuery(this).toggleClass("active");
  return false;
}));
