import Vue from 'vue';
import VueRouter from 'vue-router';
import InViewportDirective from 'vue-in-viewport-directive'
import VueModal from 'vue-js-modal'
import VueLazyload from 'vue-lazyload'
import moment from 'moment'
import VueAwesomeSwiper from 'vue-awesome-swiper'

Vue.use(VueAwesomeSwiper)
Vue.use(require('vue-script2'));
Vue.use(VueLazyload);

window.makeItRain = async function(n, append) {

  var fallTime, rotateTime, delayTime;
  var colors = [ '#e3b436', '#eec447', '#d4a21f' ];

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

// window.env = require('./env').default;

Vue.directive('in-viewport', InViewportDirective);
Vue.use(VueModal, { dynamic: true, injectModalsContainer: true });

import './env';
import axios from 'axios';
import 'swiper/dist/css/swiper.css'

moment.locale('he');

Vue.config.devtools = true;
Vue.config.performance = true;
Vue.prototype.$env = env;
window.axios = axios;

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
  },
  mounted() {
    var preloader = document.getElementById('preloader');

    preloader.className += ' fade';

    setTimeout(function() {
      preloader.remove();
    }, 300);

    // this.$store.dispatch('modals/ad/open');
  }
}).$mount('#home');
