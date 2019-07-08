<template>
  <section class="side-news">
    <div class="block">
      <side-news-post
        v-for="(item, i) in data"
        :key="item.id"
        :data="item"
        v-if="i <= 4"
      />
    </div>
    <img
      class="banner"
      src="https://via.placeholder.com/380x600"
    >
    <div class="block">
      <side-news-post
        v-for="(item, i) in data"
        :key="item.id"
        :data="item"
        v-if="i > 4 && i < 10"
      />
    </div>
  </section>
</template>

<script>
import SideNewsPost from './SideNewsPost.vue'

export default {
  data() {
    return {
      data: []
    };
  },
  components: {
    SideNewsPost,
  },
  created() {
    axios.post('/getRecentPosts').then(res => {
      this.data = res.data;
    });
  }
}
</script>

<style lang="scss" scoped>

.side-news {
  display: flex;
  flex-direction: column;
  align-items: stretch;
  width: 380px;
  min-width: 380px;
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

  @media(max-width: 992px) {
    padding-right: 0;
    width: 100%;
    min-width:unset;
  }
}

</style>
