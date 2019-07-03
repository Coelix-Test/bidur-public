<template>
  <div class="single-post">
    <div class="post-wrapper">

      <single-post-example v-if="errorMessage" />
      <div v-if="post" class="post-content">
        <nav>

          <a v-if="prevPostId" @click="changePost($event,prevPostId)" :href="prevPostId">
            <img src="/img/arrow-right.svg">
            Prev News {{ prevPostId }}
          </a>
          <a v-if="nextPostId" @click="changePost($event,nextPostId)" :href="nextPostId">
            Next News {{ nextPostId }}
            <img src="/img/arrow-left.svg">
          </a>
        </nav>

        <h1>{{ post.data.post.mainTitle }}</h1>
        <div class="post-meta">

          <div class="info">
            <span class="author">{{ post.data.post.author }}</span>
            <span class="date">{{ post.data.post.date }}</span>
          </div>
          <a href="#" class="share">
            ףתש
            <img src="/img/shareArrow.svg" alt="">
          </a>

        </div>
        <section :class="post.type" v-for="post in postData" >

          <h2 v-if="post.type == 'title'"> {{ post.value }}</h2>

          <p v-if="post.type == 'content'">{{ post.value }}</p>

          <img v-if="post.type == 'image'" :src="post.value" alt="">

          <vue-poll v-if="post.type == 'survey'" class="poll" v-bind="post.value" @addvote="addVote($event, 1)"/>

          <iframe
            v-if="post.type == 'video'"
            id="ytplayer"
            type="text/html"
            src="http://www.youtube.com/embed/M7lc1UVf-VE?autoplay=0&origin=http://example.com"
            frameborder="0"
          />

          <div v-if="post.type == 'imageWithText'">
            <img v-if="post.url" :class="post.imagePosition" :src="post.url" :alt="post.title">
            <h2 v-if="post.title">{{ post.title }}</h2>
            <p v-if="post.content">{{post.content}}</p>
          </div>

        </section>



        <div class="opinion">
          <h2>Your opinion</h2>
          <div class="emoji-wrapper">

          </div>
        </div>
      </div>



      <side-news />
    </div>
    <div class="related-posts">


      <carousel v-if="relevantPosts" :rtl="true" :perPageCustom="[[320, 1], [768, 1], [769, 2]]">
        <slide v-for="post in relevantPosts" class="related-post" :key="i">
            <img src="/img/relatedPostPrev.png" alt="">
            <div class="related-post-content">
              <a href="#"><h3>6 JOBS THAT PROBABLYWON’T BE AROUND IN 10 YEARS</h3></a>
              <p class="related-post-meta">
                <span class="date">5 years ago</span>
                <span class="author">by Helen Nikova</span>
              </p>
              <p class="excerpt">
                Whether you’re trying to figure out a career path tailored to your abilities, or just curious of the kinds of jobs that society is slowly fading out, Boss Girl has the rundown on the 6 jobs that probably...
              </p>
            </div>
        </slide>
      </carousel>
    </div>
  </div>


</template>

<script>

import VuePoll from 'vue-poll'
import SinglePostExample from './../components/SinglePostExample.vue'
import SideNews from './../components/SideNews.vue'
import { Carousel, Slide } from 'vue-carousel';
import VueLikeDislikeButtons from 'vue-like-dislike-buttons'

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
  methods : {
    changePost($event, id) {
      event.preventDefault()
      this.sync(id);
    },
    computeNumber(value) {
      // console.log(value);
    },
    sync(id) {
      return axios
        .post('/post/'+id)
          .then(response => {
            // console.log(response);

            this.post = response;
            this.errorMessage = false;
            this.postData = this.post.data.post.sections;
            this.postTitle = this.postData[1].value;
            this.hashtags = this.post.data.post.hashtags;
             if(this.hashtags != null) {
              for(let i =0;i < this.hashtags.length;i++) {
                // console.log(this.hashtags[i]);
                axios
                  .post('/getAllPostsByHashtag', {hashtag_id: this.hashtags[i],})
                    .then(response => {
                      this.relevantPosts.push(response);
                      console.log('response', response);
                    })
              }
              console.log(this.relevantPosts);
            }
            // delete this.postData[1];
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
        console.log(obj);
        console.log(id);
    }
  },
  created() {

    this.sync(this.$route.params.id);

  },
  beforeRouteUpdate(to) {
    this.sync(to.params.id);
  },
  components : {
    SideNews,
    VuePoll,
    Carousel,
    Slide,
    SinglePostExample,
    VueLikeDislikeButtons
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
  }
  section.image img {
    max-width: 100%;
    object-fit: cover;
    margin-bottom: 12px;
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
    padding:24px;
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
  }
  .related-post {
    text-decoration: none;
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
    padding-right: 4px;
    margin-right: 4px;
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
    section.imageWithText img.left,
    section.imageWithText img.right {
      float:none;
      margin-right: 0;
      max-width: 100%;
      margin-bottom: 8px;
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
      padding:12px 4px;
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
