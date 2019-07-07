<template>
  <div class="right-column">
    <article v-if="birthdayPost" v-in-viewport.once class="birthdayPost">
      <img src="img/happyBdayOverlay.svg" alt="">
      <h2>{{birthdayPost.text}}</h2>
      <div class="bdayInner">
        <div class="overlay"></div>
        <img :src="birthdayPost.img" alt="">
      </div>
    </article>
    <ul v-in-viewport.once v-if="posts" class="posts">
      <li v-for="post in posts">
        <div class="background-square"></div>
        <router-link class="post" :to="'/post/'+post.id">
          <div class="overlay"></div>

          <img :src="post.img" alt="">
          <h2>{{post.title}}</h2>
          <p>
            <span class="author">{{ post.author }}</span>
            <span class="post-date">{{  new Date(post.time*1000) | formatDate }}</span>
          </p>
        </router-link>
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
      posts : this.data,
      birthdayPost : null
    }
  },
  created() {
    axios
      .post('/getMainBday')
        .then(res => {
          this.birthdayPost = res.data;
          // console.log(this.birthdayPost);
        });
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
    margin-bottom: 48px;
    display: -webkit-box;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    flex-direction: column;
    justify-content: flex-end;
    color: #fff;
    height:500px;
    /* overflow: hidden; */
    /* background-color: rgba(100,100,100,0.7); */
    opacity: 0;
    transition: transform 0.5s ease, opacity 0.5s ease;
    transform: translateX(100px);
    padding:80px 32px 12px;
  }
  .birthdayPost.in-viewport {
    transform: translateX(0);
    opacity: 1;
  }
  .birthdayPost > div.bdayInner {
    color:#fff;
    text-decoration: none;
    width:100%;
    height: 100%;
    position: relative;
  }
  .birthdayPost h2 {
    font-size: 2em;
    text-align: center;
    margin-bottom: 0;
    position: absolute;
    right:32px;
    top:0;
    color:#F2C94C;
    text-align: right;
    z-index:5;
    font-family: 'Levin','Assistant',sans-serif;
  }
  .birthdayPost .overlay {
    position: absolute;
    top:0;
    left:0;
    right:0;
    bottom:0;
    border:4px solid #F2C94C;
    transform:rotate(3deg);

  }
  .birthdayPost img {
    max-width:100%;
    width:100%;
    height: 100%;
    object-fit: cover;
  }
  .birthdayPost > img {
    object-fit: contain;
    position: absolute;
    z-index:2;
    pointer-events: none;
  }
  .birthdayPost .overlay img {
    object-fit: cover;
  }
  ul.posts {
    display: flex;
    flex-direction: row;
    flex-wrap:wrap;
    align-items: flex-start;
    justify-content: space-between;
    margin: 0;
    padding: 0;
    margin-bottom: 24px;
    opacity: 0;
    transition: transform 1s ease, opacity 1s ease;
    transform: translateX(100px);
  }
  ul.posts.in-viewport {
    transform: translateX(0);
    opacity: 1;
  }
  ul.posts li {
    list-style-type: none;
    flex-basis: calc(50% - 8px);
    box-sizing: border-box;
    height:241px;
    position: relative;
  }
  ul.posts li .background-square {
    width: 100%;
    height: 100%;
    position: absolute;
    pointer-events: none;
    z-index: -2;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    opacity: 1;
    transform: translate(8px, 8px);
    transition: .3s;

  }
  ul.posts li:nth-child(3), ul.posts li:nth-child(4) {
    align-self: flex-end;
  }
  ul.posts li:nth-child(2) {
    margin-top: 24px;
  }
  ul.posts li:nth-child(3) {
    margin-bottom: auto;
  }
  ul.posts li:nth-child(4) {
    margin-top: 48px;
  }
  ul.posts li:nth-child(2) .background-square,
  ul.posts li:nth-child(3) .background-square {
    background-color: #F2C94C;
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
    overflow: hidden;
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
    /* opacity: .3; */
    transition: .3s;
  }

  ul.posts li:nth-child(1) a .overlay {
    background: linear-gradient(0deg, #3E64C0 0%, #3BB9FE 16.13%, rgba(0, 240, 255, 0) 68.63%);
  }
  ul.posts li:nth-child(2) a .overlay {
    background: linear-gradient(180deg, rgba(255, 251, 149, 0) 71.7%, rgba(255, 149, 155, 0.83) 82.92%, rgba(255, 100, 129, 0.885638) 89.04%, #FF004D 101.62%);
  }
  ul.posts li:nth-child(3) a .overlay {
    background: linear-gradient(180deg, rgba(255, 131, 131, 0) 47.95%, #4200FF 100%);
    opacity: .5;
  }
  ul.posts li:nth-child(4) a .overlay {
    background: linear-gradient(180deg, #FDA014 55.56%, #1389EF 100%);
    opacity: .5;
  }
  ul.posts li:hover img {
    transform:scale(1.1);
  }
  ul.posts li a:hover .overlay {
    background: rgba(0,0,0,0.2);
  }
  ul.posts li a h2 {
    font-weight: 700;
    margin-bottom: 0;
    font-size: 24px;
    text-transform: uppercase;
  }
  ul.posts li a p {
    margin-bottom: 0;
    display: flex;
    flex-direction: row;
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
  ul.posts li a p .post-date {
    border-right:1px solid #fff;
    padding-right: 6px;
    margin-right: 4px;
    /* white-space: nowrap; */
  }
  @media (max-width:768px) {
    .right-column {
      padding-left: 0;
      order:3;
      display: flex;
      flex-direction: column-reverse;
    }
    ul.posts li {
      flex-basis: calc(50% - 4px);
    }
    ul.posts li a h2 {
      font-size: 16px;
      line-height: 16px;
    }
    ul.posts li a {
      padding:80px 8px 8px;
    }
    ul.posts li:nth-child(2),
    ul.posts li:nth-child(3) {
      margin-top: 0;
      margin-bottom: 8px;
    }
    ul.posts li:nth-child(4) {
      margin-top: 0;
    }
    ul.posts li .background-square {
      background-color: transparent;
      display: none;
    }
    .birthdayPost h2 {
      right:8px;
      top:8px;
      font-size: 1.6em;
    }
    .birthdayPost {
      padding: 0;
      margin-top: 16px;
      margin-bottom: 32px;
      padding-top: 120px;
      box-sizing: content-box;
    }
    ul.posts li a p {
      font-size: 13px;
      line-height: 13px;
      margin-top: 8px;
    }
  }
  @media (max-width:550px) {


    ul.posts {
      height:auto;
    }
    .birthdayPost {
      height: 200px;
      margin-bottom: 16px;
    }
    ul.posts li {
      /* flex-basis:100%;
      height:auto; */
      margin-bottom: 8px;
    }
  }
</style>
