import Vue from 'vue';
import VueRouter from 'vue-router';
import Meta from 'vue-meta';

import store from './store';
Vue.use(VueRouter);
Vue.use(Meta);

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
  },
  {
    path: '/view/post/:id',
    component: SinglePost,
    name: 'post-viewer',
  },
];

const router = new VueRouter({
  routes,
  mode: env.STAGE == 'prod' ? 'history' : 'hash',
});

router.beforeEach(async (to, from, next) => {

  if(window.app) {
    store.dispatch('modals/ad/open')
  }

  if(to.name == 'single-post') {
    window.scrollTo(0, 0)
  }

  next();
});

export default router;
