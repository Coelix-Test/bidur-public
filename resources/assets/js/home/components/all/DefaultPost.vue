<template>
  <div class="default-post">
    <div class="image"></div>
    <div class="desc">
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
    background-image: url(https://via.placeholder.com/380x600);
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    width: 300px;
    min-width: 300px;
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
