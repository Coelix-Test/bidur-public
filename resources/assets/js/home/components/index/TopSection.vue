<template>
  <div class="top-section">
    <router-link :to="'/post/' + posts[0].data.id" class="post first">
      <div class="contain">
        <img :src="posts[0].data.img">
        <div class="stars"></div>
      </div>
      <div class="max-title">
        {{ posts[0].meta.comment_one }}
      </div>
      <div class="title">
        <div class="main">
          {{ posts[0].data.title }}
        </div>
        <div class="sub">
          {{ posts[0].meta.comment_two }}
        </div>
      </div>
    </router-link>
    <router-link :to="'/post/' + posts[1].id" class="second post">
      <img :src="posts[1].img">
      <div class="header">
        <div class="bg">
          <div class="title">
            {{ posts[1].title }}
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

$border_radius: 0;

.top-section {
  height: 600px;
  width: 100%;

  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: flex-start;

  .post {
    width: 100%;
    border-radius: $border_radius;
    position: relative;

    img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: $border_radius;
    }

    &.second {
      height: calc(100% - 100px);
      margin-right: 10px;
      .header {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100px;
        background: linear-gradient(286.5deg, #C09135 3.48%, #FCD77E 99.52%);
        border-radius: $border_radius $border_radius 0 0;
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
          border-radius: $border_radius $border_radius 0 0;
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
      height: calc(100% - 20px);
      margin-left: 10px;
      background: linear-gradient(286.5deg, #8E2DE2 3.48%, #4A00E0 99.52%);
      padding: 70px 10px;
      padding-bottom: 90px;
      .max-title {
        font-weight: bold;
        font-size: 50px;
        position: absolute;
        top: 0;
        left: 0;
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
        bottom: 0;
        position: absolute;
        width: 100%;
        left: 0;
        height: 90px;
        .main {
          line-height: 1;
          color: #fff;
          font-weight: 800;
          font-size: 44px;
          text-decoration: none;
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
        .stars {
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;

          background-position: bottom;
          background-repeat: no-repeat;
          background-image: url(/img/stars-bg-top.svg);
          background-size: cover;
        }
      }
    }
  }

  @media(max-width: 767px) {
    flex-direction: column;
    padding: 8px;
    .post {
      margin: 20px 0 !important;

    }
  }

}

</style>
