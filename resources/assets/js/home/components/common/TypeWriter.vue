<template>
  <span class="--type-writer" ref="span">{{textToShow}}</span>
</template>

<script>
export default {
  data(){
    return {
      textToShow: '',
      speed: 80,
      pause: 1000
    };
  },
  props: {
    text: {
      default: ''
    },
    once: {
      default: false,
      type: Boolean,
    }
  },
  methods: {
    typeWriter() {
      if(this.textToShow.length < this.text.length) {
        this.textToShow += this.text.charAt(this.textToShow.length);
        if(this.textToShow.length < this.text.length) {
          setTimeout(this.typeWriter, this.speed);
        } else {
          setTimeout(this.typeWriter, this.pause);
        }
      } else {

        // force browser to redraw element (bug on post page)
        this.$refs.span.style.display = 'none';
        setTimeout(() => this.$refs.span.style.display = 'block', 10);

        if(!this.once) {
          this.textToShow = '';
          setTimeout(this.typeWriter, this.speed);
        }
      }
    }
  },
  mounted() {
    this.typeWriter();
  },
  watch: {
    text() {
      this.textToShow = '';
      this.$nextTick(() => {
        this.typeWriter();
      });
    }
  }
}
</script>

<style lang="css" scoped>
</style>
