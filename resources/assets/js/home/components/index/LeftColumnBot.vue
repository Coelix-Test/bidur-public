<template>
  <div class="left-column-bot">
    <h2>חדשות נוספות</h2>
    <ul ref="test" class="latest-post-slider">
      <li v-if="posts" v-for="post in posts">
        <router-link  :to="'/post/'+post.id">

          <img :src="post.img" alt="">
          <div class="content">
            <h3>{{ post.title }}</h3>
            <p>
              <span class="author">by {{post.author}}</span>
              <span class="post-date">{{post.time}}</span>
            </p>
          </div>

        </router-link>

      </li>
    </ul>
    <div class="instagram-post">
      <a href="https://instagram.com/motowelove" target="_blanc">
        <img src="/img/leo.png" alt="">
      </a>
    </div>
  </div>
</template>

<script>
export default {
  props : {
    data : {
      requred: true,
    }
  },
  data() {
    return {
      posts : [],
    }
  },
  created() {

    let getAllPosts = [];
    this.data.forEach( (el)=> {
      getAllPosts.push(axios.post('/getInfoOnPostForMain', {id : el} ).then(response => {
         this.posts.push(response.data);
       }));
    });

    Promise.all(getAllPosts).then(() => {
      $(this.$refs.test).slick({
        rtl: true,
        dots: false,
        slidesToShow: 2,
        slidesToScroll: 2,
        arrows : false,
        autoplay : true,
        autoplaySpeed : 4000,
        responsive: [
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            }
          },
        ]

      });
    })
  },
  mounted() {

  }
}
</script>

<style lang="css" scoped>
  .left-column-bot {
    flex-basis:50%;
    width:50%;
    padding-right: 8px;

    /* opacity: 0;
    transition: transform 1s ease, opacity 1s ease;
    transform: translateY(100px); */
  }
  .left-column-bot.in-viewport {
    transform: translateY(0);
    opacity: 1;
  }
  .instagram-post {
    /* max-height: 700px; */
    margin-top: 16px;
  }
  .instagram-post a {
    width:100%;
    height:100%;
  }
  .instagram-post img {
    width:100%;
    height:100%;
    object-fit: cover;
    object-position: center;
  }
  .latest-post-slider {
    width:100%;
    margin:0;
    padding:0;
  }
  .latest-post-slider li {
    padding-left: 16px;
    outline: none;
  }
  .latest-post-slider li a {
    width:100%;
    height:100%;
    display: flex;
    flex-direction: row;
    align-items: flex-start;
    justify-content: flex-start;
    color:#333333;
    text-decoration: none;
  }
  .latest-post-slider li a img {
    width:120px;
    height:120px;
    object-fit: cover;
    object-position: center;
    margin-left: 16px;
  }
  .latest-post-slider li a p {
    font-size: 12px;
    text-transform: uppercase;
    display: flex;
    flex-direction: row;
  }
  .latest-post-slider li a p .post-date {
    color:#B3AAAA;
    padding-right: 4px;
    border-right: 1px solid #B3AAAA;
    margin-right: 4px;
    white-space:nowrap;
  }
  .latest-post-slider li a p .author {
    color:black;
    white-space:nowrap;
  }
  .latest-post-slider li a h3 {
    font-size: 20px;
    margin-bottom: 0;
  }
  h2 {
    color:#333333;
    font-size: 30px;
    font-weight: bold;
    margin-bottom: 32px;
  }
  @media (max-width:768px) {
    .left-column-bot {
      order: 4;
      flex-basis:100%;
      width:100%;
      padding-right: 0;
    }
    .latest-post-slider li {
      padding-left: 0;
    }
    h2 {
      margin-bottom: 16px;
    }
  }
  @media (max-width: 550px) {
    .instagram-post {
      margin-top: 8px;
    }
  }
</style>
