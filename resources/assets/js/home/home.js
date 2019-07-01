import Vue from 'vue';
import VueRouter from 'vue-router';


/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');
window.$ = window.jQuery = require('jquery');
require('magnific-popup/dist/jquery.magnific-popup.js');
require('slick-carousel/slick/slick.min.js');

Vue.config.devtools = true;
Vue.config.performance = true;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Home from './Home.vue';

const app = new Vue({
  el: '#home',
  //router,
  components: {
    Home
  },
  render: h => h(Home)
});


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
