<template>
  <section class="side-news">
    <div class="block">
      <side-news-post/>
      <side-news-post/>
      <side-news-post/>
    </div>
    <img
      class="banner"
      src="https://via.placeholder.com/380x600"
    >
    <div class="block">
      <side-news-post/>
      <side-news-post/>
      <side-news-post/>
    </div>
  </section>
</template>

<script>
import SideNewsPost from './SideNewsPost.vue'

export default {
  components: {
    SideNewsPost,
  }
}
</script>

<style lang="scss" scoped>

.side-news {
  display: flex;
  flex-direction: column;
  align-items: stretch;
  width: 380px;
  padding-right: 30px;
  .block {
    background: #FFFFFF;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: stretch;
    margin-bottom: 30px;
  }
  .banner {
    width: 100%;
    height: auto;
    margin-bottom: 30px;
  }
}

</style>
