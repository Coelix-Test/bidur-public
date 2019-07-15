<template>
  <div class="recent-posts-mobile">
    <surveys mobile />
    <div class="latest-posts">
      <h2>חדשות נוספות</h2>

      <carousel
        v-if="posts"
        class="latest-post-slider"
        rtl
        autoplay
        navigationEnabled
        navigationNextLabel="<img src='img/icons8-next-page.svg' />"
        :autoplayTimeout="4000"
        :paginationEnabled="true"
        :perPageCustom="[[320, 2], [768, 2], [769, 3]]"
      >
        <slide v-for="post in posts" class="latest-post-item" :key="post.id">
          <router-link :to="'/post/'+post.id">
            <img :src="post.img" alt="">
            <div class="content">
                <h3>{{ post.title }}</h3>
              <p>
                <span class="author">{{post.author}}</span>
                <span class="post-date">{{ new Date(post.time*1000) | formatDate }}</span>
              </p>
            </div>
          </router-link>
        </slide>
      </carousel>
    </div>
  </div>
</template>

<script>
import { Carousel, Slide } from 'vue-carousel';
import Surveys from './Surveys';
// import VuePoll from 'vue-poll'
// import LikeSurvey from './../common/LikeSurvey'
// import OneSurvey from './../common/OneSurvey'

export default {
  data() {
    return {
      posts : [],
      survey : null,
      windowWidth : document.documentElement.clientWidth,
    }
  },
  created() {
    axios.post('/getRecentPosts').then(res => {
      this.posts = res.data;
    });
    // axios.post('/getServiceForMainPageSecond').then(res => {
    //   this.survey = res.data;
    // });
  },
  methods : {
    // addVote(obj, id){
    //   console.log(obj);
    //   axios
    //     .post('/addSurveyVote',{ surveyId : id, answer : obj.value })
    //       .then(response => {
    //
    //       });
    // }
  },
  components: {
    Carousel,
    Slide,
    Surveys
  },
}
</script>

<style lang="scss" scoped>
  .latest-posts {
    width:100%;
    max-width: 100%;
    overflow: hidden;
    //background: rgba(196, 196, 196, 0.1);
    //border-right: 6px solid #F2C94C;
    margin-top: 24px;
    padding:24px 8px;
  }
  .latest-posts .heading {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    margin:0 0 32px;
  }
  .latest-posts .heading button {
    font-size: 20px;
    padding:4px 16px;
    color:#fff;
    /* border-color:transparent; */
    border-style: hidden;
    border-width:2px;
    background: linear-gradient(290.47deg, #D3A01D 1.57%, #F2C94C 98.82%);
    border-radius: 5px;
    font-weight: 600;
    background-clip: border-box;
    box-sizing: border-box;
  }
  .latest-posts .heading button:hover {
    color:#F2C94C;
    background: rgba(196, 196, 196, 0.1);
    border-style:solid;
    border-color: #F2C94C;
  }
  .latest-post-slider {
    width:100%;
    margin:0;
    padding:0;
    /* max-width: 600px; */
  }
  .latest-post-item {
    padding-left: 16px;
    outline: none;
  }
  .latest-post-item a {
    text-decoration: none;
    color:#333;
  }
  .latest-post-item {
    width:100%;
    height:100%;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-content: flex-start;
    color:#333333;
    text-decoration: none;
    padding:0 8px;
  }
  .latest-post-item  img {
    width:100%;
    height:120px;
    object-fit: cover;
    object-position: center;
    margin-left: 0;
  }
  .latest-post-item p {
    font-size: 12px;
    text-transform: uppercase;
    display: flex;
    flex-direction: row;
    align-items: flex-start;
  }
  .latest-post-item p .post-date {
    color:#B3AAAA;
    padding-right: 4px;
    border-right: 1px solid #B3AAAA;
    margin-right: 4px;
    white-space:nowrap;
    line-height: 12px;
  }
  .latest-post-slider .VueCarousel-dot:focus {
    outline: none!important;
  }
  .latest-post-item p .author {
    color:black;
    line-height: 12px;
    // white-space:nowrap;
  }
  .latest-post-item h3 {
    font-size: 18px;
    line-height: 16px;
    margin-bottom: 4px;
    color:#333;
    word-break: break-all;
    font-weight: 700;
  }
  .latest-post-item h3 {
    color:#333;
    text-decoration-color: #333;
  }
  .latest-posts h2 {
    color:#333333;
    font-size: 40px;
    font-weight: bold;
    margin-bottom: 32px;
    margin-top: 0;
    text-align: center;
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
  .latest-posts::v-deep .VueCarousel  .VueCarousel-navigation .VueCarousel-navigation-next {
    right:unset;
    left:16px;
    outline:none;
    transform: translateX(0) translateY(-50%);
    width:40px;
    padding:0;
    height: 40px;
  }
  .latest-posts::v-deep .VueCarousel  .VueCarousel-navigation .VueCarousel-navigation-next img {
    width:40px;
    height: 40px;
  }
  .latest-posts::v-deep .VueCarousel  .VueCarousel-navigation .VueCarousel-navigation-prev {
    display: none;
  }
  @media (max-width:768px) {
    .latest-posts::v-deep .VueCarousel  .VueCarousel-navigation .VueCarousel-navigation-next {
      display:none;
    }
    .selected-poll {
      margin-bottom: 8px;
    }
    .latest-post-item {
      padding-left: 0;
    }
    h2 {
      margin-bottom: 16px;
    }
  }
  @media (max-width:768px) {
    .recent-posts-mobile {
      order: 6;
      flex-basis:100%;
      width:100%;
      padding-left: 0;
      margin-bottom: 16px;
      margin-top: 46px;
    }
    .latest-post-item p {
      // flex-direction: column;
    }
    .latest-post-item p span:first-child {
      padding-bottom: 8px;
    }
  }
  @media (max-width:550px) {
    .right-column-bot {
      margin-top: 0;
    }
  }

  .like-survey {
    background: #FFFFFF;
    box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
    margin-bottom: 50px;
  }
  .one-survey {
    background: #FFFFFF;
    box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
    margin-bottom: 50px;
  }
</style>
