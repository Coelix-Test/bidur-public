<template>

  <div class="left-column-bot" :class="{ 'get-down': !$store.getters['main-page/birthday'].visible }">
    <div class="instagram-post">
      <div class="heading">
        <div class="insta-logo">
          <img src="img/insta-full-logo.svg" alt="">
        </div>
        <h2>תמונת האינסטגרם המנצחת של היום</h2>
      </div>

        <a href="https://www.instagram.com/israel_bidur/" class="insta-image-link">
          <img :src="data.img" alt="">
        </a>
        <div class="insta-features">
            <div class="right">
              <img src="img/icons/save.svg" alt="">
            </div>
            <div class="left">
              <img src="img/icons/direct.svg" alt="">
              <img src="img/icons/comments.svg" alt="">
              <img src="img/icons/insta-like.svg" alt="">
            </div>
        </div>
        <a class="insta-btn" href="https://www.instagram.com/israel_bidur/" target="_blank">לעמוד האינסטגרם שלנו</a>

    </div>
  </div>
</template>

<script>
export default {
  computed: {
    data() {
      return this.$store.getters['main-page/instagram'];
    }
  },
}
</script>

<style lang="scss" scoped>
  .left-column-bot {
    flex-basis:calc(50% - 8px);
    width:50%;
    margin-right: 8px;
    margin-bottom: 35px;
    padding:24px 0 0;
    border-radius: 20px;
    box-shadow: 0 0 16px rgba(0,0,0,0.2);
    transform: translateY(-64px);
    &.get-down {
      transform: translateY(0);
    }
  }
  .left-column-bot.in-viewport {
    transform: translateY(0);
    opacity: 1;
  }
  .heading {
    display: flex;
    flex-direction: column;
    flex-wrap:nowrap;
    align-items: center;
    padding: 0 12px;
  }
  .heading h2 {
    background: linear-gradient(90deg, #F6AB62 0.91%, #B63E8E 40.51%, #3F5EFB 100%);
    background-clip: text;
    -webkit-text-fill-color: transparent;
    font-size: 40px;
    text-align: center;
    font-weight: 700;
    margin-bottom: 24px;
    margin-top: 24px;
  }
  .heading img {
    width:260px;
  }
  .heading button {
    border-width:0;
    background-color: transparent;
    padding:0 32px;
    color:#fff;
  }
  .instagram-post {
    margin-top: 16px;
    position: relative;
  }
  .instagram-post .insta-btn {
    background: linear-gradient(90deg, #F97B4A 0%, #C6278D 54.18%, #4200FF 95.31%);
    box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.15);
    border-radius: 5px;
    padding: 8px 12px;
    color:#fff;
    font-size: 24px;
    text-decoration: none;
    font-weight: 600;
    position: absolute;
    bottom:0;
    left:50%;
    white-space: nowrap;
    transform:translateX(-50%) translateY(50%);
  }
  .insta-image-link{
    display: block;
    width: 100%;
    height: auto;
    img{
      width: 100%;
      height: auto;
    }
  }
  .insta-features {
    padding:24px 24px;
    display: flex;
    flex-direction: row;
  }
  .insta-features div {
    flex-grow:2;
    display: flex;
    flex-direction: row;
  }
  .insta-features div.left img {
    margin-right:12px;
  }
  .insta-features div.left {
    justify-content: flex-end;
  }
  .insta-features div.right {
    justify-content: flex-start;
  }
  @media (max-width:768px) {
    .heading img {
      width: 200px;
      margin:0 auto;
    }
    .heading h2 {
      font-size: 24px;
      margin: 12px 0;
    }
    .left-column-bot {
      order: 4;
      width:calc(100% - 16px);
      flex-basis:100%;
      margin-right: 8px;
      margin-left: 8px;
      transform:translateX(0);
      margin-top: 8px;

    }
    .insta-features div img {
      width:30px;
    }
    .insta-features {
      padding:18px 24px 36px;
    }
  }
  @media (max-width: 550px) {
    .instagram-post {
      margin-top: 8px;
    }
    .heading h2 {
      font-size:19px;
    }

  }
</style>
