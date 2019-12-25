<template>
  <main>
    <header-main/>
    <router-view/>
    <!-- <socials/> -->

    <!-- flying icon -->
    <!-- <router-link :to="{name: 'single-post', params: { id: 2435 }}"
      class="flying-icon-vod">
      <img src="/img/banners/vodsvg.svg" alt="">
    </router-link> -->
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
.flying-icon-vod{
  position: fixed;
  top: auto;
  left: auto;
  bottom: 62px;
  right: 10px;
  width: 50px;
  height: 50px;
  z-index: 2147483646;
  img{
    width: 100%;
    height: 100%;
    object-fit: contain;
  }
}
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
