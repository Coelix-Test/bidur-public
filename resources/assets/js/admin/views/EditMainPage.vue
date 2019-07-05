<template>
  <div class="edit-main-page">
    <div class="section">
        <div class="heading">Birthday Category</div>
        <birthday-section class="shadow-section"></birthday-section>
    </div>

    <div class="section">
        <div class="heading">Posts</div>
        <posts-tile-section class="shadow-section"></posts-tile-section>
    </div>
  </div>
</template>

<script>
import BirthdaySection from './../components/main-page/BirthdaySection.vue';
import PostsTileSection from './../components/main-page/PostsTileSection.vue';

export default {
    data(){
        return {};
    },
    components: {
        BirthdaySection,
        PostsTileSection
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
