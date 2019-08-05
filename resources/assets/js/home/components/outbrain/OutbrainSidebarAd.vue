<template>
  <div class="banner" ref="scriptContainer">
    <div class="OUTBRAIN" :data-src="curPageLink" data-widget-id="GS_1"></div>

  </div>
</template>

<script>
export default {
  computed: {
    curPageLink(){
      return window.location.href;
    }
  },
  mounted(){
    let scriptEl = document.createElement('script');
    scriptEl.setAttribute('type', 'text/javascript');
    scriptEl.setAttribute('async', 'async');
    scriptEl.setAttribute('src', '//widgets.outbrain.com/outbrain.js');
    this.$refs.scriptContainer.appendChild(scriptEl);
  },
}
</script>

<style lang="scss" scoped>
</style>
