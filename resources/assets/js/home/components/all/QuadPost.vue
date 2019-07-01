<template>
  <div class="quad-post">
    <img src="https://via.placeholder.com/1140x620">
    <div class="content">
      <div class="title">
        6 JOBS THAT PROBABLY
        WON’T BE AROUND IN 10 YEARS
      </div>
      <div class="subtitle">
        by Helen Nilova | 5 hours ago
      </div>
      <div class="text">
        Whether you’re trying to figure out a career path tailored to your abilities, or just curious of the kinds of jobs that society is slowly fading out, Boss Girl has the rundown on the 6 jobs that probably...Whether you’re trying to figure out a career path tailored to your abilities, or just curious of the kinds of jobs that society is slowly fading out, Boss Girl has the rundown on the 6 jobs that probably...Whether you’re trying to figure out a career path tailored to your abilities, or just curious of the kinds of jobs that society is slowly fading out, Boss Girl has the rundown on the 6 jobs that probably...Whether you’re trying to figure out, Boss Girl has the rundown on the 6 jobs that probably...
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {

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

    .title {
      text-align: left;
      font-weight: bold;
      font-size: 36px;
      color: #333333;
      max-width: 600px;
    }
    .subtitle {
      font-weight: 300;
      font-size: 24px;
      text-align: left;
      color: #333333;
      margin: 10px 0;
    }
    .text {
      font-size: 18px;
      text-align: left;
      color: #828282;
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
