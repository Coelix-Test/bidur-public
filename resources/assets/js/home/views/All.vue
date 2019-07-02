<template>
  <main>
    <div class="main-content">
      <DefaultPost/>
      <QuadPost/>
      <DefaultPost/>
      <DefaultPost/>
      <QuadPost/>
      <DefaultPost/>
      <DefaultPost/>
    </div>
    <side-news/>
  </main>
</template>

<script>
import SideNews from './../components/SideNews.vue';
import DefaultPost from './../components/all/DefaultPost.vue';
import QuadPost from './../components/all/QuadPost.vue';

export default {
  components: {
    SideNews,
    DefaultPost,
    QuadPost,
  },
  created() {
    axios.post('/getAllPostsByHashtag', {
      hashtag_id: this.$route.params.id,
    }).then(res => {
      console.log(res.data);
    });
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
