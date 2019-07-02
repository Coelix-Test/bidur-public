<template>
  <div class="default-post">
    <router-link :to="'/post/' + data.id" class="title">
      <div class="image" :style="{ backgroundImage: `url(${data.img})` }"></div>
    </router-link>
    <div class="desc">
      <router-link :to="'/post/' + data.id" class="title">
        {{ data.title }}
      </router-link>
      <div class="subtitle">
        by {{ data.author }} | 5 hours ago
      </div>
      <div class="text">
        {{ data.excerpt }}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    data: {},
  },
  computed: {
    text() {
      // 700 symbols
      return;
    }
  }
}
</script>

<style lang="scss" scoped>

.default-post {
  display: flex;
  flex-direction: row;
  justify-content: flex-start;
  align-items: stretch;
  margin-bottom: 30px;
  .image {
    // background-image: url(https://via.placeholder.com/380x600);
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    width: 300px;
    min-width: 300px;
    min-height: 200px;
  }
  .desc {
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: flex-start;
    padding-right: 30px;
    .title {
      font-weight: bold;
      font-size: 24px;
      line-height: 32px;
      text-align: right;
      color: #333333;
    }
    .subtitle {
      font-weight: 300;
      font-size: 16px;
      line-height: 19px;
      text-align: right;
      color: #333333;
      margin: 10px 0;
    }
    .text {
      font-size: 18px;
      line-height: 21px;
      text-align: right;
      color: #828282;
    }
  }

  @media(max-width: 1200px) {
    flex-direction: column;
    .image {
      width: 100%;
      min-width: unset;
      min-height: 200px;
    }
    .desc {
      padding-top: 30px;
      padding-right: 0;
    }
  }
}

</style>
