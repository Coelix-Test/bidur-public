import Vue from 'vue';
import VueRouter from 'vue-router';
import moment from 'moment'
import Vuesax from 'vuesax'

Vue.use(VueRouter)
Vue.use(Vuesax, { rtl: true })

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import 'vuesax/dist/vuesax.css' //Vuesax styles
import 'material-icons/iconfont/material-icons.css';

Array.prototype.move = function(old_index, new_index) {
   while (old_index < 0) {
       old_index += this.length;
   }
   while (new_index < 0) {
       new_index += this.length;
   }
   if (new_index >= this.length) {
       var k = new_index - this.length + 1;
       while (k--) {
           this.push(undefined);
       }
   }
   this.splice(new_index, 0, this.splice(old_index, 1)[0]);
};


window.generateGuid = function () {
var result, i, j;
result = '';
for(j=0; j<32; j++) {
  if( j == 8 || j == 12 || j == 16 || j == 20)
    result = result + '-';
  i = Math.floor(Math.random()*16).toString(16).toUpperCase();
  result = result + i;
}
return result;
}


import PostSingle from './views/PostSingle.vue';
import PostList from './views/PostList.vue';
import Surveys from './views/Surveys.vue';
import Tags from './views/Tags.vue';
import EditMainPage from './views/EditMainPage.vue';
import Users from './views/Users.vue';
import Mails from './views/Mails.vue';
import InstaSlider from './views/InstaSlider.vue';
import Videos from './views/Videos.vue';

const router = new VueRouter({
  routes: [
    { path: '/', name: 'posts', component: PostList },
    { name: 'post-new', path: '/post/new', component: PostSingle },
    { name: 'post-edit', path: '/post/:id', component: PostSingle },
    { path: '/insta-slider', name: 'insta-slider', component: InstaSlider },
		{ path: '/videos', name: 'videos', component: Videos },
    { path: '/surveys', name: 'surveys', component: Surveys },
    { name: 'mails', path: '/mails', component: Mails },
    { path: '/tags', name: 'tags', component: Tags },
    { path: '/users', name: 'users', component: Users },
    //{ path: '/editpost/:id', name: 'editpost', component: EditPost },
    { path: '/edit-main-page', name: 'edit-main-page', component: EditMainPage }
  ]
});

require('./bootstrap');
moment.locale('he');
Vue.config.devtools = true;
Vue.config.performance = true;

Vue.filter('formatDate', function (value) {
  if (value) {
    return moment(String(value)).fromNow();
  }
})
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Admin from './Admin.vue';

const app = new Vue({
  router,
  components: {
    Admin
  },
  render: h => h(Admin)
}).$mount('#admin');
