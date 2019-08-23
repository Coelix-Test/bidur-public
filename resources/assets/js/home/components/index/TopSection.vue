<template>
  <div class="top-section">
    <router-link :to="'/post/' + posts[1].id" class="post first">
      <img :src="posts[1].img" alt="">
      <div class="grad"></div>
      <div class="border-block"></div>
      <div class="title">
        {{ posts[1].title }}
      </div>
    </router-link>
    <router-link :to="'/post/' + posts[0].id" class="second post">
      <img :src="posts[0].img">
      <div class="header">
        <div class="bg">
          <div class="title">
            {{ posts[0].title }}
          </div>
        </div>
      </div>
    </router-link>
  </div>
</template>

<script>
export default {
  computed: {
    posts() {
      return this.$store.getters['main-page/selectedPosts']
        .filter((n, i) => i >= 6);
    }
  }
}
</script>

<style lang="scss" scoped>

.top-section {
  height: calc(100vh - 267px);
  width: 100%;

  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;

  .post {
    width: 100%;
    height: 90%;
    border-radius: 5px;
    position: relative;

    img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 5px;
    }

    &.second {
      margin-right: 10px;
      .header {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100px;
        background: linear-gradient(286.5deg, #C09135 3.48%, #FCD77E 99.52%);
        border-radius: 5px 5px 0 0;
        .title {
          color: #fff;
          font-weight: bold;
          font-size: 44px;
        }
        .bg {
          background-image: url(/img/top-section-first-bg.png);
          background-position: center;
          background-repeat: no-repeat;
          background-size: cover;
          border-radius: 5px 5px 0 0;
          width: 100%;
          height: 100px;
          display: flex;
          flex-direction: row;
          justify-content: center;
          align-items: center;
        }
      }
    }

    &.first {
      margin-left: 10px;
      .grad {
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        border-radius: 5px;
        background-image: linear-gradient(to top, #87682C 0%, transparent 100%);
      }
      .border-block {
        border-image: linear-gradient(278.13deg, #87682C 0%, #FCD77E 100%);
        border-image-slice: 1;
        border-width: 5px;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
      }
      .title {
        position: absolute;
        bottom: 50px;
        color: #fff;
        font-weight: bold;
        font-size: 72px;
      }
    }
  }

}

</style>
