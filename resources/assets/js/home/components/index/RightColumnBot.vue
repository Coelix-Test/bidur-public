<template>
  <div class="right-column-bot">
    <div class="selected-poll">
      <img src="img/rihanna.png" alt="">
      <vue-poll class="poll" v-bind="options" @addvote="addVote"/>
    </div>
    <div class="latest-posts">
      <h2>חדשות נוספות</h2>
      <!-- <ul ref="test" class="latest-post-slider">
        <li v-if="posts" v-for="post in posts">

            <img :src="post.img" alt="">
            <div class="content">
              <router-link :to="'/post/'+post.id">
                <h3>{{ post.title }}</h3>
              </router-link>
              <p>
                <span class="author">by {{post.author}}</span>
                <span class="post-date">{{post.time}}</span>
              </p>
            </div>
        </li>
      </ul> -->
      <carousel
        v-if="posts"
        class="latest-post-slider"
        :rtl="true"
        :autoplay="true"
        :autoplayTimeout="2000"
        :paginationEnabled="false"
        :navigationEnabled="true"
        :perPageCustom="[[320, 1], [768, 1], [769, 2]]"
      >
        <slide v-for="post in posts" class="latest-post-item" :key="post.id">
            <img :src="post.img" alt="">
            <div class="content">
              <router-link :to="'/post/'+post.id">
                <h3>{{ post.title }}</h3>
              </router-link>
              <p>
                <span class="author">by {{post.author}}</span>
                <span class="post-date">{{post.time}}</span>
              </p>
            </div>
        </slide>
      </carousel>
    </div>

  </div>
</template>

<script>
import { Carousel, Slide } from 'vue-carousel';
import VuePoll from 'vue-poll'
export default {
  props : {
    data : {
      requred: true,
    }
  },
    data() {
        return {
            posts : [],
            options: {
                question: 'מה חשבתם על ההופעה האחרונה של ריהנה',
                answers: [
                    { value: 1, text: 'Supper, it is wonder news!', votes: 53 },
                    { value: 2, text: 'Normal, i know it', votes: 35 },
                    { value: 3, text: 'Oh my God, what is it!!??', votes: 30 },
                    { value: 4, text: 'Oh my God, what is it!!??', votes: 10 }
                ]
            }
        }
    },
    created() {
       let getAllPosts = [];
        axios.post('/getRecentPosts').then(response => {

           getAllPosts = response.data;
           this.posts = getAllPosts;
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
    components: {
        VuePoll,
        Carousel,
        Slide
    },
    methods: {
        addVote(obj){
            console.log(obj);
        }
    },
}
</script>

<style lang="css" scoped>
  .right-column-bot {
    flex-basis:50%;
    padding-left: 8px;
    /* max-width: 500px; */

  }
  .selected-poll {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    overflow: hidden;
    background: #FFFFFF;
    box-sizing: border-box;
    border:4px solid #E4A913;
    box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);

    /* opacity: 0;
    transition: transform 1s ease, opacity 1s ease;
    transform: scale(0.8); */
  }
  .selected-poll.in-viewport {
    /* transform: scale(1);
    opacity: 1; */
  }
  .selected-poll img {
    width:100%;
    height:auto;
    max-width:100%;
    object-fit: cover;
    margin-bottom: 0;
  }
  .poll {
    width:100%;
  }
  .selected-poll h3 {
    padding-top: 32px;
    font-size: 32px;
    color:#0E0E0E;
    margin:0;
    background: linear-gradient(270deg, #E4A913 0%, #EED074 99.53%);
    padding-bottom: 32px;
  }
  .latest-posts {
    width:100%;
    max-width: 100%;
    overflow: hidden;
  }
  .latest-post-slider {
    width:100%;
    margin:0;
    padding:0;
    max-width: 600px;
  }
  .latest-post-item {
    padding-left: 16px;
    outline: none;
  }
  .latest-post-item {
    width:100%;
    height:100%;
    display: flex;
    flex-direction: row;
    align-items: flex-start;
    justify-content: flex-start;
    color:#333333;
    text-decoration: none;
  }
  .latest-post-item  img {
    width:120px;
    height:120px;
    object-fit: cover;
    object-position: center;
    margin-left: 16px;
  }
  .latest-post-item p {
    font-size: 12px;
    text-transform: uppercase;
    display: flex;
    flex-direction: row;
  }
  .latest-post-item p .post-date {
    color:#B3AAAA;
    padding-right: 4px;
    border-right: 1px solid #B3AAAA;
    margin-right: 4px;
    white-space:nowrap;
  }
  .latest-post-item p .author {
    color:black;
    white-space:nowrap;
  }
  .latest-post-item h3 {
    font-size: 20px;
    margin-bottom: 0;
    color:#333;
  }
  .latest-post-item a {
    color:#333;
    text-decoration-color: #333;
  }
  .latest-posts h2 {
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
    .latest-post-item {
      padding-left: 0;
    }
    h2 {
      margin-bottom: 16px;
    }
  }
  @media (max-width:768px) {
    .right-column-bot {
      order: 3;
      flex-basis:100%;
      padding-left: 0;
      margin-bottom: 16px;
      margin-top: 8px;
    }
  }
  @media (max-width:550px) {
    .right-column-bot {
      margin-top: 0;
    }
  }
</style>
