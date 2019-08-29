<template>
  <div class="wrapper posts-tile-section">
    <div class="section-content">
      <div v-for="(post, index) in values" :key="index">
        <p class="heading">Post {{index + 1}}</p>
        <searchable-input
          class="searchable-input"
          :deletable="false"
          :placeholder="'Type post name'"
          :options="posts"
          label="title"
          v-model="values[index]"
        />
        <template v-if="index == 6">
          <input type="text" v-model="comment_seven_1" placeholder="First comment">
          <input type="text" v-model="comment_seven_2" placeholder="Second comment">
        </template>
        <template v-else-if="index == 7">
          <input type="text" v-model="comment_eight_1" placeholder="First comment">
        </template>
      </div>
      <button @click="save" class="theme-btn theme-btn-red big-btn">פרסם</button>
    </div>
  </div>
</template>

<script>
import SearchableInput from './../common/SearchableInput.vue';

export default {
  data(){
    return {
      selectedPosts: [],
      values: [],
      posts: [],
      comment_seven_1: '',
      comment_seven_2: '',
      comment_eight_1: '',
    };
  },
  components: {
    SearchableInput
  },
  methods: {
    getAllPostTitles() {
      axios.post('/api/getAllPostTitles').then(res => {
        this.posts = Object.values(res.data);
        this.posts.unshift({
          title: 'None',
          id: null,
        })
      });
    },
    getSelectedPosts(){
      axios.post('/api/getSelectedPosts').then(res => {
        this.values = Object.values(res.data);

        if(this.values[6]) {
          this.comment_seven_1 = this.values[6].meta.comment_one;
          this.comment_seven_2 = this.values[6].meta.comment_two;
          this.values[6] = this.values[6].data;
        }

        if(this.values[7]) {
          this.comment_eight_1 = this.values[7].meta.comment_one;
          this.values[7] = this.values[7].data;
        }  

        this.values = this.values.map(n => n ? n : {
          title: 'None',
          id: null,
        });

        this.selectedPosts = Object.values(res.data);
      });
    },
    selectPost(post){
      // console.log(post);
    },
    save() {

      const values = this.values.map(n => n.id ? n.id : null);

      axios.post('/api/editMainPagePosts', {
        mainPostId: values[0],
        secondPostId: values[1],
        thirdPostId: values[2],
        fourthPostId: values[3],
        fifthPostId: values[4],
        sixthPostId: values[5],
        seventhPostId: values[6],
        eighthPostId: values[7],
        // ninthPostId: values[2],
        // tenthPostId: values[3],
        comment_seven_1: this.comment_seven_1,
        comment_seven_2: this.comment_seven_2,
        comment_eight_1: this.comment_eight_1,
      }).then(response => {
        alert('נשמר!');
      });
    }
  },
  created() {
    this.getAllPostTitles();
    this.getSelectedPosts();
  }
}
</script>

<style lang="scss" scoped>
.section-content {
  padding: 35px 70px 65px;
}
.searchable-input {
  width: 100%;
}
p {
  margin-bottom: 10px;
}
button {
  margin-top: 30px;
}
</style>

<style lang="scss">
.posts-tile-section{
  .searchable-input{
    input{
      width: 100%;
    }
  }
}
</style>
