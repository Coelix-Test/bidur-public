<template>
  <div v-if="post" class="single-post">
    <h1>{{ postData[1].value }}</h1>

    <pre style="direction:ltr;text-align:left;">{{postData}}</pre>

  </div>

</template>

<script>
export default {
  data() {
    return {
      post : null,
      //postId :
      postData : null
    }
  },
  created() {

    axios.post('/post/12'+this.$route.params.id).then(response => {
      this.post = response;
      this.postData = this.post.data.post;
    })
  }
}
</script>

<style lang="css" scoped>
</style>
