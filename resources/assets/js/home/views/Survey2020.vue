<template>
  <iframe 
    src="https://survey.israelbidur.coelix.online/" 
    frameborder="0"
  ></iframe>
</template>

<script>

export default {
   name: 'App',
    metaInfo: {
      title: 'Survey',
      meta: [
            { 
                content: 'img/meta.jpg',
                property : 'og:image'
            }
        ]
    }
}
</script>

<style lang="scss" scoped>

@media screen and (min-width: 480px) {
  iframe {
    width: 100%;
    height: 1000px;
    }
}
@media screen and (max-width: 480px) {
  iframe {
    width: 100%;
    height: 650px;
    }
}

@media screen and (max-width: 480px) and (min-height: 710px) {
  iframe {
    width: 100%;
    height: 735px;
  }
}

</style>
<style lang="scss">
</style>