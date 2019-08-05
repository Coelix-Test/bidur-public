<template>
  <div class="post-wrapper">
    <div ref="outbrainContainer" class="w-100">
      <div class="OUTBRAIN" :data-src="curPageLink" data-widget-id="GS_3"></div>

    </div>
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

    this.$refs.outbrainContainer.appendChild(scriptEl);
    // console.log(this.$refs.outbrainContainer);
  }
}
</script>

<style lang="scss" scoped>
</style>
