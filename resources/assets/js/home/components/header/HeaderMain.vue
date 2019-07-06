<template>
  <div class="header-main">
    <header-top-line></header-top-line>
    <div class="celebrities-container">
      <div class="celebrities-slider">
        <a v-for="hashtag in hashtags" href="#" class="np-slide-item">
          <div class="celebrity">
            <div class="img-wrap">
              <div class="image" style="background-image: url('');"></div>
            </div>
            <div class="name"></div>
          </div>
        </a>
      </div>
    </div><!-- celebrities row end-->
    <div class="run-stroke-wrap-wrap" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
      <div class="run-stroke-wrap" style="margin:0 auto;max-width:1440px;box-shadow:unset;">
        <ul class="run-stroke">
          <li v-for="title in postTitles">{{title}}</li>
        </ul>
        <ul class="run-stroke hidden">
          <li v-for="title in postTitles">{{title}}</li>
        </ul>
      </div>
    </div>
  </div>

</template>

<script>
import HeaderTopLine from './HeaderTopLine.vue';

export default {
  data(){
    return {
      hashtags: [],
      postTitles: []
    };
  },
  components: {
    HeaderTopLine
  },
  methods: {
    getAllHashtags(){
      axios.post('/getAllHashtags')
          .then(response => {

              console.log(response.data);
          });
    },
  },
  created(){
    this.getAllHashtags();
    // this.getAllPostTitles();
  }
}
</script>

<style lang="scss" scoped>
</style>
