<template>
  <router-link :to="'/post/' + data.id" class="quad-post">
    <img :src="data.img">
    <div class="gradient"></div>
    <div class="content">
      <div class="title">
        {{ data.title }}
      </div>
      <div class="subtitle">
        מאת {{ data.author }} | {{  new Date(data.time*1000) | formatDate }}
      </div>
      <div class="text">
        {{ data.excerpt }}
      </div>
    </div>
  </router-link>
</template>

<script>
export default {
  props: {
    data: {},
  },
  computed: {
    text() {
      // 200 symbols
      return;
    }
  }
}
</script>

<style lang="scss" scoped>

.quad-post {
  height: 500px;
  margin-bottom: 30px;
  position: relative;
  display: flex;
  img {
    width: 100%;
    object-fit: cover;
  }
  .gradient {
    background: linear-gradient(270deg, #FFFB95 0.51%, #FF004D 99.32%);
    opacity: 0.5;
    width: 100%;
    height: 100%;
    position: absolute;
    left: 0;
    top: 0;
  }
  .content {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    align-items: flex-end;
    padding-left: 32px;
    padding-bottom: 40px;
    color: #fff;
    .title {
      text-align: left;
      font-weight: bold;
      font-size: 36px;
      max-width: 600px;
      word-break: break-all;
    }
    .subtitle {
      font-weight: 300;
      font-size: 24px;
      text-align: left;
      margin: 10px 0;
    }
    .text {
      font-size: 18px;
      text-align: left;
      max-width: 600px;
    }

  }

  @media(max-width: 1200px) {
    .content {
      padding: 20px;
    }
  }

  @media(max-width: 800px) {
    .content {
      justify-content: flex-start;
      padding: 20px;
      .title {
        line-height: 28px;
        font-size: 28px;
      }
      .text {
        display: none;
      }
    }
  }
}

</style>
