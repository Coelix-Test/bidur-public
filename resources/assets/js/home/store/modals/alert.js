export default {
  namespaced: true,
  state: {
    opened: false,
    text: '',
  },
  mutations: {
    close(state) {
      state.opened = false;
    },
    open(state, text) {
      state.opened = true;
      state.text = text;
    },
    switch(state) {
      state.opened = !state.opened;
    },
  },
  actions: {

  },
  getters: {
    isOpened(state) {
      return state.opened;
    },
    content(state) {
      return state.text;
    }
  }
};;
