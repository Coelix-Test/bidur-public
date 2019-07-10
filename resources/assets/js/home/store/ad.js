import Ad from './../components/modals/Ad.vue'

export default {
  namespaced: true,
  state: {
    opened: false,
    can_close: false,
  },
  mutations: {
    open(state) {
      state.opened = true;
    },
    close(state) {
      if(state.can_close) {
        state.opened = false;
        state.can_close = false;
      }
    },
    canClose(state) {
      state.can_close = true;
    }
  },
  actions: {
    open(context) {
      app.$modal.show(Ad, {}, {
        adaptive: true,
        width: '100%',
        height: '100%',
      }, {
        'before-close': e => {
          if(context.getters.canClose) {
            context.commit('close')
          } else {
            e.stop();
          }
        }
      });
      context.commit('open')
    },
  },
  getters: {
    canClose(state) {
      return state.can_close;
    }
  }
};
