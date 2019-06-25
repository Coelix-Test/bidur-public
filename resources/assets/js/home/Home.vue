<template>
  <div class="home">



    <right-column />
    <left-column v-if="leftPosts.length" :data="leftPosts" />

  </div>
</template>

<script>
import RightColumn from './views/RightColumn.vue';
import LeftColumn from './views/LeftColumn.vue';
export default {
  data() {
    return  {
      getAllPosts : null,
      postRandomIds : [],
      randomPosts : [],
      randomPost : '',
      leftPosts : []
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
         let postIds = [];

         this.getAllPosts.forEach(function(el) {
           postIds.push(el.post.id);
         });
         postIds.sort(function compareRandom(a, b) {
          return Math.random() - 0.5;
        });
        postIds.forEach( (el) => {
           //axios.post('/getInfoOnPostForMain', {id : el} ).then(response => { this.randomPosts.push(response.data) });

        });
        this.leftPosts = postIds.slice(0,2);
        }
     );

 },
 watch : {
   getAllPosts : function() {




   },
 },
 components : {
   RightColumn,
   LeftColumn
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
    flex-wrap:nowrap;
    align-items: flex-start;
  }
  @media (max-width:768px) {
    .home {
      flex-direction:column;
    }

  }
</style>
