import Vue from 'vue';
import VueRouter from 'vue-router';
import InViewportDirective from 'vue-in-viewport-directive'
import VueModal from 'vue-js-modal'
// import TimeAgo from 'javascript-time-ago'
// import en from 'javascript-time-ago/locale/en'
import moment from 'moment'


window.makeItRain = async function(n, append) {

  var fallTime, rotateTime, delayTime;
  var colors = [ 'red', 'yellow', 'purple', 'cyan', 'pink', 'crimson', 'hotpink', 'fuchsia' ];

  if (!n) { n = 20 }

  for (var i = 0; i < n; i++) {
    let el = document.createElement('div');
    el.classList.add('fetti');

    fallTime = ((Math.random() * 10) + 3);
    rotateTime = ((Math.random() * 2) + 1);

    el.style.left = Math.floor(append.offsetWidth * Math.random()) + 'px';
    el.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
    el.style.animation = `fettiFall ${fallTime}s linear, fettiRotate ${rotateTime}s infinite linear`;
    // el.style.transition = `top ${delayTime}s linear`

    setTimeout(() => {
      append.removeChild(el);
    }, fallTime * 1000);

    append.appendChild(el);
  }

};


window.env = require('./env').default;

Vue.directive('in-viewport', InViewportDirective);
Vue.use(VueModal, { dynamic: true, injectModalsContainer: true });

require('./bootstrap');
window.$ = window.jQuery = require('jquery');
require('magnific-popup/dist/jquery.magnific-popup.js');
require('slick-carousel/slick/slick.min.js');
require('wowjs');
moment.locale('he');
// TimeAgo.addLocale(en);
// const timeAgo = new TimeAgo('en-US');
// console.log(timeAgo.format(new Date()));
// this.$env.mobile - это что бы узнавать с джс мобайл или нет (Леха)


Vue.config.devtools = true;
Vue.config.performance = true;
Vue.prototype.$env = env;

import router from './router';
import store from './store';

import App from './App.vue';
import Login from './components/modals/Login.vue';
import Reg from './components/modals/Reg.vue';

Vue.filter('formatDate', function (value) {
  if (value) {
    return moment(String(value)).fromNow();
  }
})

window.app = new Vue({
  router: router,
  store: store,
  render: h => h(App),
  methods: {
    openReg() {
      this.$modal.show(Reg, {}, {
        adaptive: true,
        width: this.$env.mobile ? '90%' : 600,
        height: this.$env.mobile ? '90%' : 'auto',
        scrollable: true,
        transition: 'modal-anim',
      })
    },
    openLogin() {
      this.$modal.show(Login, {}, {
        adaptive: true,
        width: this.$env.mobile ? '90%' : 600,
        height: this.$env.mobile ? '90%' : 'auto',
        scrollable: true,
        transition: 'modal-anim',
        // overlayTransition: 'modal-bg-anim',
      })
    }
  }
}).$mount('#home');

//TODO: DELETE AFTER HEADER REFACTOR
// $('.header-main .celebrities-slider').slick({
//   slidesToShow: 12,
//   slidesToScroll: 12,
//   dots: false,
//   arrows: true,
//   rtl: true,
//   infinite: true,
//   initialSlide: 2,
//   responsive: [
//       {
//       breakpoint: 1500,
//       settings: {
//         slidesToShow: 10,
//         slidesToScroll: 10
//       }
//     },
//     {
//       breakpoint: 1367,
//       settings: {
//         slidesToShow: 9,
//         slidesToScroll: 9
//       }
//     },
//     {
//       breakpoint: 1200,
//       settings: {
//         slidesToShow: 8,
//         slidesToScroll: 8
//       }
//     },
//     {
//       breakpoint: 1024,
//       settings: {
//         slidesToShow: 7,
//         slidesToScroll: 7
//       }
//     },
//     {
//         breakpoint: 991,
//         settings: {
//             arrows: false,
//             centerMode: true,
//             variableWidth: true,
//             slidesToShow: 1,
//             slidesToScroll: 3,
//         }
//     }
//
//     // {
//     //     breakpoint: 991,
//     //     settings: "unslick"
//     // }
//   ]
// });
//run stroke
// if($('.run-stroke').length){
//     //calculate width of stroke
//     var strokeWidth = $('.run-stroke').width();
//     var strokeSpeed = 70;//20px per second
//     var strokeAnimDuration = strokeWidth / strokeSpeed;
//
//     $('.run-stroke').css('animation','animStroke '+strokeAnimDuration+'s linear infinite');
// }

$(document).ready(function(){
  $(".toggle-mnu").click(function() {
    $(this).toggleClass("active");
    return false;
  });
  $(".toggle-mnu+.main-nav a").on('click', function(){
    $(".toggle-mnu").toggleClass("active");
  });
});

//TODO: DELETE AFTER HEADER REFACTOR
//auth buttons
// $('.register-popup-trigger').on('click', function(e){
//     e.preventDefault();
//     app.openReg();
// });
//
// $('.login-popup-trigger').on('click', function(e){
//     e.preventDefault();
//     app.openLogin();
// });
