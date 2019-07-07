<template>
  <main class="edit-post">
    {{post}}
    <edit-post-header />
  </main>
</template>

<script>
import EditPostHeader from './../components/posts/EditPostHeader.vue';
import PostTitle from './../components/posts/PostTitle.vue';
import PostText from './../components/posts/PostText.vue';
import PostImage from './../components/posts/PostImage.vue';
import PostImageText from './../components/posts/PostImageText.vue';
import PostVideoLink from './../components/posts/PostVideoLink.vue';
import PostSurvey from './../components/posts/PostSurvey.vue';
import PostAssessment from './../components/posts/PostAssessment.vue';
import PostSelection from './../components/posts/PostSelection.vue';

export default {
  data() {
    return {
      postId : this.$route.params.id,
      post : null
    }
  },
  methods : {

  },
  created() {
    // console.log(this.postId);
    axios
      .post('/post/'+this.postId)
        .then(res => {
          this.post = res.data;
          console.log(res.data);
        })
  },
  components : {
    EditPostHeader,
    PostTitle,
    PostText,
    PostImageText,
    PostVideoLink,
    PostSurvey,
    PostAssessment,
    PostSelection
  }
}
</script>

<style lang="scss" scoped>
  .edit-post {
    margin: 0 auto;
    padding:32px 24px;
    max-width:1440px;
  }
</style>
