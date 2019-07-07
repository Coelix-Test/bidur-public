import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import PostSingle from './views/PostSingle.vue';
import PostList from './views/PostList.vue';
import Surveys from './views/Surveys.vue';
import Tags from './views/Tags.vue';
import EditMainPage from './views/EditMainPage.vue';
import Users from './views/Users.vue';
import EditPost from './views/EditPost.vue';

const router = new VueRouter({
  routes: [
    { path: '/', name: 'posts', component: PostList },
    { name: 'post-new', path: '/post/new', component: PostSingle },
    { name: 'post-single', path: 'post/:id', component: PostSingle },

    { path: '/surveys', name: 'surveys', component: Surveys },
    { path: '/tags', name: 'tags', component: Tags },
    { path: '/users', name: 'users', component: Users },
    { path: '/editpost/:id', name: 'editpost', component: EditPost },
    { path: '/edit-main-page', name: 'edit-main-page', component: EditMainPage }
  ]
});

require('./bootstrap');

Vue.config.devtools = true;
Vue.config.performance = true;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Admin from './Admin.vue';

const app = new Vue({
  //el: '#admin',
  router,
  components: {
    Admin
  },
  render: h => h(Admin)
}).$mount('#admin');
