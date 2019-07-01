<template>
  <main>
    <div class="main-content">
      qweqweqweqweqweq
    </div>
    <side-news/>
  </main>
</template>

<script>
import SideNews from './../components/SideNews.vue';

export default {
  components: {
    SideNews,
  }
}
</script>

<style lang="scss" scoped>

main {
  display: flex;
  flex-direction: 'row';
  justify-content: flex-start;
  align-items: flex-start;
  padding: 0 30px;
  .main-content {
    flex-grow: 1;
  }
}

</style>
