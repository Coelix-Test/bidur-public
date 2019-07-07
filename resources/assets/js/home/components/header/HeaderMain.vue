<template>
  <div class="header-main">
    <header-top-line></header-top-line>
    <div class="celebrities-container">
      <div class="celebrities-slider">
        <!-- <slick
          ref="slick"
          :options="slickOptions"> -->
          <div class="slide-wrap" v-for="hashtag in hashtags" :key="hashtag.id">
            <router-link :to="{ name: 'hashtag', params: { id: hashtag.id }}" class="np-slide-item">
              <div class="celebrity">
                <div class="img-wrap">
                  <div class="image" :style="'background-image: url('+hashtag.img+');'"></div>
                </div>
                <div class="name">{{hashtag.name}}</div>
              </div>
            </router-link>
          </div>
        <!-- </slick> -->

      </div>
    </div><!-- celebrities row end-->
    <div class="run-stroke-wrap-wrap" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
      <div class="run-stroke-wrap" style="margin:0 auto;max-width:1440px;box-shadow:unset;">
        <ul class="run-stroke" >
          <li v-for="title in postTitles">{{title}}</li>
        </ul>
        <ul class="run-stroke hidden">
          <li v-for="title in postTitles">{{title}}</li>
        </ul>
      </div>
    </div>
  </div>

</template>

<script>
import HeaderTopLine from './HeaderTopLine.vue';
import Slick from 'vue-slick';

export default {
  data(){
    return {
      hashtags: [],
      postTitles: [],
      slickOptions: {
        slidesToShow: 12,
        // slidesToScroll: 12,
        // dots: false,
        // arrows: true,
        // rtl: true,
        // infinite: true,
        // initialSlide: 2,
        // responsive: [
        //   {
        //     breakpoint: 1500,
        //     settings: {
        //       slidesToShow: 10,
        //       slidesToScroll: 10
        //     }
        //   },
        //   {
        //     breakpoint: 1367,
        //     settings: {
        //       slidesToShow: 9,
        //       slidesToScroll: 9
        //     }
        //   },
        //   {
        //     breakpoint: 1200,
        //     settings: {
        //       slidesToShow: 8,
        //       slidesToScroll: 8
        //     }
        //   },
        //   {
        //     breakpoint: 1024,
        //     settings: {
        //       slidesToShow: 7,
        //       slidesToScroll: 7
        //     }
        //   },
        //   {
        //     breakpoint: 991,
        //     settings: {
        //       arrows: false,
        //       centerMode: true,
        //       variableWidth: true,
        //       slidesToShow: 1,
        //       slidesToScroll: 3,
        //     }
        //   }
        // ]
      }
    };
  },
  components: {
    HeaderTopLine,
    Slick
  },
  methods: {
    initSlick(){
      $('.header-main .celebrities-slider').slick({
        slidesToShow: 12,
        slidesToScroll: 12,
        dots: false,
        arrows: true,
        rtl: true,
        infinite: true,
        initialSlide: 2,
        responsive: [
            {
            breakpoint: 1500,
            settings: {
              slidesToShow: 10,
              slidesToScroll: 10
            }
          },
          {
            breakpoint: 1367,
            settings: {
              slidesToShow: 9,
              slidesToScroll: 9
            }
          },
          {
            breakpoint: 1200,
            settings: {
              slidesToShow: 8,
              slidesToScroll: 8
            }
          },
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 7,
              slidesToScroll: 7
            }
          },
          {
              breakpoint: 991,
              settings: {
                  arrows: false,
                  centerMode: true,
                  variableWidth: true,
                  slidesToShow: 1,
                  slidesToScroll: 3,
              }
          }

          // {
          //     breakpoint: 991,
          //     settings: "unslick"
          // }
        ]
      });
    },//not vue component
    reInitSlick() {
      // Helpful if you have to deal with v-for to update dynamic lists
      this.$nextTick(() => {
        this.$refs.slick.reSlick();
      });
    },
    getAllHashtags(){
      axios.post('/getAllHashtags')
          .then(response => {
            // console.log(response.data);
            this.hashtags = response.data;

            //not vue slick
            setTimeout(() => {
              this.initSlick();
            },400);

          });
    },
    getAllPostTitles(){
      axios.post('/getRecentPosts')
          .then(response => {
            // console.log(response.data);
            this.postTitles = response.data.map(post => post.title);

            //TODO REFACTOR
            setTimeout(() => {
              var strokeWidth = $('.run-stroke').width();
              var strokeSpeed = 70;//20px per second
              var strokeAnimDuration = strokeWidth / strokeSpeed;

              $('.run-stroke').css('animation','animStroke '+strokeAnimDuration+'s linear infinite');
            }, 200);

          });
    },
  },
  created(){
    this.getAllHashtags();
    this.getAllPostTitles();
  }
}
</script>

<style lang="scss" scoped>
  // @import '~slick-carousel/slick/slick.css';
  // @import '~slick-carousel/slick/slick-theme.css';
</style>
