<template>
  <div class="emoji">
    <button @click="select" class="item love">
      <img src="/img/emoji-7.svg">
      <div class="num">12</div>
    </button>

    <button @click="select" class="item laugh">
      <img src="/img/emoji-6.svg">
      <div class="num">12</div>
    </button>

    <button @click="select" class="item wow">
      <img src="/img/emoji-5.svg">
      <div class="num">12</div>
    </button>

    <button @click="select" class="item cry">
      <img src="/img/emoji-4.svg">
      <div class="num">12</div>
    </button>

    <button @click="select" class="item angry">
      <img src="/img/emoji-3.svg">
      <div class="num">12</div>
    </button>

    <button @click="select" class="item like">
      <img src="/img/emoji-2.svg">
      <div class="num">12</div>
    </button>

    <button @click="select" class="item dislike">
      <img src="/img/emoji-1.svg">
      <div class="num">12</div>
    </button>
  </div>
</template>

<script>
export default {
  props : {
    postId : {}
  },
  created() {
    console.log(this.postId);
  },
  methods: {
    select(item) {

    }
  }
}
</script>

<style lang="scss" scoped>

.emoji {
  width: 700px;
  height: 120px;
  display: flex;
  flex-direction: row;
  align-items: stretch;
  justify-content: space-between;
  background: #FFFFFF;
  box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.15);
  border-radius: 3px;
  padding: 15px 40px 15px 40px;
  position: relative;
  &::before {
    content: '';
    left: 50%;
    transform: translateX(-50%);
    bottom: 100%;
    width: 0;
    height: 0;
    border-left: 15px solid transparent;
    border-right: 15px solid transparent;
    border-bottom: 15px solid #fff;
    position: absolute;
  }
  .item {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    background: transparent;
    border: 0;
    img {
      height: 60px;
    }
    .num {
      font-weight: bold;
      font-size: 24px;
      line-height: 100%;
    }
    &.selected {
      .num {
        background: linear-gradient(90deg, #F6AB62 0.91%, #B63E8E 40.51%, #3F5EFB 100%);
        background-clip: text;
        -webkit-text-fill-color: transparent;
      }
    }
  }
}

</style>
