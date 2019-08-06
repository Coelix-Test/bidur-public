import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

import user from './user';
import modals from './modals';
import main_page from './main-page';

const store = new Vuex.Store({
  modules: {
    'user': user,
    'modals': modals,
    'main-page': main_page,
  },
  state: {

  },
  mutations: {

  },
  actions: {

  }
});

export default store;
