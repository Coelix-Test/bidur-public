<template>
  <div class="home">



    <right-column v-if="rightPosts.length" :data="rightPosts" />
    <left-column v-if="leftPosts.length" :data="leftPosts" />

    <right-column-bot />
    <left-column-bot v-if="latestPosts.length" :data="latestPosts" />

  </div>
</template>

<script>
import RightColumn from './views/RightColumn.vue';
import LeftColumn from './views/LeftColumn.vue';
import LeftColumnBot from './views/LeftColumnBot.vue';
import RightColumnBot from './views/RightColumnBot.vue';
export default {
  data() {
    return  {
      getAllPosts : null,
      postRandomIds : [],
      randomPosts : [],
      randomPost : '',
      leftPosts : [],
      rightPosts : [],
      latestPosts : []
    }
  },
  methods : {

  },
  mounted() {
   axios
     .post('/getAllPosts')
     .then(
       response => {
         this.getAllPosts = response.data;
        // this.latestPosts = this.getAllPosts.reverse().slice(0,8);
         let postIds = [];
         let latestPostsId = [];

         this.getAllPosts.forEach( (el) => {
           postIds.push(el.post.id);
           latestPostsId.push(el.post.id);
           // this.latestPosts.push(el.post.id);
         });
         this.latestPosts = latestPostsId.reverse().slice(0,8);
         postIds.sort(function compareRandom(a, b) {
          return Math.random() - 0.5;
        });
        postIds.forEach( (el) => {
           //axios.post('/getInfoOnPostForMain', {id : el} ).then(response => { this.randomPosts.push(response.data) });

        });
        this.leftPosts = postIds.slice(0,2);
        this.rightPosts = postIds.slice(2,6);
        }
     );

 },
 watch : {
   getAllPosts : function() {




   },
 },
 components : {
   RightColumn,
   LeftColumn,
   LeftColumnBot,
   RightColumnBot
 }
}
</script>

<style lang="css" scoped>
  .home {
    max-width: 1440px;
    margin:48px auto 32px;
    padding:0 24px;
    display: flex;
    flex-direction: row;
    flex-wrap:wrap;
    align-items: flex-start;
  }
  @media (max-width:768px) {
    .home {
      flex-direction:column;
      padding: 0 12px;
    }

  }
</style>
