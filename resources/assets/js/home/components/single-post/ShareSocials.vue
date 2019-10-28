<template>
  <div class="share-socials">
    <a
      :href="`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`"
      target="_blank"
    >
      <img src="/img/icons/social-facebook-colored.svg">
    </a>


    <a
      :href="`whatsapp://send?text=${encodeURIComponent(url)}`"
      target="_blank"
    >
      <img src="/img/whatsApp.svg">
    </a>


    <a
      :href="`https://telegram.me/share/url?url=${encodeURIComponent(url)}&text=בדוק את זה!`"
      target="_blank"
    >
      <img src="/img/icons/social-telegram-colored.svg">
    </a>
  </div>
</template>

<script>

export default {
  props: {
    link: {}
  },
  data() {
    return {
      
    };
  },
  methods: {

  },
  computed: {
    url() {
      return this.$env.URL + '/share/' + this.link;
    }
  }
}
</script>

<style lang="scss" scoped>

.share-socials {
  position: relative;
  display: flex;
  flex-direction: row;
  justify-content: center;
  padding: 20px 0;
  a {
    img {
      width:40px;
      height: 40px;
      margin: 0 8px;
    }
  }
}

</style>
