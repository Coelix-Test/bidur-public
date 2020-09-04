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

</style>
<style lang="scss">
@media (max-width: 992px){
  #footer_main{
    margin-top: -8px;
    .contact-line{
      display: none;
    }
  }
  main{
    flex-grow: 0 !important;
  }
}
</style>