<template>
  <div class="single-post">
    <div class="post-wrapper">

      <single-post-example v-if="errorMessage" />
      <div v-if="post" class="post-content">
        <nav>

          <router-link v-if="prevPostId" class="prev-post"  :to="'/post/' + prevPostId">
            <img src="/img/arrow-right.svg">
            Prev News
          </router-link>
          <router-link v-if="nextPostId" class="next-post"  :to="'/post/'+nextPostId">
            Next News
            <img src="/img/arrow-left.svg">
          </router-link>
        </nav>

        <h1 v-if="post.data.post.mainTitle">{{ post.data.post.mainTitle }}</h1>
        <div class="post-meta">

          <div class="info">
            <span class="author">{{ post.data.post.author }}</span>
            <span class="date">{{ post.data.post.date }}</span>
          </div>
          <share />

        </div>
        <section :class="post.type" v-for="post in postData" >

          <h2 v-if="post.type == 'title'"> {{ post.value }}</h2>

          <div v-if="post.type == 'content'" v-html="post.value"></div>

          <p v-if="post.type == 'image'">
            <img :src="post.value" alt="">
            <span>{{post.description}}</span>
          </p>


          <div v-if="post.type == 'survey'" class="poll">
            <img :src="post.img" alt="">
            <vue-poll v-bind="post.value" @addvote="addVote($event, post.id)"/>
          </div>
          <div v-else-if="post.type == 'compare'" class="poll">
            <one-survey :data="post.value"/>
          </div>
          <div v-else-if="post.type == 'likableImage'" class="poll">
            <like-survey :data="post.value"/>
          </div>


          <iframe
            v-if="post.type == 'video'"
            id="ytplayer"
            type="text/html"
            :src="post.value"
            frameborder="0"
          />

          <div v-if="post.type == 'imageWithText'">
            <img v-if="post.url" :class="post.imagePosition" :src="post.url" :alt="post.title">
            <h2 v-if="post.title">{{ post.title }}</h2>
            <p v-if="post.content">{{post.content}}</p>
          </div>

          <!-- <div v-if="post.type == ''"></div> -->

        </section>



        <div class="opinion">
          <h2>Your opinion</h2>
          <div class="emoji-wrapper">
            <emoji v-if="postId" :postId="postId" />
          </div>
        </div>
      </div>



      <side-news />
    </div>
    <div class="related-posts">

      <carousel v-if="relevantPosts" :rtl="true" :perPageCustom="[[320, 1], [768, 1], [769, 2]]">
        <slide v-for="post in relevantPosts" class="related-post" :key="post.id">
            <img :src="post.img" alt="">
            <div class="related-post-content">
              <router-link :to="'/post/'+post.id+'/#'"><h3>{{ post.title }}</h3></router-link>
              <p class="related-post-meta">
                <span class="date">{{post.time}}</span>
                <span class="author">by {{post.author}}</span>
              </p>
              <p class="excerpt">
                {{ post.excerpt }}
              </p>
            </div>
        </slide>
      </carousel>

    </div>
  </div>


</template>

<script>

import VuePoll from 'vue-poll'
import Share from './../components/single-post/Share.vue'
import Emoji from './../components/single-post/Emoji.vue'
import SinglePostExample from './../components/SinglePostExample.vue'
import SideNews from './../components/SideNews.vue'
import { Carousel, Slide } from 'vue-carousel'
import LikeSurvey from './../components/common/LikeSurvey'
import OneSurvey from './../components/common/OneSurvey'

export default {
  data() {
    return {
      post : false,
      postData : null,
      prevPostId : null,
      nextPostId : null,
      postTitle : null,
      errorMessage : false,
      hashtags : null,
      relevantPosts : [],
      postContentSections : null,
      postId : null,
    }
  },
  methods : {
    changePost($event, id) {
      event.preventDefault()
      this.sync(id);
      this.postId = id;
      this.$router.push({ path : `/post/${id}` });
    },
    computeNumber(value) {
      // console.log(value);
    },
    sync(id) {
      return axios
        .post('/post/'+id)
          .then(response => {
            console.log(response.data);

            this.post = response;
            this.errorMessage = false;
            this.postId = id;
            this.postData = this.post.data.post.sections;
            this.postTitle = this.postData[1].value;
            this.hashtags = this.post.data.post.hashtags;
             if(this.hashtags != null) {
               var relevantPosts = [];
              for(let i =0;i < this.hashtags.length;i++) {
                axios
                  .post('/getAllRelevantPosts', {hashtag_id: this.hashtags[i],})
                    .then(response => {
                      this.relevantPosts = response.data;
                      // console.log('response', this.relevantPosts);
                    })
              }

            }
            this.prevPostId = (response.data.previousPost) ? response.data.previousPost.toString() : false ;
            this.nextPostId = (response.data.nextPost) ? response.data.nextPost.toString() : false ;
          })
          .catch(error => {
            console.log('error');
            this.errorMessage = true;
            this.post = false;
          });
    },
    addVote(obj, id){
        // console.log(obj);
        // console.log(id);
        axios
          .post('/addSurveyVote',{ surveyId : id, answer : obj.value })
            .then(response => {
              // console.log(response);
            });
    }
  },
  created() {

    this.sync(this.$route.params.id);
    this.postId = this.$route.params.id;
  },
  beforeRouteUpdate(to, from, next) {
    this.sync(to.params.id);
    this.postId = to.params.id;
    next();
  },
  components : {
    SideNews,
    VuePoll,
    Carousel,
    Slide,
    SinglePostExample,
    Share,
    Emoji,
    LikeSurvey,
    OneSurvey,
  }
}

