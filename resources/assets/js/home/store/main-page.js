export default {
  namespaced: true,
  state: {
    data: {},
    loaded: false,
  },
  mutations: {
    saveData(state, payload) {
      state.data = payload;
    },
    loaded(state) {
      state.loaded = true;
    }
  },
  actions: {
    updateData(context) {
      return axios
        .post('/api/getMainPageOptimized')
        .then(res => {
          res.data.selectedPosts = Object.values(res.data.selectedPosts);
          context.commit('saveData', res.data);
        })
        .catch(err => {
          console.error('Main page optimized data broken!');
        })
        .finally(() => {
          context.commit('loaded')
        })
    }
  },
  getters: {
    birthday(state) {
      return state.data.birthday;
    },
    instagram(state) {
      return state.data.instagram;
    },
    selectedPosts(state) {
      return state.data.selectedPosts;
    },
    surveyMobile(state) {
      return state.data.serviceMobile;
    },
    surveyDesktop(state) {
      return state.data.serviceDesktop;
    },
    loaded(state) {
      return state.loaded;
    },
  }
};;
