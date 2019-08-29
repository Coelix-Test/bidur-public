const sec_num = 5;

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
      rest.innerHTML = sec_num;
      var sec = 0;
      var interval = setInterval(() => {
        sec++;
        rest.innerHTML = sec_num - sec;
        if(sec >= sec_num) {
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
