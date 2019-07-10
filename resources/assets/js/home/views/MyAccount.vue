<template>
  <div class="my-account">
    <div class="my-account-wrapper">
      <h1>my-account</h1>
      <h2>Information</h2>
      <router-link :to="'/edit-profile'">Edit Information</router-link>
      <div class="favorites">
        <h2>Favorite Posts</h2>
        <ul v-if="favoritePosts">
          <li v-for="post in favoritePosts">
            <div class="thumbnail">
              <!-- <img :src="post.post"> -->
            </div>
            <div class="postData">
              <h3><router-link :to="`/post/${post.post.id}`">{{post.post.metaTitle}}</router-link></h3>
              <div class="post-meta">
                <span class="date">{{post.post.created_at | formatDate}}</span>
                <span class="author">{{ post.post.author }} | </span>
              </div>
            </div>

          </li>
        </ul>
      </div>
    </div>

    <!-- <a href=""></a> -->
    <side-news />
  </div>

</template>

<script>
import SideNews from './../components/SideNews.vue'

export default {
  data() {
    return {
      favoritePosts : null,

    }
  },
  created() {
    axios
      .post('/getAllPosts')
        .then(res => {
          console.log(res.data);
          this.favoritePosts = res.data;
        });
  },
  components : {
    SideNews,
  }
}
</script>

<style lang="scss" scoped>
  .my-account {
    margin:0 auto;
    padding:32px 24px;
    max-width: 1440px;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    .my-account-wrapper {
      h1 {
        font-weight:700;
      }
      .edit-profile {

      }
      .favorites {

      }
    }


  }
  @media (max-width:768px) {
    .my-account {
      flex-direction: column;
    }
  }
</style>
