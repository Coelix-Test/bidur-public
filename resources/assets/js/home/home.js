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

// window.env = require('./env').default;

Vue.directive('in-viewport', InViewportDirective);
Vue.use(VueModal, { dynamic: true, injectModalsContainer: true });

import './config/env';
import './config/funcs';
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
