import Vue from 'vue';
import VueRouter from 'vue-router';
import Meta from 'vue-meta';
// import Multiguard from 'vue-router-multiguard';

import store from './store';
Vue.use(VueRouter);
Vue.use(Meta);

// import auth from './auth';
// import account from './account';

import Index from './views/Index.vue';
import SinglePost from './views/SinglePost.vue'
import ByHashtag from './views/ByHashtag.vue'
import AboutUs from './views/AboutUs.vue'
import ContactUs from './views/ContactUs.vue'
import MyAccount from './views/MyAccount.vue'
import EditProfile from './views/EditProfile.vue'


const routes = [
  {
    path: '/',
    component: Index,
    name: 'index',
  },
  {
    path: '/post/:id',
    component: SinglePost,
    name: 'single-post',
  },
  {
    path: '/hashtag/:id',
    component: ByHashtag,
    name: 'hashtag',
  },
  {
    path: '/contact-us',
    component: ContactUs,
    name: 'contact-us',
  },
  {
    path: '/about-us',
    component: AboutUs,
    name: 'about-us',
  },
  {
    path: '/my-account',
    component: MyAccount,
    name: 'my-account',
  },
  {
    path: '/edit-profile',
    component: EditProfile,
    name: 'edit-profile',
  }
];

// routes.push(auth);
// routes.push(account);

const router = new VueRouter({
  routes,
  // mode: 'history',
});

router.beforeEach(async (to, from, next) => {
  // if(!store.state.user.loaded) {
  //   console.log(store.getters.token);
  //   if(store.state.user.token) {
  //
  //     await app.$http.get('/user/info', {
  //       headers: {
  //         'Authorization': store.state.user.token
  //       }
  //     }).then(res => {
  //       axios.defaults.headers.common['Authorization'] = 'Bearer ' + store.state.user.token;
  //       store.state.user.data = res.data;
  //       store.state.user.logged = true;
  //     }).catch(res => {
  //       store.state.user.logged = false;
  //     });
  //   } else {
  //     store.state.user.logged = false;
  //   }
  //   store.state.user.loaded = true;
  // }

  // console.log(window.app, 'qweqweqwe');

  if(window.app) {
    store.dispatch('modals/ad/open')
  }

  if(to.name == 'single-post') {
    window.scrollTo(0, 0)
  }

  next();
});

export default router;
