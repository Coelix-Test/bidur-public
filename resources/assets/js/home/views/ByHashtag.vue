<template>
  <main>
    <div class="main-content">
      <div class="header">
        <button @click="$router.go(-1)" type="button">
          <svg width="25" height="18" viewBox="0 0 25 18" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M16.8449 0.270719C16.4924 -0.0902398 15.9376 -0.0902398 15.5851 0.270719C15.2446 0.619484 15.2446 1.19995 15.5851 1.5479L21.9727 8.08988H0.894592C0.40324 8.08988 0 8.48986 0 8.99309C0 9.49632 0.40324 9.90931 0.894592 9.90931H21.9727L15.5851 16.4391C15.2446 16.8001 15.2446 17.3813 15.5851 17.7293C15.9376 18.0902 16.4924 18.0902 16.8449 17.7293L24.7446 9.63859C25.0851 9.28983 25.0851 8.70936 24.7446 8.36141L16.8449 0.270719Z" fill="#BDBDBD"/>
          </svg>
          Back
        </button>
        <div class="hashtag">
          <img :src="img" class="img">
          <div class="name">
            {{ name }}
          </div>
        </div>
      </div>
      <template v-for="(item, i) in data">
        <DefaultPost :data="item" v-if="!isQuad(i)"/>
        <QuadPost :data="item" v-else/>
      </template>
    </div>
    <side-news/>
  </main>
</template>

<script>
import SideNews from './../components/SideNews.vue';
import DefaultPost from './../components/all/DefaultPost.vue';
import QuadPost from './../components/all/QuadPost.vue';

export default {
  data() {
    return {
      data: [],
      name: '',
      img: '',
    };
  },
  components: {
    SideNews,
    DefaultPost,
    QuadPost,
  },
  methods: {
    isQuad(index) {
      return (index + 1) % 3 == 0;
    },
    sync(id) {
      return axios.post('/getAllPostsByHashtag', {
        hashtag_id: id,
      }).then(res => {
        this.data = res.data.data;
        this.name = res.data.hashtagName;
        this.img = res.data.hashtagImg;
      });
    }
  },
  created() {
    this.sync(this.$route.params.id);
  },
  beforeRouteUpdate(to, from, next) {
    this.sync(to.params.id);
    next();
  }
}
</script>

<style lang="scss" scoped>

main {
  display: flex;
  flex-direction: row;
  justify-content: flex-start;
  align-items: flex-start;
  padding: 0 30px;
  margin: 32px auto 0;
  max-width: 1440px;
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
  @media(max-width: 992px) {
    flex-direction: column;
    padding: 0 10px;
  }
}

</style>
