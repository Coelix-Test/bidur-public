<template>
  <section class="side-news">

    <div class="ad">
      <a href="https://beachingbody.com/shop/" target="_blank">
        <img v-bind:src="selectedImage">
      </a>
    </div>

    <div class="block">
      <side-news-post
        v-for="(item, i) in data"
        :key="item.id"
        :data="item"
        v-if="i <= 4"
      />
    </div>

    <outbrain-sidebar-ad></outbrain-sidebar-ad>

    <div class="block">
      <side-news-post
        v-for="(item, i) in data"
        :key="item.id"
        :data="item"
        v-if="i > 4 && i < 10"
      />
    </div>
  </section>
</template>

<script>
import SideNewsPost from './SideNewsPost.vue'
import OutbrainSidebarAd from './outbrain/OutbrainSidebarAd.vue'

export default {
  data() {
    return {
      images : ['/img/ad/ad1v2.jpeg','/img/ad/ad2v2.jpeg','/img/ad/ad3v2.jpeg'],
      selectedImage : '/img/ad/ad1v2.jpeg',
      data: []
    };
  },
  components: {
    SideNewsPost,
    OutbrainSidebarAd
  },
  created() {

    const idx = Math.floor(Math.random() * this.images.length);
    this.selectedImage = this.images[idx]

    if(this.$route.name === 'single-post'){
      axios.post('/api/getRecentPosts', {postId: this.$route.params.id}).then(res => {
        this.data = res.data;
      });
    } else{
      axios.post('/api/getRecentPosts').then(res => {
        this.data = res.data;
      });
    }
  },
}
</script>

<style lang="scss" scoped>

.ad img{
  width : 100%;
}
.side-news {
  display: flex;
  flex-direction: column;
  align-items: stretch;
  width: 380px;
  min-width: 380px;
  padding-right: 12px;
  padding-left: 12px;
  overflow: hidden;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
  .block {
    background: #FFFFFF;
    // box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: stretch;
    margin-bottom: 30px;
  }
  .banner {
    width: 100%;
    height: auto;
    margin-bottom: 30px;
  }

  @media(max-width: 768px) {
    padding-right: 0;
    width: 100%;
    min-width:unset;
    padding-left: 0;
    .banner {
      height:300px;
      object-fit: cover;
    }
  }
}

</style>
