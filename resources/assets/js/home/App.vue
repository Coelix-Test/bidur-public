<template>
  <main>
    <header-main/>
    <router-view/>
    <!-- <socials/> -->
  </main>
</template>

<script>
import HeaderMain from './components/header/HeaderMain.vue';
import Socials from './components/common/Socials.vue';

export default {
  data() {
    return {
      currentPageUrl : null,
    }
  },
  components: {
    HeaderMain,
    Socials
  },
  created() {
    this.currentPageUrl = window.location.href;
  }
}
</script>

<style lang="scss" scoped>

main {
  flex-grow: 1;
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
