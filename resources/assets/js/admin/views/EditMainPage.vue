<template>
  <div class="edit-main-page">
    <div class="section">
      <div class="heading">סקשן יום הולדת</div>
      <birthday-section class="shadow-section"></birthday-section>
    </div>

    <div class="section">
      <div class="heading">פוסטים נעוצים</div>
      <posts-tile-section class="shadow-section"></posts-tile-section>
    </div>

    <instagram/>

    <surveys/>

    <surveys mobile/>
  </div>
</template>

<script>
import BirthdaySection from './../components/main-page/BirthdaySection.vue';
import PostsTileSection from './../components/main-page/PostsTileSection.vue';
import Instagram from './../components/main-page/Instagram.vue';
import Surveys from './../components/main-page/Surveys.vue';

export default {
  data(){
    return {};
  },
  components: {
    BirthdaySection,
    PostsTileSection,
    Instagram,
    Surveys,
  },
  methods: {

  }
}
</script>

<style lang="scss" scoped>

@import "~@/vars.scss";

.edit-main-page {
  max-width: 1440px;
  padding: 0 24px;
  margin:32px auto;
  display: -webkit-flex;
  display: -ms-flex;
  display: flex;
  -webkit-flex-wrap: wrap;
  -ms-flex-wrap: wrap;
  flex-wrap: wrap;
  justify-content: space-between;
  .section{
      width: 49%;
  }
}
.title{
  font-size: $fzTitle;
  font-weight: 700;
}
</style>
