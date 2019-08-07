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
      </div>
      <div v-for="(post, index) in additional_values" :key="index + 7">
        <p class="heading">Post {{index + 7}}</p>
        <searchable-input
          class="searchable-input"
          :deletable="false"
          :placeholder="'Type post name'"
          :options="posts"
          label="title"
          v-model="additional_values[index]"
        />
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
      additional_values: [],
      posts: [],
    };
  },
  components: {
    SearchableInput
  },
  methods: {
    getAllPostTitles(){
      axios.post('/getAllPostTitles').then(res => {
        this.posts = Object.values(res.data);
      });
    },
    getSelectedPosts(){
      axios.post('/getSelectedPosts').then(res => {
        this.values = Object
          .values(res.data)
          .filter((n, i) => i < 6);

        this.additional_values = Object
          .values(res.data)
          .filter((n, i) => i >= 6);

        if(!this.additional_values.length) {
          this.additional_values = new Array(4).map(n => null);
        }

        this.selectedPosts = Object.values(res.data);
      });
    },
    selectPost(post){
      // console.log(post);
    },
    save() {
      axios.post('/editMainPagePosts', {
        mainPostId: this.values[0].id,
        secondPostId: this.values[1].id,
        thirdPostId: this.values[2].id,
        fourthPostId: this.values[3].id,
        fifthPostId: this.values[4].id,
        sixthPostId: this.values[5].id,
        seventhPostId: this.additional_values[0].id,
        eighthPostId: this.additional_values[1].id,
        ninthPostId: this.additional_values[2].id,
        tenthPostId: this.additional_values[3].id,
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
