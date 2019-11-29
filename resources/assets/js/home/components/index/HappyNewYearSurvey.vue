<template>
  <div class="happy-new-year-survey" @click="go">
    <img v-if="$env.MOBILE" src="/img/BANNER1.svg">
    <img v-else src="/img/BANNER.png">
  </div>
</template>

<script>
export default {
  methods: {
    go() {
      if(!this.$root.is_user_logged_in) {
        this.$root.openLogin();
      } else {
        this.$router.push('/new-year-survey');
      }
    }
  }
}
</script>

<style lang="scss" scoped>

.happy-new-year-survey {
  img {
    width: 100%;
    min-height: 200px;
    object-fit: cover;
  }
}

</style>