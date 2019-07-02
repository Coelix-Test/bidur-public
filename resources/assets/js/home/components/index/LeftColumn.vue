<template>
  <div class="left-column posts-column">

    <article v-for="post in posts" >
      <router-link :to="'/post/'+post.id">
        <div class="overlay"></div>
        <img :src="post.img" alt="">
        <h2>{{post.title}}</h2>
        <p>
          <span class="author">by {{ post.author }}</span>
          <span class="post-date">{{ post.time }}</span>
        </p>
      </router-link>
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
      posts : this.data,

    }
  },
  mounted() {
     //console.log('randomPosts', this.randomPosts);
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
    // this.data.forEach( (el)=> {
    //   axios.post('/getInfoOnPostForMain', {id : el} ).then(response => { this.twoPosts.push(response.data) });
    // } );
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
    margin-bottom: 16px;
    height:450px;
    overflow: hidden;
  }
  .posts-column article:nth-child(1) a {
    box-sizing: border-box;
    border: 6px solid transparent;
    position: relative;
    z-index:5;
  }
  .posts-column article:nth-child(1):after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    background: linear-gradient(60deg, #F2C94C, #F2C94C, #F2C94C, #F2C94C, #CD9E25, #CD9E25, #CD9E25, #CD9E25);
    z-index: -1;
    animation: animatedgradient 3s ease alternate infinite;
    background-size: 300% 300%;
  }
  .posts-column article a {
    justify-content: flex-end;
    width:100%;
    height:100%;
    display: flex;
    flex-direction: column;
    color:#fff;
    padding:0 24px 16px;
    color:#fff;
    transition: .2s;
    text-decoration: none;
    overflow:hidden;
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
    transition:.3s;
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
    transition: .3s;
    /* background: linear-gradient(180deg, #7EFFB7 0%, #0089FF 100%); */
  }
  .posts-column article:nth-child(2) .overlay  {
    background: linear-gradient(180deg, rgba(255, 131, 131, 0) 47.95%, #4200FF 100%);
  }
  .posts-column article:hover img {
    transform:scale(1.1);
  }
  .posts-column article:nth-child(1):hover a{
    border-width:12px;
  }
  .posts-column article:hover .overlay {
    background: rgba(0,0,0,0.6);
  }
  .posts-column article h2 {
    font-family: 'Assistant', sans-serif;
    font-weight: 700;
    font-size: 36px;
    line-height: 36px;
  }
  .posts-column article p {
    /* display: flex;
    flex-direction: row; */
    font-size: 20px;
    font-weight: 400;
    margin-bottom: 0;
  }
  .posts-column article p .author {
    border-right:1px solid #fff;
    padding-right: 6px;
  }
  @media (max-width:768px) {
    .posts-column {
      padding-right: 0;
    }
    .left-column {
      order:1;
    }
    .posts-column article {
      height:200px;
    }
  }
  @media (max-width:550px) {
    .posts-column article {
      margin-bottom: 8px;
    }
  }
  @keyframes animatedgradient {
	0% {
		background-position: 0% 50%;
	}
	50% {
		background-position: 100% 50%;
	}
	100% {
		background-position: 0% 50%;
	}
}
</style>
