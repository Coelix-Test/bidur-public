<template>
  <div v-if="post" class="single-post">
    <h1>{{ postData[1].value }}</h1>

    <pre style="direction:ltr;text-align:left;">{{post}}</pre>

  </div>

</template>

<script>
export default {
  data() {
    return {
      post : null,
      postData : null
    }
  },
  mounted() {

    axios.post('/post/'+this.$route.params.id).then(response => {
      console.log(response);
      this.post = response;
      this.postData = this.post.data.post;
    })
  }
}
</script>

<style lang="css" scoped>

</style>
