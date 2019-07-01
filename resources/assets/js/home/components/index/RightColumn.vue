<template>
  <div class="right-column">
    <article class="birthdayPost">
      <a href="#">
        <div class="overlay"></div>
        <img  alt="">
        <h2>BIRTHDAY POST<br> Birthday post 2</h2>

      </a>
    </article>
    <ul v-if="posts" class="posts">
      <li v-for="post in posts">
        <a class="post" :href="'/post/'+post.id">
          <div class="overlay"></div>
          <img :src="post.img" alt="">
          <h2>{{post.title}}</h2>
          <p>
            <span class="author">by Author</span>
            <span class="post-date">{{post.time}}</span>
          </p>
        </a>
      </li>
    </ul>


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
      randomPosts : [],
      posts : [],
      birthdayPost : []
    }
  },
  created() {
    // console.log(this.data)
    this.data.forEach( (el)=> {
      axios.post('/getInfoOnPostForMain', {id : el} ).then(response => {
         this.posts.push(response.data);
         

       });
    });
  //  console.log('this.posts', this.posts);
  }
}
</script>

<style lang="css" scoped>
  .right-column {
    flex-basis:50%;
    padding-left: 8px;
  }
  .birthdayPost {
    width: 100%;
    position: relative;
    padding: 0 24px 16px;
    margin-bottom: 16px;
    display: -webkit-box;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    flex-direction: column;
    justify-content: flex-end;
    color: #fff;
    height:450px;
    overflow: hidden;
    background-color: rgba(100,100,100,0.7);
  }
  .birthdayPost a {
    color:#fff;
    text-decoration: none;
  }
  .birthdayPost h2 {
    font-size: 2em;
    text-align: center;
    margin-bottom: 0;
  }
  ul.posts {
    display: flex;
    flex-direction: row;
    flex-wrap:wrap;
    align-items: flex-start;
    justify-content: space-between;
    margin: 0;
    padding: 0;
    height:450px;
  }
  ul.posts li {
    list-style-type: none;
    flex-basis: calc(50% - 8px);
    box-sizing: border-box;
    height:216px;
    overflow:hidden;
    position: relative;
  }
  ul.posts li:nth-child(3), ul.posts li:nth-child(4) {
    align-self: flex-end;
  }
  ul.posts li a {
    width:100%;
    height:100%;
    box-sizing: border-box;
    position: relative;
    padding:80px 24px 16px;
    min-height:150px;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    color:#fff;
    text-decoration: none;
    position: relative;
  }
  ul.posts li a .overlay {
    width: 100%;
    height: 100%;
    position: absolute;
    pointer-events: none;
    z-index: -1;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    opacity: .3;
    transition: .3s;
  }
  ul.posts li:nth-child(1) a .overlay {
    background: linear-gradient(270deg, #403EC0 2.58%, #3BB9FE 78.1%, #00F0FF 97.67%);
  }
  ul.posts li:nth-child(2) a .overlay {
    background: linear-gradient(270deg, #FFFB95 0.51%, #FF004D 99.32%);
  }
  ul.posts li:nth-child(3) a .overlay {
    background: linear-gradient(180deg, rgba(255, 131, 131, 0) 47.95%, #4200FF 100%);
  }
  ul.posts li:nth-child(4) a .overlay {
    background: linear-gradient(180deg, rgba(128, 241, 255, 0.66) 55.56%, #1389EF 100%);
  }
  ul.posts li:hover img {
    transform:scale(1.1);
  }
  ul.posts li a:hover .overlay {
    background: rgba(0,0,0,1);
  }
  ul.posts li a h2 {
    font-weight: 700;
    margin-bottom: 0;
    font-size: 24px;
    text-transform: uppercase;
  }
  ul.posts li a p {
    margin-bottom: 0;
  }
  ul.posts li a img {
    position: absolute;
    top:0;
    bottom: 0;
    right: 0;
    left: 0;
    width:100%;
    height:100%;
    object-fit: cover;
    object-position: center;
    z-index: -2;
    transition: .3s;
  }
  ul.posts li a p .author {
    border-right:1px solid #fff;
    padding-right: 6px;
  }
  @media (max-width:768px) {
    .right-column {
      padding-left: 0;
      order:2;
    }
    .birthdayPost h2 {
      font-size: 1.6em;
    }
  }
  @media (max-width:550px) {
    ul.posts {
      height:auto;
    }
    .birthdayPost {
      height: 200px;
      margin-bottom: 8px;
    }
    ul.posts li {
      flex-basis:100%;
      height:auto;
      margin-bottom: 8px;
    }
  }
</style>
