<template>
  <div class="quad-post">
    <img :src="data.img">
    <div class="content">
      <div class="title">
        {{ data.title }}
      </div>
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
      // 200 symbols
      return;
    }
  }
}
</script>

<style lang="scss" scoped>

.quad-post {
  height: 620px;
  margin-bottom: 30px;
  position: relative;
  display: flex;
  img {
    width: 100%;
    object-fit: cover;
  }
  .content {
    box-shadow: 0 0 500px rgba(0, 0, 0, 0.8) inset;
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    align-items: flex-end;
    padding-left: 50px;
    padding-bottom: 110px;
    color: #fff;
    .title {
      text-align: left;
      font-weight: bold;
      font-size: 36px;
      max-width: 600px;
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
      .text {
        display: none;
      }
    }
  }
}

</style>
