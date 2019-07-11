<template>
  <div class="side-news-post" v-in-viewport.once>
    <router-link @click="scrollTop" :to="'/post/' + data.id+'/#'" class="link-wrapper">
      <div class="img" :style="{ backgroundImage: `url(${data.img})` }"></div>
      <div class="desc">
        <div class="title">{{ data.title }}</div>
        <div class="subtitle">{{ new Date(data.time*1000) | formatDate }} |  {{ data.author }}</div>
      </div>
    </router-link>
  </div>
</template>

<script>
export default {
  props: {
    data: {}
  },
  methods: {
    scrollTop() {

    },

  }
}
</script>

<style lang="scss" scoped>

.side-news-post {
  text-decoration-color: #333;
  min-height: 110px;
  border-bottom: 1px solid #E0E0E0;
  display: flex;
  flex-direction: row;
  align-items: stretch;
  margin-bottom: 20px;
  padding-bottom: 20px;
  transition: .3s;
  transform: translateX(-100%);
  opacity: 0;
  height:120px;
  &.in-viewport {
    opacity: 1;
    transform:translateX(0);
  }
  &:last-child {
    border-bottom: 0;
    padding-bottom: 0;
    margin-bottom: 0;
  }

  .link-wrapper {
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: row;
    align-items: stretch;
    text-decoration: none;
  }

  .img {
    width: 120px;
    min-width: 120px;
    max-width: 120px;
    height:100%;
    display: block;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    background-image: url(https://via.placeholder.com/130x110);
  }
  .desc {
    padding-right: 10px;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    .title {
      font-weight: bold;
      font-size: 18px;
      line-height: 20px;
      text-align: right;
      color: #4F4F4F;
    }

    .subtitle {
      padding-top: 10px;
      font-weight: 300;
      font-size: 12px;
      line-height: 14px;
      color: #4F4F4F;
    }
  }

  .link-wrapper {
    @media(max-width: 450px) {
      flex-direction: column;
      border-bottom: 0;
      .img {
        height: 200px;
        width: 100%;
        max-width: unset;
      }
      .desc {
        padding-right: 0;
        padding-top: 10px;
      }
    }
  }
}
@media (max-width:768px) {
  .side-news-post {
    height:unset;
  }
}

</style>
