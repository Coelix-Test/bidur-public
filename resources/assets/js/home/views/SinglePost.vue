<template>
  <div class="single-post">
    <div v-if="post" class="post-wrapper">

      <div class="post-content">

        <!-- <div class="ad-wrapper" v-if="!closed_top_ad && $env.MOBILE">
          <Adsense
            data-ad-client="ca-pub-6511052822397382"
            data-ad-slot="2993992173"
            data-ad-format="fluid"
            data-ad-layout-key="-fb+5w+4e-db+86"
          />

          <transition name="cool">
            <button v-if="can_close_top_ad" width="20" height="20" @click="closed_top_ad = true" class="close-btn">
              <svg width="80%" height="80%" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 1.15689L18.8406 0L10 8.82369L1.15941 0L0 1.15689L8.84059 9.98065L0 18.8037L1.15941 19.9606L10 11.1375L18.8406 19.9606L20 18.8037L11.1588 9.98065L20 1.15689Z" fill="white"/>
              </svg>
            </button>
          </transition>
        </div> -->

        <div class="pre-title-row">
          <!-- <button class="add-to-favourites" @click.prevent="$router.go(-1)">
            <img src="/img/icons/star-gradient.png" alt=" ">
            חזרה לעמוד הבית
          </button> -->
          <button
            class="add-to-favourites"
            @click="addPostToFavourite(postId)"
          >
            <img src="/img/icons/star-gradient.png" alt=" ">
            הוסף למועדפים
          </button>

          <share v-if="!errorMessage" :link="post.data.post.share_string"/>
        </div>

        <share-socials :link="post.data.post.share_string"/>

        <template v-if="errorMessage">
          <p class="main-title">Post has no content!</p>
        </template>
        <template v-else>
          <h1 class="main-title" v-if="post.data.post.mainTitle">
            <font style="background: url(/img/gold-kek.gif);-webkit-background-clip: text;background-clip:text;background-size:100% 100%;background-repeat:repeat;">
              {{ post.data.post.mainTitle }}
            </font>

          </h1>

          <div class="post-meta">

            <div class="info">
              <span class="author">{{ post.data.post.author }}</span>
              <span class="date">{{  new Date(post.data.post.date*1000) | formatDate }}</span>
            </div>

          </div>

          <section :class="post.type + ' section'" v-for="(post, index) in postData">

            <Adsense
              v-if="index % 3 === 0"
              data-ad-client="ca-pub-6511052822397382"
              data-ad-slot="6203335135"
              data-ad-format="fluid"
              data-ad-layout-key="-fb+5w+4e-db+86"
            />

            <h2 v-if="post.type == 'title'"> {{ post.value }}</h2>

            <div v-if="post.type == 'content'" v-html="post.value"></div>

            <div v-if="post.type == 'image'">
              <img v-lazy="post.value" alt="">
              <span v-if="post.description && post.description != 'null'" v-html="post.description"></span>
            </div>

            <div ref="poll" v-if="post.type == 'survey'" class="poll">
              <img v-lazy="post.img" alt="">
              <div class="img-caption">{{post.description}}</div>
              <vue-poll class="vue-poll" v-bind="post.value" @addvote="addVote($event, post.id)"/>
            </div>
            <div v-else-if="post.type == 'compare'" class="poll">
              <one-survey :data="post.value"/>
            </div>
            <div v-else-if="post.type == 'likableImage'" class="poll">
              <like-survey :data="post.value"/>
            </div>

            <template v-if="post.type == 'video'">
              <div class="video-wrap">
                <iframe
                  type="text/html"
                  :src="youtubeEmbedLink(post.value)"
                  frameborder="0"
                />
              </div>
              <span v-if="post.description && post.description != 'null'" v-html="post.description"></span>
            </template>
            <!-- <template
              v-if="post.type == 'video'"
            >
              {{post.value}}
            </template> -->

            <div v-if="post.type == 'imageWithText'">
              <img v-if="post.url" :class="post.imagePosition" v-lazy="post.url" :alt="post.title">
              <h2 v-if="post.title !== 'null'">{{ post.title }}</h2>
              <div v-if="post.content" v-html="post.content"></div>
            </div>

            <!-- <div v-if="post.type == ''"></div> -->

          </section>
          <div v-if="this.$env.mobile == true">
            <div class="OUTBRAIN" :data-src="$route.query.page" data-widget-id="GS_6"></div>
          </div>


          <Adsense
            data-ad-client="ca-pub-6511052822397382"
            data-ad-slot="6889730840"
            data-ad-format="fluid"
            data-ad-layout-key="-fb+5w+4e-db+86"
          />


          <nav v-if="false"><!-- delete in future if not required -->

            <router-link
              v-if="prevPostId"
              class="prev-post"
              :to="'/post/' + prevPostId"
            >
              <img src="/img/arrow-right.svg">
              לכתבה הקודמת
            </router-link>
            <router-link
              v-if="nextPostId"
              class="next-post"
              :to="'/post/'+nextPostId"
            >
              לכתבה הבאה
              <img src="/img/arrow-left.svg">
            </router-link>

          </nav>



          <!-- <div class="opinion">
            <h2>מה חשבתם על הכתבה?</h2>
            <div class="emoji-wrapper">
              <emoji v-if="postId" :postId="postId" />
            </div>
          </div> -->

          <!-- <a href="https://2207.kupat.co.il/show/tiktok">
            <img
              style="width:100%;height:auto;margin-top:40px;"
              src="/img/banners/320X100_Israel_Tiktok_01.jpg"
              alt=""
              v-if="$env.MOBILE"
            >
          </a> -->

        </template>

      </div>

      <side-news v-if="!$env.MOBILE" />

    </div>

    <outbrain-bottom-ad></outbrain-bottom-ad>

    <div class="related-posts">
      <img src="/img/stars-posts.svg" alt="" class="stars">
      <h2>חדשות נוספות</h2>
      <carousel
        v-if="relevantPosts"
        :rtl="true"
        :perPageCustom="[[320, 1],[550, 1], [768, 2], [769, 3]]"
        navigationEnabled
        navigationNextLabel="<img src='/img/chevron-to-left.svg' />"
        navigationPrevLabel="<img src='/img/chevron-to-left.svg' />"
      >
        <slide v-for="(post, i) in relevantPosts" class="related-post" :key="post.id + '-' + i">
          <router-link :to="'/post/'+post.id + '/'">
            <img v-lazy="post.img">
            <div class="related-post-content">
              <h3>{{ post.title }}</h3>
              <p class="related-post-meta">
                <span class="date">{{  new Date(post.time*1000) | formatDate }}</span>
                <span class="author">{{post.author}}</span>
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

