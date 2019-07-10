<template>
  <div class="my-account">
    <div class="my-account-wrapper">
      <h1>החשבון שלי</h1>
      <h2>מידע</h2>
      <router-link :to="'/edit-profile'">ערוך מידע</router-link>
      <div v-if="favoritePosts" class="favorites">
        <h2>הודעות מועדפות</h2>
        <ul v-if="favoritePosts">
          <li v-for="post in favoritePosts" class="single-post">
            <div class="thumbnail">
              <img :src="post.img">
            </div>
            <div class="postData">
              <button class="remove-from-favorites" @click="removeFromFavourites(post.id)">
                <img src="/img/Star.svg" alt="remove-from-favourites">
                 הסר ממועדפים
              </button>
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
        }).catch(error => {
          this.favoritePosts = null;
        });
  },
  methods : {
    removeFromFavourites(id) {
      axios
        .post('/deletePostFromFavourites',{ postId : id})
          .then(res => {
            // console.log(res);
            alert('Post deleted from favourites!');
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
      flex-grow:2;
      padding-left: 24px;
      h1 {
        font-weight:700;
        color:#333;
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
            padding:16px 12px;
            box-shadow:0px 0px 8px rgba(0, 0, 0, 0.1);
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
            .post-meta {
              color:#333;
              .author {
                padding-right: 6px;
                margin-right: 6px;
                border-right: 1px solid #333;
              }
            }
            h3 {
              a {
                color: #333;
                font-weight: 600;
                text-decoration-color: #333;
              }
            }
            .remove-from-favorites {
              white-space:nowrap;
              border-width: 0;
              color: #F2C94C;
              display: flex;
              flex-direction: row;
              align-items: flex-start;
              justify-content: flex-start;
              font-size: 18px;
              font-weight: 700;
              background-color: #fff;
              padding-right: 0;
              img {
                width: 24px;
                height: 24px;
                margin-left: 4px;
                pointer-events: none;
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
      padding:24px 12px;
      .my-account-wrapper {
        width:100%;
        padding-left: 0;
        .favorites {
          width:100%;
          ul {
            li.single-post {
              padding: 12px;
              flex-direction: column;
              .thumbnail {
                width:100%;
                margin-left: 0;
                margin-bottom: 8px;
              }
            }
          }
        }
      }
    }
  }
</style>
