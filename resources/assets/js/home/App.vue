<template>
  <div>
    <div id="preloader">
      <div>
        <img src="img/logo-yellow.png" alt="">
      </div>
      <div>
        <div class="blue ball"></div>
        <div class="red ball"></div>
        <div class="yellow ball"></div>
        <div class="green ball"></div>
      </div>

    </div>
    <!-- <preloader /> -->
    <header-main></header-main>
    <transition name="anim" mode="out-in">
      <router-view></router-view>
    </transition>
  </div>
</template>

<script>
import HeaderMain from './components/header/HeaderMain.vue';

export default {
  components: {
    HeaderMain
  },
  created() {
    window.onload = function() {
      var preloader = document.getElementById('preloader');

      preloader.className += ' fade';

      setTimeout(function(){
          preloader.style.display = 'none';
      }, 300);
    };
  }
}
</script>

<style lang="scss" scoped>
#preloader {
  display: flex;
  pointer-events: none;
  justify-content: center;
  flex-direction: column;
  align-items: center;
  position: fixed;
  top:0;
  left: 0;
  right: 0;
  bottom: 0;
  width:100vw;
  height: 100vh;
  background-color: #fff;
  z-index:200;
  &.fade {
    opacity: 0.5;
  }
  > div {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
  }
}

.ball {
  width: 22px;
  height: 22px;
  border-radius: 11px;
  margin: 0 10px;
  animation: 2s bounce ease infinite;
  background-color: #F2C94C;
}
.red {
  animation-delay: .25s;
}
.yellow {
  animation-delay: .5s;
}
.green {
  animation-delay: .75s;
}

@keyframes bounce {
    50% {
        transform: translateY(25px);
    }
}

.anim-enter {
  transform: scale(1.1);
  opacity: 0;
}
.anim-enter-to {
  transform: scale(1);
  opacity: 1;
}
.anim-leave {
  transform: scale(1);
  opacity: 1;
}
.anim-leave-to {
  transform: scale(0.9);
  opacity: 0;
}
.anim-enter-active,
.anim-leave-active {
  transform-origin: center top;
  transition: transform 0.3s ease, opacity 0.3s ease;
}

</style>