import VuePoll from 'vue-poll'
import TypeWriter from './../components/common/TypeWriter.vue'
import Share from './../components/single-post/Share.vue'
import ShareSocials from './../components/single-post/ShareSocials.vue'
import Emoji from './../components/single-post/Emoji.vue'
import SinglePostExample from './../components/SinglePostExample.vue'
import SideNews from './../components/SideNews.vue'
import { Carousel, Slide } from 'vue-carousel'
import LikeSurvey from './../components/common/LikeSurvey'
import OneSurvey from './../components/common/OneSurvey'
import OutbrainBottomAd from './../components/outbrain/OutbrainBottomAd.vue'

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
      closed_top_ad: false,
      can_close_top_ad: false,
    }
  },
  metaInfo () {
    if(this.post){
      return {
        title: this.post.data.post.mainTitle,
        meta: [
          { vmid: 'description', name: 'description', content: this.post.data.post.excerpt },
          { vmid: 'og:description', property: 'og:description', content: this.post.data.post.excerpt },
          { vmid: 'og:title', property: 'og:title', content: this.post.data.post.mainTitle },
          { vmid: 'og:url', property: 'og:url', content: window.location.origin+'/#'+this.$route.fullPath },
          { vmid: 'og:image', property: 'og:image', content: window.location.origin+'/#'+this.post.data.post.preview },
        ]
      }
    }
  },
  computed: {
    curPageLink(){
      return window.location.href;
    }
  },
  methods: {
    addPostToFavourite(id) {

      if(this.$root.is_user_logged_in) {
        if(!this.post.data.post.is_favourite) {
          axios
            .post('/api/addPostToFavourite', { postId: id })
            .then( res => {
              // console.log(res.data);
              alert('הוסף פוסט למועדפים!');
            });
        } else {
          axios
            .post('/api/removeFromFavourites', { postId: id })
            .then( res => {
              // console.log(res.data);
              alert('הוסף פוסט למועדפים!');
            });
        }

      } else {
        this.$root.openReg();
      }

    },
    removeFromFavourites(id) {
      axios
        .post('/api/deletePostFromFavourites',{ postId: id })
        .then(res => {
          // console.log(res);
          alert('פוסט נמחק מהמועדפים!');
        });
    },
    changePost($event, id) {
      event.preventDefault()
      this.sync(id);
      this.postId = id;
      this.$router.push({ path : `/post/${id}` });
    },
    computeNumber(value) {

    },
    sync(id) {
      this.postData = [];

      if(id == 2557){
        console.log('fb pix post2');
        window.fbq('init', '444548093078624');
        window.fbq('track', 'PageView');

      }

      return axios
        .post('/api/post/' + id)
        .then(response => {

          const res = response;
          const data = res.data;

          console.log(data);

          if(!data.post.publish && this.$route.name != 'post-viewer') {
            this.$router.replace('/');
            return;
          }

          this.post = response;
          this.errorMessage = false;
          this.postId = id;
          this.postData = this.post.data.post.sections;
          this.postTitle = this.postData[1].value;
          this.hashtags = this.post.data.post.hashtags;

          if(this.hashtags != null) {
            var relevantPosts = [];
            var proms = [];
            for(let i = 0; i < this.hashtags.length; i++) {
              proms.push(
                axios
                  .post('/api/getAllRelevantPosts', {
                    hashtag_id: this.hashtags[i],
                    postId: id
                  })
                  .then(response => {
                    this.relevantPosts = response.data;
                  })
              )
            }
          } else {
            axios.post('/api/getRecentPosts', { postId: id }).then(res => {
              this.relevantPosts = res.data.splice(0,6);
            });
          }
          this.prevPostId = (response.data.previousPost) ? response.data.previousPost.toString() : false ;
          this.nextPostId = (response.data.nextPost) ? response.data.nextPost.toString() : false ;
          window.scrollTo(0,0);
        })
        .catch(error => {
          console.error('Error fetching post');
          this.errorMessage = true;
          this.post = false;
        });
    },
    addVote(obj, id){
      makeItRain(70, this.$refs.poll);
        axios
          .post('/api/addSurveyVote',{ surveyId : id, answer : obj.value+1 })
    },
    youtubeEmbedLink(url){
      let regex = new RegExp("https://youtu.be/");
      let key = '';
      if(regex.test(url)) {
        key = url.replace('https://youtu.be/', '');
      } else {
        let UrlObj = new URL(url);
        key = UrlObj.searchParams.get("v");
      }
      key = 'https://www.youtube.com/embed/' + key;
      return key;
    },
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
    ShareSocials,
    Emoji,
    LikeSurvey,
    OneSurvey,
    TypeWriter,
    OutbrainBottomAd
  },
  mounted() {
    //let els = this.$el.getElementsByTagName('p');

    // console.log(els);
    setTimeout(() => {
      this.can_close_top_ad = true;
    }, 5000);
  }
}

