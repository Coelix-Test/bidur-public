<template>
  <div v-if="post" class="single-post">
    <div class="post-content">
      <h1>{{ postData[1].value }}</h1>
      <!-- <pre style="direction:ltr;text-align:left;">{{post}}</pre> -->
      <div :class="section.type" v-for="section in postData">
        {{section}}
      </div>
    </div>



    <side-news />
  </div>

</template>

<script>
import SideNews from './../components/SideNews.vue'
export default {
  data() {
    return {
      post : null,
      postData : null
    }
  },
  mounted() {
    axios.post('/getSelectedPosts').then(response => {console.log(response);})
    axios.post('/post/'+this.$route.params.id).then(response => {
      //console.log(response);
      this.post = response;
      this.postData = this.post.data.post;
    })
  },
  components : {
    SideNews
  }
}
</script>

<style lang="css" scoped>
  .single-post {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    padding: 0 24px;
  }
  .post-content {
    flex-grow:2;
    display: flex;
    flex-direction: column;
  }
</style>
