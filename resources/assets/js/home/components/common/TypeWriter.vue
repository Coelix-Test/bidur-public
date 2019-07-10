<template>
  <span>{{textToShow}}</span>
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
    }
  },
  methods: {
    typeWriter() {

      if (this.textToShow.length < this.text.length) {
        this.textToShow += this.text.charAt(this.textToShow.length);
        if(this.textToShow.length < this.text.length){
          setTimeout(this.typeWriter, this.speed);
        }else{
          setTimeout(this.typeWriter, this.pause);
        }
      }
      else{
        this.textToShow = '';
        setTimeout(this.typeWriter, this.speed);
      }
    }
  },
  mounted() {
    this.typeWriter();
  }
}
</script>

<style lang="css" scoped>
</style>
