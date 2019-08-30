<template>
  <router-link :to="'/post/' + post.data.id" class="top-section-first">

    <div class="max-title">
      מגזין סופ"ש
    </div>

    <div class="contain">
      <img :src="post.data.img">
      <div class="bg"></div>
    </div>

    <div class="stars">
      <div class="stars-top layer"></div>
      <div class="stars-bot layer"></div>
    </div>

    <div class="title">
      <div class="main">
        {{ post.data.title }}
      </div>
      <div class="sub">
        {{ post.data.author }} |
        {{ new Date(post.data.time * 1000) | formatDate }}
      </div>
    </div>

  </router-link>
</template>

<script>
export default {
  computed: {
    post() {
      return this.$store.getters['main-page/selectedPosts']
        .filter((n, i) => i >= 6)[0];
    }
  }
}
</script>

<style lang="scss" scoped>

.top-section-first {
  max-width: calc(50% - 10px);
  position: relative;
  flex-basis: 50%;
  height: calc(100% - 20px);
  margin-left: 10px;
  background: #E4C176;
  border: 20px solid;
  border-image: linear-gradient(286.5deg, #E9C37B 3.48%, #FFE29B 99.52%);
  border-image-slice: 1;

  &:hover {
    text-decoration: none;
  }
  
  .max-title {
    font-weight: bold;
    font-size: 50px;
    position: relative;
    width: 100%;
    height: 70px;
    color: #fff;
    text-decoration: none;

    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }
  .title {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 100%;
    min-height: 90px;
    padding: 10px;
    position: relative;
    .main {
      line-height: 1;
      color: #fff;
      font-weight: 800;
      font-size: 32px;
      text-decoration: none;

      width: 100%;

      // text-overflow: ellipsis;
      // overflow: hidden;
      // white-space: nowrap;

      text-align: center;
    }
    .sub {
      color: #fff;
      text-decoration: none;
      font-size: 24px;
      font-weight: 400;
    }
  }
  .contain {
    width: 100%;
    height: 100%;
    position: relative;

    .bg {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      //background: linear-gradient(360deg, #3E64C0 0%, rgba(174, 174, 174, 0) 58.88%);
    }
  }

  img {
    width: 100%;
    height: auto;
  }

  .stars {
    width: 100%;
    height: 100%;
    position: absolute;
    left: 0;
    top: 0;
    .layer {
      position: absolute;
      left: 0;
      width: 100%;
      height: 100%;

      background-repeat: no-repeat;
      background-size: contain;

      &.stars-top {
        top: 0;
        background-image: url(/img/stars-top-top.png);
        background-position: top;
      }
      &.stars-bot {
        bottom: 0;
        background-position: bottom;
        background-image: url(/img/stars-top-bot.png);
      }
    }
  }

  @media(max-width: 767px) {
    max-width: 100%;
    margin: 10px 0 !important;

    border: 7px solid;
    border-image: linear-gradient(286.5deg, #E9C37B 3.48%, #FFE29B 99.52%);
    border-image-slice: 1;
    .title {
      .main {
        font-size: 30px;
      }
      .sub {
        font-size: 15px;
      }
    }
    .max-title {
      font-size: 32px;
    }
  }
}

</style>
