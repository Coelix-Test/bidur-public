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
		videos(state) {
      return state.data.videos;
    },
    loaded(state) {
      return state.loaded;
    },
    // isSetDown (Alias)
    // sometimes it works an hour late (???)
		isSunday() {
      // generate integer including getDay of the week and hours
      let now = new Date().getDay() * 100 + new Date().getHours();
      // posts go up in Friday(5) at 11 am
      let limit1 = 511;
      // then go down in Sunday(0) 11 am
      let limit2 = 11;
			return (now < limit1) && (now > limit2);
		}
  }
};;
