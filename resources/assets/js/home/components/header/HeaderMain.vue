<template>
  <div class="header-main">
    <header-top-line></header-top-line>
    <!-- <div class="celebrities-container">
      <div class="celebrities-slider-wrap" >
        <swiper class="celebrities-slider" :options="swiperOptions" ref="celebritiesSwiper">

          <swiper-slide class="slide-wrap" v-for="hashtag in hashtags" :key="hashtag.id">

              <router-link :to="{ name: 'hashtag', params: { id: hashtag.id }}" class="np-slide-item">
                <div class="celebrity">
                  <div class="img-wrap">
                    <div class="image" :style="'background-image: url('+hashtag.img+');'"></div>
                  </div>
                  <div class="name">{{hashtag.name}}</div>
                </div>
              </router-link>

          </swiper-slide>
        </swiper>
        <div class="swiper-button-prev" slot="button-prev"></div>
        <div class="swiper-button-next" slot="button-next"></div>

      </div>
    </div> -->
    <!-- celebrities row end-->
    <div class="run-stroke-wrap-wrap" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
      <div class="run-stroke-wrap" style="margin:0 auto;max-width:1440px;box-shadow:unset;">
        <ul class="run-stroke" ref="runStroke" >
          <li v-for="post in postTitles">
            <router-link :to="'/post/'+post.id">
              {{post.title}}
            </router-link>
          </li>
          <!-- <li><router-link :to="{ name: 'single-post', params: { id: 1714 } }">הדוגמנית שון לוי בינלאומית</router-link></li>
          <li><router-link :to="{ name: 'single-post', params: { id: 1713 } }">ההחוקים משתנים כל הפרטים על...</router-link></li>
          <li><router-link :to="{ name: 'single-post', params: { id: 1712 } }">איתי לוי מפציץ</router-link></li>
          <li><router-link :to="{ name: 'single-post', params: { id: 1721 } }">טיילור מלכוב לא עוצרת </router-link></li>
          <li><router-link :to="{ name: 'single-post', params: { id: 1720 } }">שיר אלמליח מבריזה?</router-link></li>
          <li><router-link :to="{ name: 'single-post', params: { id: 1719 } }">הזוג החדש של הביצה</router-link></li>
          <li><router-link :to="{ name: 'single-post', params: { id: 1717 } }">כוכבת תאגד מתחתנת</router-link></li>
          <li><router-link :to="{ name: 'single-post', params: { id: 1709 } }">רגע לפני ההופעה הגדולה ג'יי בלווין...</router-link></li> -->
        </ul>
        <ul class="run-stroke hidden">
          <li v-for="post in postTitles">
            <router-link :to="'/post/'+post.id">
              {{post.title}}
            </router-link>

          </li>
          <!-- <li><router-link :to="{ name: 'single-post', params: { id: 1714 } }">הדוגמנית שון לוי בינלאומית</router-link></li>
          <li><router-link :to="{ name: 'single-post', params: { id: 1713 } }">ההחוקים משתנים כל הפרטים על...</router-link></li>
          <li><router-link :to="{ name: 'single-post', params: { id: 1712 } }">איתי לוי מפציץ</router-link></li>
          <li><router-link :to="{ name: 'single-post', params: { id: 1721 } }">טיילור מלכוב לא עוצרת </router-link></li>
          <li><router-link :to="{ name: 'single-post', params: { id: 1720 } }">שיר אלמליח מבריזה?</router-link></li>
          <li><router-link :to="{ name: 'single-post', params: { id: 1719 } }">הזוג החדש של הביצה</router-link></li>
          <li><router-link :to="{ name: 'single-post', params: { id: 1717 } }">כוכבת תאגד מתחתנת</router-link></li>
          <li><router-link :to="{ name: 'single-post', params: { id: 1709 } }">רגע לפני ההופעה הגדולה ג'יי בלווין...</router-link></li> -->
        </ul>
      </div>
    </div>
  </div>

</template>

<script>
import HeaderTopLine from './HeaderTopLine.vue';

export default {
  data(){
    return {
      hashtags: [],
      postTitles: [],
      swiperOptions: {
        slidesPerView: 12,
        breakpoints: {
          1500: {
            slidesPerView: 10,
          },
          1367: {
            slidesPerView: 9
          },
          1200: {
            slidesPerView: 8
          },
          1024: {
            slidesPerView: 7
          },
          991: {
            slidesPerView: 'auto',
            freeMode: true
          }
        },
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
      }
    };
  },
  components: {
    HeaderTopLine,
  },
  methods: {
    getAllHashtags(){
      axios.post('/api/getAllHashtags')
          .then(response => {
            this.hashtags = response.data;

          });
    },
    getAllPostTitles(){
      axios.post('/api/getRecentPosts')
          .then(response => {

            this.postTitles = response.data;
            this.$nextTick(() => {
              var strokeWidth = this.$refs.runStroke.clientWidth;
              var strokeSpeed = 70;//20px per second
              var strokeAnimDuration = strokeWidth / strokeSpeed;

              this.$refs.runStroke.style.animation = 'animStroke '+strokeAnimDuration+'s linear infinite';
            });

          });
    },
  },
  created(){
    this.getAllHashtags();
    this.getAllPostTitles();
  }
}
</script>

<style lang="scss">
  .run-stroke {
    a {
      color:#333;
      text-decoration: none;
    }
  }

</style>