</script>

<style lang="scss" scoped>

::v-deep {
  .vue-poll {
    .votes {
      display: none;
    }
  }
}

.pre-title-row{
  display: flex;
  justify-content: space-between;
}
.back-btn{
  font-size: 18px;
  height: 40px;
  padding: 0 50px 0 20px;
  background: url('/img/icons/arrow-white-back2.svg') no-repeat calc(100% - 18px) center, #EB5757;
  -webkit-background-size: 25px 18px;
  background-size: 25px 18px;
  margin-bottom: 10px;
  margin-left: auto;
}
.add-to-favourites {
  white-space: nowrap;
  border-width: 0;
  color: #F2C94C;
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-start;
  font-size: 16px;
  font-weight: 400;
  background-color: #fff;
  padding-right: 0;
  margin-left: auto;

}
.add-to-favourites img {
  width: 24px;
  height: 24px;
  margin-left: 4px;
  pointer-events: none;
}

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
  align-items: stretch;
  padding-left: 16px;
  color:#333;
  nav{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
    a{
      color:#FCD77E;
      font-size: 18px;
      font-weight: bold;
    }
    .next-post{
      flex-grow:2;
      text-align: left;
    }
  }

  .main-title {
    color:transparent;
    margin-bottom: 4px;
    font-weight: 700;
    font-size: 40px;
    font-weight: bold;

  }
  .main-title font {
    -webkit-background-clip : text;
    background-clip: text;
    background-size: contain!important;
    background-repeat: repeat!important;
    display: block;
  }

  section{
    margin-bottom: 16px;
    h2 {
      padding-right: 6px;
      border-right: 5px solid #F2C94C;
      font-weight: 600;
    }
  }
}
.post-meta {
  display: flex;
  margin-bottom: 16px;
  flex-direction: row;
  align-items: center;
  justify-content: space-between;
  .info a,
  .info{
    color:#F2C94C;
    font-size: 16px;
    font-weight: 200;
  }
  .info{
    .date{
      padding-right: 4px;
      margin-right: 4px;
      border-right: 1px solid #F2C94C;
    }
  }
}
.poll img {
  width:100%;
  object-fit: cover;
  margin-bottom: 0;
}
.poll .img-caption{
  text-align: center;
  padding-top: 5px;
  color: #fff;
  font-style: italic;
  font-weight: 400;
  font-size: 14px;
  line-height: 17px;
  background: linear-gradient(270deg, #E4A913 0%, #EED074 99.53%);
}
.vue-poll::v-deep{
  .qst{
    padding-top: 20px;
  }
}

.post-content {
  .section {
    display: flex;
    flex-direction: column;
    align-items: stretch;
  }
}


section.image img {
  max-width: 100%;
  width:100%;
  object-fit: cover;
  margin-bottom: 12px;
  margin-bottom: 0px;
  display: block;
}
section.image span,
section.video span {
  max-width:500px;
  font-style: italic;
  font-weight: 400;
  font-size: 14px;
  line-height: 17px;
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

section.video .video-wrap{
  position: relative;
  padding-top: 56.25%;
  width: 100%;
}

section.video iframe {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}
section.content::v-deep * {
  max-width: 100%;
}
section.image p {
  font-size: 16px;
}
section.image p:last-child {
  margin-bottom: 0;
}
section.text p {
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
  border:4px solid #E4A913!important;
}
section.survey {
  max-width: 550px;
}
.opinion {
  border: 4px solid;
  border-image: linear-gradient(278.13deg, #87682C 0%, #FCD77E 100%);
  border-image-slice: 1;
  padding: 25px 0;
  h2{
    text-align: center;
    font-weight: 700;
  }
}

.post-content section:last-of-type {
  padding-bottom: 32px;
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
  justify-content: center;
  text-align: center;
  margin-top: 24px;
  text-decoration: none;
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
  padding: 8px 0 !important;
  margin: 0 1px !important;
}
.related-posts::v-deep .VueCarousel-navigation-prev {
  right:-12px;
  left:unset;
}
.related-posts::v-deep .VueCarousel-navigation-prev img {
  transform:rotate(180deg);
}
.related-posts::v-deep .VueCarousel-navigation-next {
  left:-12px;
  right:unset;
}
.related-post img {
  width: auto;
  max-width: 100%;
  height: 420px;
  object-fit: cover;
  padding: 10px;
}
.related-post a {
  text-decoration-color: #333;
  text-decoration: none;
}
.related-posts .stars {
  display: none;
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
  justify-content: center;
  flex-direction: row;
  white-space: nowrap;
  font-size: 14px;
  margin-bottom: 0;
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
.related-posts h2 {
    display: none;
}
@media (max-width:1024px) {
  .post-wrapper {
    flex-direction: column;
  }
}
@media (max-width:768px) {
  .opinion {
    padding: 0;
  }

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
    margin-top: 32px;
  }
  .related-posts .stars {
    display: block;
    object-fit: contain;
    width:100%;
    /* height: 100%; */
    position: absolute;
    top:0;
    left: 0;
    right: 0;
    bottom: 0;
    pointer-events: none;
    z-index:-1;
  }
  /* ЕБУЧИЕ КОСТЫЛИ ДЛЯ ЯИРА --> */
  /* likes counter: 3 */
  .banner {
    width:100%;
    height: auto;
    display: block;
    object-fit: cover;
    object-position: center;
    height:300px;
  }
  /* <-- ЕБУЧИЕ КОСТЫЛИ ДЛЯ ЯИРА */

  section.imageWithText {
    text-align: justify;
  }
  section.content {
    text-align: justify;
  }
  .post-content h1 {
    font-size: 32px;
    line-height: 32px;
  }
  .post-content {
    padding-left: 0;
    width: 100%;
    .main-title{
      text-align: center;
      line-height: 28px;
      font-size: 32px;
    }
    .post-meta{
      justify-content: center;
    }
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
  .post-wrapper{
    margin-top: 17px;
  }
  .pre-title-row{
    margin-bottom: 10px;
  }
  .related-post {
    flex-direction: column;
    align-items: center;
    text-align: center;
    flex-basis:100%;
  }
  .related-post-meta {
    justify-content: center;
  }
  .related-post img {
    margin-bottom: 8px;
  }
  .related-post a {
    width:100%;
  }
  section.survey {
    padding:0;
  }
  .post-wrapper {
    padding:0 16px;
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
    line-height: 1.05;
  }
}


.ad-wrapper {

  display: flex;
  flex-direction: column;
  align-items: stretch;

  padding: 20px 0;
  position: relative;

  .adswrapper {
    background: #eee;
  }

  .close-btn {
    position: absolute;
    width: 40px;
    height: 40px;
    top: 10px;
    right: 10px;
    border-radius: 50%;
    background: linear-gradient(to left, #F6AB62 1%, #B63E8E 41%, #3F5EFB 90%);
    border: 0;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);

    display: flex;
    align-items: center;
    justify-content: center;

    svg {
      width: 25px;
      height: 25px;
    }

    &.cool-enter {
      transform: scale(0.8);
      opacity: 0;
    }
    &.cool-enter-to {
      transform: scale(1);
      opacity: 1;
    }

    &.cool-leave {
      transform: scale(1);
      opacity: 1;
    }
    &.cool-leave-to {
      transform: scale(0.8);
      opacity: 0;
    }

    &.cool-leave-active,
    &.cool-enter-active {
      transition: transform 0.5s ease, opacity 0.5s ease;
    }
  }
}

// UNCOMMENT IN CASE IF GIF WILL STOP WORKING
// .main-title {
//   color: #E4A913 !important;
// }

// .section {
//   transition: opacity 0.5s ease, transform 0.5s ease;
//   transform: scale(0.9);
//   opacity: 0;
//
//   &.in-viewport {
//     transform: scale(1);
//     opacity: 1;
//   }
// }
</style>