</script>

<style lang="css" scoped>
  .post-wrapper {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    padding: 0 24px;
    max-width:1440px;
    margin:32px auto 0;
  }
  .post-content {
    flex-grow:2;
    display: flex;
    flex-direction: column;
  }
  .post-content nav {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
  }
  .post-content nav a {
    color:#BDBDBD;
    font-size: 18px;
  }
  .post-content nav .next-post {
    flex-grow:2;
    text-align: left;
  }
  .post-content h1 {
    color:#333333;
    margin-bottom: 16px;
  }
  .post-meta {
    display: flex;
    margin-bottom: 16px;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
  }
  .poll img {
    width:100%;
    object-fit: cover;
    margin-bottom: 0;
  }
  .post-meta .info a,
  .post-meta .info {
    color:#333;
    font-size: 16px;
  }
  .post-meta .info .author {
    padding-right: 4px;
    margin-right: 4px;
    border-right: 1px solid #333;
  }
  .post-content section {
    margin-bottom: 16px;
  }
  .post-content {
    color:#333;
  }
  section h2 {
    padding-right: 6px;
    border-right: 5px solid #F2C94C;
    font-weight: 600;
  }
  section.image img {
    max-width: 100%;
    object-fit: cover;
    margin-bottom: 12px;
    display: block;
  }
  section.image span {
    max-width:500px;
    font-style: italic;
    font-weight: bold;
    font-size: 18px;
    line-height: 24px;
    color:#333;
  }
  section.imageWithText img {
    max-width:50%;
  }
  section.imageWithText img.right {
    float:right;
    margin-left: 16px;
  }
  section.imageWithText img.left {
    float:left;
    margin-right: 16px;
  }
  section.imageWithText h2 {
    color:#333;
    margin-bottom: 16px;
  }
  section.video iframe {
    width:100%;
    height:450px;
  }
  section.image p {
    font-size: 16px;
  }
  section.image p:last-child {
    margin-bottom: 0;
  }
  section.text p {
    /* margin-bottom: ; */
    color:#4F4F4F;
    font-size: 18px;
  }
  section.text p:last-child {
    margin-bottom: 0;
  }
  section.sub-title h2 {
    margin-bottom: 0;
    color:#333;
    font-size: 36px;
  }
  section.survey {
    background: #FFFFFF;
    box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
    margin-bottom: 24px;
    padding:0 0 0;
    border:4px solid #E4A913;
  }
  section.survey {
    max-width: 550px;
  }
  .opinion {

  }
  .post-content section:last-of-type {
    padding-bottom: 32px;
    /* margin-top: 32px; */
    border-bottom: 1px solid #BDBDBD;
  }
  .img-subtext {
    max-width: 600px;
    color:#333;
    font-style: italic;
    margin-bottom: 0;
  }
  .related-posts {
    width: 100%;
    padding:0 24px;
  }
  .related-post {
    display: flex;
    flex-direction: row;
    align-items: flex-start;
    justify-content: flex-start;
    margin-top: 24px;
    text-decoration: none;
  }
  .related-post img {
    width: 220px;
    height: 180px;
    object-fit: cover;
  }
  .related-post a {
    text-decoration-color: #333;
  }
  .related-post h3 {
    color:#333;
    text-decoration-color: #333;
    text-decoration: none;
    font-size: 20px;
    font-weight: 400;
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
    margin-bottom: 8px;
  }
  .related-post-meta .author {
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
  @media (max-width:1024px) {
    .post-wrapper {
      flex-direction: column;
    }
  }
  @media (max-width:768px) {
    .post-content h1 {
      font-size: 32px;
      line-height: 32px;
    }
    .opinion h2 {
      text-align: center;
    }
    section.imageWithText img.left,
    section.imageWithText img.right {
      float:none;
      margin-right: 0;
      max-width: 100%;
      margin-bottom: 8px;
      margin-left: 0;
      margin-right: 0;
    }
  }
  @media (max-width:550px) {
    .related-post {
      flex-direction: column;
      align-items: center;
      text-align: center;
    }
    .related-post-meta {
      justify-content: center;
    }
    .related-post img {
      margin-bottom: 8px;
    }
    section.survey {
      padding:0;
    }
    .post-wrapper {
      padding:0 8px;
    }
    .related-post-content {
      padding:0 4px;
    }
    .related-post-content .excerpt {
      text-align: center;
    }
    .related-post h3 {
      font-size: 18px;
      line-height: 18px;
    }
    .post-content h1 {
      font-size: 28px;
      line-height: 28px;
    }
  }
</style>
