<template>
  <div class="side-news-post" @click="reg">
    <div class="img">

    </div>
    <div class="desc">
      <div class="title">2019 Pride Month A-Z Guide: Everything You Need to Know...</div>
      <div class="subtitle">5 hours ago | by Helen Nilova</div>
    </div>
  </div>
</template>

<script>
import Reg from './modals/Reg.vue';

export default {
  methods: {
    reg() {
      this.$modal.show(Reg, {}, {
        adaptive: true,
        width: 600,
        height: 'auto',
        scrollable: true,
      })
    }
  }
}
</script>

<style lang="scss" scoped>

.side-news-post {
  min-height: 110px;
  border-bottom: 1px solid #E0E0E0;
  display: flex;
  flex-direction: row;
  align-items: stretch;
  margin-bottom: 20px;
  padding-bottom: 20px;
  &:last-child {
    border-bottom: 0;
    padding-bottom: 0;
    margin-bottom: 0;
  }
  .img {
    width: 300px;
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

  @media(max-width: 450px) {
    flex-direction: column;
    border-bottom: 0;
    .img {
      height: 200px;
      width: 100%;
    }
    .desc {
      padding-right: 0;
      padding-top: 10px;
    }
  }
}

</style>
