<template>
  <div>
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
  }
}
</script>

<style lang="scss" scoped>

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
