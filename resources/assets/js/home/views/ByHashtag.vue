<template>
  <main>
    <!-- <div class="main-content">

    </div> -->
    <!-- <side-news/> -->

    <div class="header">
      <button @click="$router.go(-1)" type="button">
        <svg width="25" height="18" viewBox="0 0 25 18" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M16.8449 0.270719C16.4924 -0.0902398 15.9376 -0.0902398 15.5851 0.270719C15.2446 0.619484 15.2446 1.19995 15.5851 1.5479L21.9727 8.08988H0.894592C0.40324 8.08988 0 8.48986 0 8.99309C0 9.49632 0.40324 9.90931 0.894592 9.90931H21.9727L15.5851 16.4391C15.2446 16.8001 15.2446 17.3813 15.5851 17.7293C15.9376 18.0902 16.4924 18.0902 16.8449 17.7293L24.7446 9.63859C25.0851 9.28983 25.0851 8.70936 24.7446 8.36141L16.8449 0.270719Z" fill="#BDBDBD"/>
        </svg>
        חזור
      </button>
      <div class="hashtag">
        <img :src="img" class="img">
        <div class="name">
          {{ name }}
        </div>
      </div>
    </div>
    <!-- <div class="coming-soon-text">
      הודעת מערכת – יעלה בקרוב
    </div> -->

    <swiper
      v-if="data.length"
      :options="{
        slidesPerView: 1,
        loop: true,
      }"
    >
      <swiper-slide v-for="item in data" :key="item.id">
        <router-link :to="'/post/' + item.id">
          <img class="banner" :src="item.img">
          <div class="banner-shad">

          </div>
          <div class="title">
            {{ item.title }}
          </div>
        </router-link>
      </swiper-slide>
    </swiper>

    <!-- <template v-for="(item, i) in data">
      <DefaultPost :data="item" v-if="!isQuad(i)"/>
      <QuadPost :data="item" v-else/>
    </template> -->
  </main>
</template>

<script>
import SideNews from './../components/SideNews.vue';
// import DefaultPost from './../components/all/DefaultPost.vue';
// import QuadPost from './../components/all/QuadPost.vue';

export default {
  data() {
    return {
      data: [],
      slider: [],
      name: '',
      img: '',
      page: 0,
      loading: false,
      end: false,
    };
  },
  components: {
    SideNews,
    // DefaultPost,
    // QuadPost,
  },
  methods: {
    // isQuad(index) {
    //   return (index + 1) % 3 == 0;
    // },
    updateSlider(id) {
      return axios
        .get('/api/insta-slider/hashtag/' + id)
        .then(res => {
          this.slider = res.data;
        });
    },
    sync(id, append = false) {
      this.data = [];
      this.loading = true;
      return axios.post('/api/getAllPostsByHashtag', {
        hashtag_id: id,
        page: this.page,
      }).then(res => {
        this.loading = false;
        if(!res.data.data) {
          var data = [];
        } else {
          var data = Object.values(res.data.data);
        }

        // if(append) {
        //   this.data.push(...data);
        // } else {
        //   this.data = data;
        //   this.name = res.data.hashtagName;
        //   this.img = res.data.hashtagImg;
        // }

        // if(!data.length) {
        //   this.end = true;
        // }

        this.data = data;
        this.name = res.data.hashtagName;
        this.img = res.data.hashtagImg;

        //if have no posts :
        if(!this.name) {
          this.img = res.data[0].hashtagImg;
          this.name = res.data[0].hashtagName;
        }
      });
    },
    // onScroll(e) {
    //   var doc = document.documentElement;
    //   var screen = doc.clientHeight;
    //   var top = ((window.pageYOffset || doc.scrollTop) - (doc.clientTop || 0));
    //
    //   if(top >= doc.scrollHeight - (screen * 2) && !this.loading && !this.end) {
    //     this.nextPage();
    //   }
    // },
    // nextPage() {
    //   this.page++;
    //   this.sync(this.$route.params.id, true);
    // }
  },
  created() {
    this.sync(this.$route.params.id);
    // this.updateSlider(this.$route.params.id);
  },
  beforeRouteUpdate(to, from, next) {
    this.page = 0;
    this.loading = false;
    this.end = false;
    this.sync(to.params.id);
    // this.updateSlider(to.params.id);
    next();
  },
  mounted() {
    document.addEventListener('scroll', this.onScroll);
  },
  destroyed() {
    document.removeEventListener('scroll', this.onScroll);
  }
}
</script>

<style lang="scss" scoped>

main {
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  align-items: stretch;
  padding: 0 30px;
  margin: 32px auto 0;
  max-width: 1440px;

  .swiper-container {
    width: 100%;
    padding: 50px 0;
    .swiper-slide {

      padding-bottom: 100%;

      > a {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;

        width: 100%;
        height: 100%;
        padding: 0 30px;
        position: absolute;
        top: 0;
        left: 0;
      }

      .banner {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
      }

      .banner-shad {
        bottom: 0;
        width: 100%;
        height: 100%;
        position: absolute;
        left: 0;
        background-image: linear-gradient(to top, #87682C 0%, transparent 100%);
      }

      .title {
        position: absolute;
        bottom: 30px;
        font-size: 24px;
        font-weight: bold;
        color: #fff;
        left: 30px;

				color: #fff;
				&:hover {
					text-decoration: none;
				}
      }
    }
  }

  .header {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    padding-bottom: 20px;
    button {
      font-weight: bold;
      font-size: 18px;
      color: #BDBDBD;
      background: transparent;
      border: 0;
      display: flex;
      flex-direction: row;
      align-items: center;
      svg {
        margin-left: 10px;
      }
    }
    .hashtag {
      padding-top: 20px;
      display: flex;
      flex-direction: row;
      align-items: center;
      .name {
        font-weight: bold;
        font-size: 48px;
        color: #333333;
        padding-right: 30px;
      }
      .img {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
        object-fit: cover;
      }
    }
  }

  .main-content {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    align-items: stretch;
    justify-content: flex-start;
  }

  .coming-soon-text{
    display: block;
    font-weight: bold;
    font-size: 48px;
    color: #333333;
    margin: 30px 0;
  }

  @media(max-width: 992px) {
    flex-direction: column;
    align-items: stretch;
    padding: 0 10px;
  }
}
@media (max-width:768px) {
  main {
    .header {
      .hashtag {
        .name {

          font-size: 32px;

        }
      }
    }
    .coming-soon-text{
      font-size: 30px;
    }
  }
}

</style>
