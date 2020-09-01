<template>
  <iframe 
    src="https://survey.israelbidur.coelix.online/" 
    frameborder="0"
  ></iframe>
</template>

<script>
export default {

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
    height: 600px;
    }
}

</style>