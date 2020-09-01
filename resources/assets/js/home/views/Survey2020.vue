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
                name : 'meta-image',
                content: 'https://survey.israelbidur.coelix.online/images/meta.jpg',
                htmlAttrs: {
                    property : 'og:image'
                }
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

</style>