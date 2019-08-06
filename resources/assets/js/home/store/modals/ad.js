export default {
  namespaced: true,
  state: {
    opened: false,
  },
  mutations: {
    open(state) {
      state.opened = true;
    },
    close(state) {
      state.opened = false;
    },
    switch(state) {
      state.opened = !state.opened;
    },
  },
  actions: {
    open(context) {
      var el = document.getElementById('ads');
      var rest = document.getElementById('ads-rest');

      context.commit('open');
      el.classList.remove('closed', 'animate')
      rest.innerHTML = 3;
      var sec = 0;
      var interval = setInterval(() => {
        sec++;
        rest.innerHTML = 3 - sec;
        if(sec >= 3) {
          context.commit('close');
          el.classList.add('animate');
          setTimeout(function () {
            el.classList.add('closed');
          }, 300);
          clearInterval(interval);
        }
      }, 1000);
    }
  },
  getters: {
    isOpened(state) {
      return state.opened;
    },
  }
};
