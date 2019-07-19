<template>
  <div class="recent-posts-mobile">
    <surveys mobile />
    <div class="latest-posts" v-if="false">
      <h2>חדשות נוספות</h2>

      <carousel
        v-if="posts"
        class="latest-post-slider"
        rtl
        autoplay
        navigationEnabled
        navigationNextLabel="<img src='img/icons8-prev-page.svg' />"
        navigationPrevLabel="<img src='img/icons8-prev-page.svg' />"
        :autoplayTimeout="4000"
        :paginationEnabled="false"
        :perPageCustom="[[320, 1], [550, 2], [768, 2], [769, 3]]"
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
    <div class="related-posts">
      <img src="/img/stars-posts.svg" alt="" class="stars">
      <h2>חדשות נוספות</h2>
      <carousel
        v-if="posts"
        :rtl="true"
        :perPageCustom="[[320, 1],[550, 1], [768, 2], [769, 3]]"
        navigationEnabled
        navigationNextLabel="<img src='img/chevron-to-left.svg' />"
        navigationPrevLabel="<img src='img/chevron-to-left.svg' />"
      >
        <slide v-for="(post, i) in posts" class="related-post" :key="post.id + '-' + i">
          <router-link :to="'/post/'+post.id+'/#'">


            <img :src="post.img" alt="">
            <div class="related-post-content">
              <h3>{{ post.title }}</h3>
              <p class="related-post-meta">
                <span class="author">{{post.author}}</span>
                <span class="date">{{  new Date(post.time*1000) | formatDate }}</span>

              </p>
              <p class="excerpt">
                {{ post.excerpt }}
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
    // margin-top: 24px;
    padding:12px 8px 0;
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
    height:200px;
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
    color: #F2C94C;
    font-size: 40px;
    font-weight: bold;
    margin-bottom: 32px;
    margin-top: 0;
    text-align: center;
    position: relative;
  }
  .latest-posts h2:after {
    content:'';
    width:60px;
    height:3px;
    background-color: #F2C94C;
    position: absolute;
    bottom:-12px;
    left:50%;
    transform: translateX(-50%);
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
  .latest-posts::v-deep .VueCarousel {
    padding: 0 16px;
  }
  .latest-posts::v-deep .VueCarousel .VueCarousel-navigation .VueCarousel-navigation-next {
    right:unset;
    left:0;
  }
  .latest-posts::v-deep .VueCarousel .VueCarousel-navigation .VueCarousel-navigation-prev {
    left:unset;
    right:0;
  }
  .latest-posts::v-deep .VueCarousel .VueCarousel-wrapper .VueCarousel-slide {
    padding:0 24px;
    box-sizing: border-box;
  }
  .latest-posts::v-deep .VueCarousel .VueCarousel-navigation .VueCarousel-navigation-button {
    width:40px;
    padding:0!important;
    height: 40px;
    outline:none;
    transform: translateX(0) translateY(-50%);
    z-index:2;
    padding: 8px 0 !important;
  }
  .latest-posts::v-deep .VueCarousel .VueCarousel-navigation .VueCarousel-navigation-button img {
    width:40px;
    height: 40px;
  }
  .latest-posts::v-deep .VueCarousel .VueCarousel-navigation .VueCarousel-navigation-next img {
    transform: rotate(180deg);
  }
  // .latest-posts::v-deep .VueCarousel  .VueCarousel-navigation .VueCarousel-navigation-prev {
  //   display: none;
  // }
  @media (max-width:768px) {
    // .latest-posts::v-deep .VueCarousel  .VueCarousel-navigation .VueCarousel-navigation-next {
    //   display:none;
    // }
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
      padding-left: 8px;
      padding-right: 8px;
      margin-bottom: 16px;
      margin-top: 46px;
    }
    .latest-post-item {
      overflow:hidden;
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
  .related-post {
    width: 100%;
    padding:0 24px;
    display: flex;
    flex-direction: row;
    align-items: flex-start;
    justify-content: flex-start;
    margin-top: 24px;
    text-decoration: none;
  }
  .related-post .author {
    color:#000;
    font-weight: 900;
  }
  .related-posts::v-deep .VueCarousel-dot-container {
    margin-top: 0!important;
    margin-bottom: 20px!important;
  }
  .related-posts::v-deep .VueCarousel-dot {
    margin-top: 10px!important;;
    padding: 7px!important;
  }
  .related-posts::v-deep .VueCarousel-dot.VueCarousel-dot--active {
    background-color: #FCD77E!important;

  }
  .related-posts::v-deep .VueCarousel-navigation-button {
    transform: scale(1.6) translateY(-50%);
    outline: none;
    margin:0!important;
    padding: 8px 0 !important;
  }
  .related-posts::v-deep .VueCarousel-navigation-prev {
    right: 0;
    left: unset;
  }
  .related-posts::v-deep .VueCarousel-navigation-prev img {
    transform:rotate(180deg);
  }
  .related-posts::v-deep .VueCarousel-navigation-next {
    left:0;
    right:unset;
  }
  .related-post img {
    height: 350px;
    object-fit: cover;
    width:100%;
  }
  .related-post a {
    text-decoration-color: #333;
    text-decoration: none;
    width:100%;
  }
  .related-posts .stars {
    display: none;
  }
  .related-post h3 {
    color:#F2C94C;
    text-decoration-color: #333;
    text-decoration: none;
    font-size: 20px;
    font-weight: 600;
  }
  .related-post-content {
    padding-right: 16px;
    color:#333333;
    padding-left: 16px;
  }
  .related-post-meta {
    color:#333;
    display:flex;
    align-items: center;
    justify-content: flex-start;
    flex-direction: row;
    white-space: nowrap;
    font-size: 14px;
    margin-bottom: 0;
  }
  .related-post-meta .date {
    padding-right: 6px;
    margin-right: 6px;
    border-right: 1px solid #333;

  }
  .related-post-content .excerpt {
    color:#828282;
    font-size: 16px;
  }
  .share {
    color:#333333;
    text-decoration-color:#333333;
  }
  .related-posts h2 {
      display: none;
  }
  @media (max-width:768px) {

    .related-posts h2 {
      display: block;
      position: relative;
      text-align: center;
      width:100%;
      font-size: 48px;
      font-weight: bold;
      color: #333;

    }
    .related-posts h2:after {
      content:'';
      position: absolute;
      background-image: linear-gradient(278.13deg, #87682C 0%, #FCD77E 100%);
      width:60px;
      height:6px;
      border-radius: 5px;
      bottom:-10px;
      left:50%;
      transform:translateX(-50%);
    }
    .related-posts {
      position: relative;
      margin-right: -8px;
      margin-left: -8px;
      margin-top: 24px;
    }
    .related-posts .stars {
      display: block;
      object-fit: contain;
      width:100%;
      // height: 100%;
      position: absolute;
      top:0;
      left: 0;
      right: 0;
      bottom: 0;
      pointer-events: none;
      z-index:-1;
    }

  }
</style>
