export default {
  namespaced: true,
  state: {
    once_opened: false,
    opened: false,
    can_close: false,
    time: 0,
  },
  mutations: {
    open(state) {
      state.opened = true;
      state.once_opened = true;
      state.time = 5;
    },
    close(state) {
      if(state.can_close) {
        state.opened = false;
        state.can_close = false;
      }
    },
    switch(state) {
      if(state.opened) {
        if(state.can_close) {
          state.opened = false;
          state.can_close = false;
        }
      } else {
        state.opened = true;
      }
    },
    canClose(state) {
      state.can_close = true;
    },
    decrementTime(state) {
      state.time--;

      if(state.time <= 0) {
        state.can_close = true;
      }
    }
  },
  actions: {

  },
  getters: {
    canClose(state) {
      return state.can_close;
    },
    isOpened(state) {
      return state.opened;
    },
    timeLeft(state) {
      return state.time;
    },
    onceOpened(state) {
      return state.once_opened;
    }
  }
};
