<template>
  <main>
    <div class="main-content">
      <emoji/>
      <template v-for="(item, i) in data">
        <DefaultPost :data="item" v-if="!isQuad(i)"/>
        <QuadPost :data="item" v-else/>
      </template>
    </div>
    <side-news/>
  </main>
</template>

<script>
import SideNews from './../components/SideNews.vue';
import DefaultPost from './../components/all/DefaultPost.vue';
import QuadPost from './../components/all/QuadPost.vue';
import Emoji from './../components/single-post/Emoji.vue';

export default {
  data() {
    return {
      data: [],
    };
  },
  components: {
    SideNews,
    DefaultPost,
    QuadPost,
    Emoji,
  },
  methods: {
    isQuad(index) {
      return (index + 1) % 3 == 0;
    },
    sync(id) {
      return axios.post('/getAllPostsByHashtag', {
        hashtag_id: id,
      }).then(res => {
        this.data = res.data;
      });
    }
  },
  created() {
    this.sync(this.$route.params.id);
  },
  beforeRouteUpdate(to) {
    this.sync(to.params.id);
  }
}
</script>

<style lang="scss" scoped>

main {
  display: flex;
  flex-direction: row;
  justify-content: flex-start;
  align-items: flex-start;
  padding: 0 30px;
  margin:32px auto 0;
  max-width:1440px;
  .main-content {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    align-items: stretch;
    justify-content: flex-start;
  }
  @media(max-width: 992px) {
    flex-direction: column;
    padding: 0 10px;
  }
}

</style>
