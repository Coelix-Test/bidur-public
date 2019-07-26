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
      state.time = 3;
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
    open(context) {
      var el = document.getElementById('ads');
      var rest = document.getElementById('ads-rest');

      el.classList.remove('closed')
      rest.innerHTML = 3;
      var sec = 0;
      var interval = setInterval(() => {
        sec++;
        rest.innerHTML = 3 - sec;
        console.log(sec);
        if(sec >= 3) {
          el.classList.add('closed');
          clearInterval(interval);
        }
      }, 1000);
    }
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
