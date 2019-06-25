<template>
  <div class="left-column posts-column">

    <article v-for="post in twoPosts" >
      
      <div class="overlay"></div>
      <img :src="post.img" alt="">
      <h2>{{post.title}}</h2>
      <p>
        <span class="author">{{post.author}}</span>
        <span class="post-date">{{post.time}}</span>
      </p>
    </article>
  </div>
</template>

<script>
export default {
  props : {
    data : {
      requred: true,
    }
  },
  data() {
    return {
      twoPosts : [],
      randomPosts : this.data,

    }
  },
  mounted() {
     console.log('randomPosts', this.randomPosts);
    // axios.post('/getTwoRandomPosts').then(response => {
    //   //this.twoPosts = (response.data);
    //   response.data.forEach( (el)=> {
    //     axios.post('/getInfoOnPostForMain', {id : el.id} ).then(response => { this.twoPosts.push(response.data) });
    //     console.log('el.id', el.id);
    //   } );
    //
    // });
  },
  created() {
    this.data.forEach( (el)=> {
      axios.post('/getInfoOnPostForMain', {id : el} ).then(response => { this.twoPosts.push(response.data) });
    } );
  }
}
</script>

<style lang="css" scoped>
  .left-column {
    flex-basis:50%;
    padding-right:8px;
  }
  .posts-column {
    width:100%;
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }
  .posts-column article {
    width:100%;
    position: relative;
    padding:256px 16px 48px;
    margin-bottom: 16px;
    display: flex;
    flex-direction: column;
    color:#fff;
  }
  .posts-column article img {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    width:100%;
    height: 100%;
    pointer-events: none;
    z-index:-2;
    object-fit: cover;
  }
  .posts-column article .overlay {
    position: absolute;
    z-index: -1;
    top: 0;
    right: 0;
    left: 0;
    bottom: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    opacity: .5;
    background: linear-gradient(180deg, #7EFFB7 0%, #0089FF 100%);
  }
  .posts-column article .overlay:last-child  {
    background: linear-gradient(360deg, #F6AB62 0%, #B63E8E 40.1%, #3F5EFB 100%);
  }
  .posts-column article h2 {
    font-family: 'Playfair Display', sans-serif;
    font-weight: 700;
    font-size: 36px;
    line-height: 48px;
  }
  .posts-column article p {
    display: flex;
    flex-direction: row;
    font-size: 20px;
    font-weight: 600;
  }
</style>
