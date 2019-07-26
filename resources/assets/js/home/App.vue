<template>
  <div>
    <!-- <preloader /> -->
    <header-main></header-main>

    <!-- <transition name="anim" mode="out-in"> -->
    <router-view></router-view>
    <!-- </transition> -->

    <a :href="`whatsapp://send?text=${currentPageUrl}`" target="_blank" class="socials-btn whatsapp">
      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
        <path style="fill:#EDEDED;" d="M0,512l35.31-128C12.359,344.276,0,300.138,0,254.234C0,114.759,114.759,0,255.117,0  S512,114.759,512,254.234S395.476,512,255.117,512c-44.138,0-86.51-14.124-124.469-35.31L0,512z"/>
        <path style="fill:#55CD6C;" d="M137.71,430.786l7.945,4.414c32.662,20.303,70.621,32.662,110.345,32.662  c115.641,0,211.862-96.221,211.862-213.628S371.641,44.138,255.117,44.138S44.138,137.71,44.138,254.234  c0,40.607,11.476,80.331,32.662,113.876l5.297,7.945l-20.303,74.152L137.71,430.786z"/>
        <path style="fill:#FEFEFE;" d="M187.145,135.945l-16.772-0.883c-5.297,0-10.593,1.766-14.124,5.297  c-7.945,7.062-21.186,20.303-24.717,37.959c-6.179,26.483,3.531,58.262,26.483,90.041s67.09,82.979,144.772,105.048  c24.717,7.062,44.138,2.648,60.028-7.062c12.359-7.945,20.303-20.303,22.952-33.545l2.648-12.359  c0.883-3.531-0.883-7.945-4.414-9.71l-55.614-25.6c-3.531-1.766-7.945-0.883-10.593,2.648l-22.069,28.248  c-1.766,1.766-4.414,2.648-7.062,1.766c-15.007-5.297-65.324-26.483-92.69-79.448c-0.883-2.648-0.883-5.297,0.883-7.062  l21.186-23.834c1.766-2.648,2.648-6.179,1.766-8.828l-25.6-57.379C193.324,138.593,190.676,135.945,187.145,135.945"/>
      </svg>
    </a>

    <a :href="`https://telegram.me/share/url?url=${currentPageUrl}&text=בדוק את זה!`" target="_blank" class="socials-btn telegram">
      <svg width="35" height="36" viewBox="0 0 35 36" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M17.5 35.5C27.165 35.5 35 27.665 35 18C35 8.33502 27.165 0.5 17.5 0.5C7.83502 0.5 0 8.33502 0 18C0 27.665 7.83502 35.5 17.5 35.5Z" fill="#29B6F6"/>
      <path d="M26.7063 10.125L23.4285 26.8603C23.4285 26.8603 23.2876 27.625 22.3391 27.625C21.8351 27.625 21.5753 27.3853 21.5753 27.3853L14.4755 21.4939L11.0018 19.743L6.54362 18.5574C6.54362 18.5574 5.75 18.3281 5.75 17.6719C5.75 17.125 6.56637 16.8643 6.56637 16.8643L25.2179 9.45475C25.217 9.45388 25.7875 9.24913 26.2031 9.25C26.4586 9.25 26.75 9.35938 26.75 9.6875C26.75 9.90625 26.7063 10.125 26.7063 10.125Z" fill="white"/>
      <path d="M17.1247 23.6919L14.127 26.6442C14.127 26.6442 13.9966 26.7448 13.8225 26.7492C13.7621 26.7509 13.6974 26.7413 13.6309 26.7116L14.4744 21.4922L17.1247 23.6919Z" fill="#B0BEC5"/>
      <path d="M23.1599 12.9214C23.012 12.7289 22.739 12.6939 22.5465 12.84L11 19.7499C11 19.7499 12.8428 24.9054 13.1236 25.7979C13.4054 26.6913 13.6311 26.7123 13.6311 26.7123L14.4746 21.4929L23.0776 13.5339C23.2701 13.3878 23.306 13.1139 23.1599 12.9214Z" fill="#CFD8DC"/>
      </svg>
    </a>

    <!-- <ad/> -->

  </div>
</template>

<script>
import HeaderMain from './components/header/HeaderMain.vue';
// import Ad from './components/modals/Ad.vue';

export default {
  data() {
    return {
      currentPageUrl : null,
    }
  },
  components: {
    HeaderMain,
    // Ad,
  },
  created() {
    this.currentPageUrl = window.location.href;
  }
}
</script>

<style lang="scss" scoped>
.socials-btn {
  display: block;
  position: fixed;
  bottom: 54px;
  width: 48px;
  height: 48px;
  border-radius: 50%;
  box-shadow: 0 5px 10px rgba(0,0,0,0.3);
  &.whatsapp {
    left: 24px;
  }
  &.telegram {
    left: 80px;
    border: 2px solid #fff;

  }
  svg {
    width: 100%;
    height: 100%;
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
@media (max-width:768px) {
  .socials-btn {
    bottom: 94px;
    width: 32px;
    height: 32px;
    box-shadow:0 5px 10px rgba(0, 0, 0, 0.1);
  }
  .socials-btn.whatsapp {
    left: 12px;
  }
  .socials-btn.telegram {
    left: 48px;
    border-width:0;
  }

}
</style>
