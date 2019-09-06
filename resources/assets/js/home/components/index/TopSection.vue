<template>
  <div class="top-section">

    <TopSectionFirst/>
    <TopSectionSecond/>

  </div>
</template>

<script>
import TopSectionFirst from './TopSectionFirst'
import TopSectionSecond from './TopSectionSecond'

export default {
  components: {
    TopSectionFirst,
    TopSectionSecond,
  },

}
</script>

<style lang="scss" scoped>

.top-section {
  width: 100%;

  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: flex-start;

  padding-bottom: 30px;

  @media(max-width: 767px) {
    flex-direction: column;
    padding: 8px;
    // order: 5;//remove in future
    // margin-bottom: -20px;//temp shit
  }

  @media (max-width: 556px){
    .top-section .post.first .title .main{
      font-size: 26px;
    }
  }

}

</style>
