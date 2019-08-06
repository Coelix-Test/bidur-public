export default {
  namespaced: true,
  state: {
    data: {},
    loaded: false,
  },
  mutations: {
    saveData(state, payload) {
      this.data = payload;
    }
  },
  actions: {
    updateData(context) {
      return axios
        .post('/getMainPageOptimized')
        .then(res => {
          context.commit('saveData', res.data)
        })
        .catch(err => {
          console.error('Main page optimized data broken!');
        })
    }
  },
  getters: {
    
  }
};;
