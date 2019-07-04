<template>
  <div class="left-column-bot">
    <div class="heading">
      <button>
        <svg xmlns="http://www.w3.org/2000/svg" width="75" height="75" viewBox="0 0 75 75" fill="none">
          <path d="M26.8799 11.7188C18.5577 11.7188 11.7188 18.5486 11.7188 26.8799V48.1201C11.7188 56.4423 18.5486 63.2812 26.8799 63.2812H48.1201C56.4423 63.2812 63.2812 56.4514 63.2812 48.1201V26.8799C63.2812 18.5577 56.4514 11.7188 48.1201 11.7188H26.8799ZM26.8799 16.4062H48.1201C53.9154 16.4062 58.5938 21.0846 58.5938 26.8799V48.1201C58.5938 53.9154 53.9154 58.5938 48.1201 58.5938H26.8799C21.0846 58.5938 16.4062 53.9154 16.4062 48.1201V26.8799C16.4062 21.0846 21.0846 16.4062 26.8799 16.4062ZM51.3428 21.5332C50.1617 21.5332 49.2188 22.4762 49.2188 23.6572C49.2188 24.8383 50.1617 25.7812 51.3428 25.7812C52.5238 25.7812 53.4668 24.8383 53.4668 23.6572C53.4668 22.4762 52.5238 21.5332 51.3428 21.5332ZM37.5 23.4375C29.7638 23.4375 23.4375 29.7638 23.4375 37.5C23.4375 45.2362 29.7638 51.5625 37.5 51.5625C45.2362 51.5625 51.5625 45.2362 51.5625 37.5C51.5625 29.7638 45.2362 23.4375 37.5 23.4375ZM37.5 28.125C42.7094 28.125 46.875 32.2906 46.875 37.5C46.875 42.7094 42.7094 46.875 37.5 46.875C32.2906 46.875 28.125 42.7094 28.125 37.5C28.125 32.2906 32.2906 28.125 37.5 28.125Z" fill="white"/>
        </svg>
      </button>
      <h2>תמונת האינסטגרם המנצחת של היום</h2>

    </div>
    <div class="instagram-post">
      <a href="https://instagram.com/" target="_blanc">
        <img src="/img/leo.png" alt="">
      </a>
    </div>
  </div>
</template>

<script>
export default {
  props : {
    data : {
      requred: true,
    }
  },
  data() {
    return {
      posts : [],
    }
  },
  created() {
  },
  mounted() {

  }
}
</script>

<style lang="css" scoped>
  .left-column-bot {
    flex-basis:calc(50% - 8px);
    width:50%;
    margin-right: 8px;
    padding:24px 12px;
    background: linear-gradient(144.33deg, #F97B4A -1.22%, #C6278D 55.16%, #4200FF 97.95%);
    /* opacity: 0;
    transition: transform 1s ease, opacity 1s ease;
    transform: translateY(100px); */
  }
  .left-column-bot.in-viewport {
    transform: translateY(0);
    opacity: 1;
  }
  .heading {
    display: flex;
    flex-direction: row;
    flex-wrap:nowrap;
    align-items: center;
  }
  .heading button {
    border-width:0;
    background-color: transparent;
    padding:0 32px;
    color:#fff;

  }
  .instagram-post {
    /* max-height: 700px; */
    margin-top: 16px;
  }
  .instagram-post a {
    width:100%;
    height:100%;
  }
  .instagram-post img {
    width:100%;
    height:100%;
    object-fit: cover;
    object-position: center;
  }

  h2 {
    color:#fff;
    font-size: 30px;
    font-weight: bold;
    margin-bottom: 0;
    text-align: center;
  }
  @media (max-width:768px) {
    h2 {
      margin-bottom: 16px;
    }
  }
  @media (max-width: 550px) {
    .instagram-post {
      margin-top: 8px;
    }
  }
</style>
