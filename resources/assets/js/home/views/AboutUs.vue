<template>
  <div class="about-us">
    <div class="row">
      <div class="column right">
        <div>
          <h2>About Us</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
        <img src="img/14734.png" alt="">
      </div>

      <div class="column left">
        <img src="img/2471790.png" alt="">
        <div>
          <h2>About Us</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
      </div>
    </div>

    <div v-if="posts" class="latest-posts">
      <h2>Latest Posts</h2>
      <carousel
        class="latest-post-slider"
        :rtl="true"
        :autoplay="true"
        :autoplayTimeout="2000"
        :paginationEnabled="false"
        :navigationEnabled="false"
        :perPageCustom="[[320, 1], [768, 1], [769, 2]]"
      >
        <slide v-for="post in posts" class="latest-post-item" :key="post.id">
            <img src="img/2471790.png" alt="">
            <div class="content">
              <router-link :to="'/post/'+post.id">
                <h3>{{ post.title }}</h3>
              </router-link>
              <p>
                <span class="post-date">{{post.time}}</span>
                <span class="author">by {{post.author}}</span>
              </p>
            </div>
        </slide>
      </carousel>
    </div>

  </div>


</template>

<script>
import { Carousel, Slide } from 'vue-carousel';

export default {
  data() {
    return {
      posts : null
    }
  },
  created() {
    axios.post('/getRecentPosts').then(res => {
      this.posts = res.data;
      console.log(res.data);
    });
  },
  components : {
    Carousel,
    Slide
  }
}
</script>

<style lang="scss" scoped>
  .about-us {
    max-width:1440px;
    margin:32px auto 32px;
    padding:0 24px;
      .row {
        display: flex;
        flex-direction: row;
        margin-bottom: 32px;
        margin-right: 0;
        margin-left: 0;
        .latest-post-slider {
          flex-basis: 100%;
        }
        .column {
          flex-basis:50%;
          width:50%;
            h2 {
              font-size: 48px;
              font-weight: 700;
              color: #333;
            }
            p {
              font-size: 20px;
              color:#4f4f4f;
              line-height: 24px;
            }
            img {
              width:100%;
              display: block;

            }
          &.left {
            padding-right: 16px;
            img {
              margin-bottom: 48px;
            }
          }
          &.right {
            padding-left: 16px;
            img {
              margin-top: 48px;
            }
          }
        }
      }
      .latest-posts {
        h2 {
          color:#333;
          font-weight: 700;
          font-size: 40px;
          margin-bottom: 32px;
        }
        .latest-post-slider {
          .latest-post-item {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            justify-content: flex-start;
              img {
                width: 120px;
                height: 120px;
                object-fit: cover;
                object-position: center;
                margin-left: 16px;
              }
              .content {
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
                align-items: flex-start;
                padding-left: 24px;
                  a {
                    color:#333;
                  }
                  p {
                    align-items: center;
                    span {
                      display: inline-block;
                        &.author {
                          margin-right: 6px;
                          padding-right: 6px;
                          border-right: 1px solid #333;
                        }
                    }
                  }

              }
          }
        }
      }
  }
  @media (max-width:1024px) {
    .about-us {
      padding:0 12px;
      .row {
        flex-direction: column;
          .column {
            flex-basis:100%;
            width:100%;
            padding-right: 0!important;
            padding-left: 0!important;
            margin-bottom: 24px;
            text-align: justify;
              &.left {
                display: flex;
                flex-direction: column-reverse;
                margin-bottom: 0;
                  img {
                    margin-bottom: 0;
                  }
              }
          }
        }
        .latest-posts {
          h2 {
            font-size: 32px;
          }
          .latest-post-slider {
            .latest-post-item {
                img {
                  margin-left: 8px;
                }
                .content {
                  padding-left: 0;
                    a {
                      h3 {
                        margin-bottom: 0;
                      }
                    }
                    p {
                      font-size: 16px;
                    }
                }
            }
          }
        }
    }
  }
</style>
