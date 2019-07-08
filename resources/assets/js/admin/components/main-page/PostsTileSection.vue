<template>
    <div class="wrapper posts-tile-section">
        <div class="section-content">
            <div v-for="(post, index) in selectedPosts" :key="index">
                <p class="heading">{{post.label}}</p>
                <searchable-input
                    class="searchable-input"
                    :deletable="false"
                    :placeholder="'Type post name'"
                    :options="posts"
                    label="title"
                    v-model="values[index]"
                />
            </div>
            <button @click="save" class="theme-btn theme-btn-red big-btn">לשמור</button>
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
        };
    },
    components: {
        SearchableInput
    },
    methods: {
        getAllPostTitles(){
            axios.post('/getAllPostTitles').then(res => {
              this.posts = res.data;
            });
        },
        getSelectedPosts(){
            axios.post('/getSelectedPosts').then(res => {
              this.values = Object.values(res.data);
              this.selectedPosts = Object.values(res.data);
            });
        },
        selectPost(post){
          console.log(post);
        },
        save() {
          axios.post('/editMainPagePosts', {
            mainPostId: this.values[0].id,
            secondPostId: this.values[1].id,
            thirdPostId: this.values[2].id,
            fourthPostId: this.values[3].id,
            fifthPostId: this.values[4].id,
            sixthPostId: this.values[5].id,
          }).then(response => {
            console.log('saved');
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
    .section-content{
        padding: 35px 70px 65px;
    }
    .searchable-input{
        width: 100%;
    }
    p{
        margin-bottom: 10px;
    }
    button{
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
