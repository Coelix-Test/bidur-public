import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

import user from './user.js';
import global from './global.js';

const store = new Vuex.Store({
  modules: {
    user,
    global,
  },
  state: {

  },
  mutations: {

  },
  actions: {

  }
});

export default store;
