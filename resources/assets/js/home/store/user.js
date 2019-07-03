export default {
  namespaced: true,
  state: {
    data: {},
    loaded: false,
    logged: false,
  },
  mutations: {
    auth(state, token) {
      state.logged = true;
      localStorage.setItem('auth', token);
      app.$http.defaults.headers.common['Authorization'] = `Bearer ${token}`;
    },
    saveData(state, data) {
      state.data = data;
    }
  },
  actions: {
    updateData(context) {
      return app.$http.get('/user/data').then(res => {
        context.commit('auth', res.data);
        return res.data;
      });
    }
  },
  getters: {
    token() {
      return localStorage.getItem('auth');
    }
  }
};;
