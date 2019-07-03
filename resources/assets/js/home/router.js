import Vue from 'vue';
import VueRouter from 'vue-router';
// import Multiguard from 'vue-router-multiguard';

// import store from './../store';
Vue.use(VueRouter);

// import auth from './auth';
// import account from './account';

import Index from './views/Index.vue';
import SinglePost from './views/SinglePost.vue'
import ByHashtag from './views/ByHashtag.vue'


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
];

// routes.push(auth);
// routes.push(account);

const router = new VueRouter({
  routes,
});

// router.beforeEach(async (to, from, next) => {
//   // if(!store.state.user.loaded) {
//   //   console.log(store.getters.token);
//   //   if(store.state.user.token) {
//   //
//   //     await app.$http.get('/user/info', {
//   //       headers: {
//   //         'Authorization': store.state.user.token
//   //       }
//   //     }).then(res => {
//   //       axios.defaults.headers.common['Authorization'] = 'Bearer ' + store.state.user.token;
//   //       store.state.user.data = res.data;
//   //       store.state.user.logged = true;
//   //     }).catch(res => {
//   //       store.state.user.logged = false;
//   //     });
//   //   } else {
//   //     store.state.user.logged = false;
//   //   }
//   //   store.state.user.loaded = true;
//   // }
//
//   next();
// });

export default router;
