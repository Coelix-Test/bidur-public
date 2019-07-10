<template>
  <div class="my-account">
    <div class="my-account-wrapper">
      <h1>my-account</h1>
      <h2>Information</h2>
      <router-link :to="'/edit-profile'">Edit Information</router-link>
      <div class="favorites">
        <h2>Favorite Posts</h2>
        <ul v-if="favoritePosts">
          <li v-for="post in favoritePosts" class="single-post">
            <div class="thumbnail">
              <img :src="post.img">
            </div>
            <div class="postData">
              <button @click="removeFromFavourites(post.id)">remove</button>
              <h3><router-link :to="`/post/${post.id}`">{{ post.title }}</router-link></h3>
              <div class="post-meta">
                <span class="date">{{ new Date(post.time*1000) | formatDate }}</span>
                <span class="author">{{ post.author }}</span>
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
      .post('/getAllFavourites',{page : 0})
        .then(res => {
          this.favoritePosts = res.data;
        });
  },
  methods : {
    removeFromFavourites(id) {
      axios
        .post('/deletePostFromFavourites',{ postId : id})
          .then(res => {
            console.log(res);
          });
    }
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
        ul {
          margin:0;
          padding:0;
          display: flex;
          flex-direction: column;
          li.single-post {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            justify-content: flex-start;
            margin-bottom: 16px;
            .thumbnail {
              width:200px;
              height:200px;
              margin-left: 16px;
              img {
                object-fit: cover;
                height:100%;
                width: 100%;
              }
            }
          }
        }
      }
    }


  }
  @media (max-width:768px) {
    .my-account {
      flex-direction: column;
    }
  }
</style>
