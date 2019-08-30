<template>
  <router-link :to="'/post/' + post.data.id" class="top-section-second">
    <div class="header">
      <div class="bg">
        <div class="title">
          <span class="static">פריצת השבוע</span> -
          <span class="dynamic">{{ post.meta.comment_one }}</span>
        </div>
      </div>
    </div>
    <img :src="post.data.img">
  </router-link>
</template>

<script>
export default {
  computed: {
    post() {
      return this.$store.getters['main-page/selectedPosts']
        .filter((n, i) => i >= 6)[1];
    }
  }
}
</script>

<style lang="scss" scoped>

.top-section-second {
  width: 100%;
  position: relative;
  max-width: calc(50% - 10px);

  margin-right: 10px;

  display: flex;
  flex-direction: column;
  align-items: stretch;
  justify-content: flex-start;

  &:hover {
    text-decoration: none;
  }

  .header {
    width: 100%;
    height: 100px;
    position: relative;
    background: linear-gradient(322.69deg, #8E2DE2 21.47%, #5105EC 85.38%);
    .title {
      color: #fff;
      font-weight: bold;
      font-size: 44px;

      text-overflow: ellipsis;
      overflow: hidden;
      white-space: nowrap;

      .static {
        font-weight: 300;
      }
      .dynamic {
        //font-weight: 300;

      }
    }
    .bg {
      background-image: url(/img/top-section-first-bg.png);
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      width: 100%;
      height: 100px;
      display: flex;
      flex-direction: row;
      justify-content: center;
      align-items: center;
    }
  }

  img {
    width: 100%;
    height: auto;
  }

  @media(max-width: 767px) {
    max-width: 100%;
    margin: 10px 0 !important;

    border: 7px solid;
    border-image: linear-gradient(286.5deg, #E9C37B 3.48%, #FFE29B 99.52%);
    border-image-slice: 1;
    .header {
      .bg {
        background-position: top;
        background-size: 100%;
      }
    }
    .title {
      font-size: 30px !important;
    }
  }
}

</style>
