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
                    @select="selectPost">
                </searchable-input>
            </div>
            <button class="theme-btn theme-btn-red big-btn">Save</button>
        </div>
    </div>
</template>

<script>
import SearchableInput from './../common/SearchableInput.vue';

export default {
    data(){
        return {
            selectedPosts: [
                {label:'Main post', id: '', title: ''},
                {label:'Second post', id: '', title: ''},
                {label:'Third post', id: '', title: ''},
                {label:'Fourth post', id: '', title: ''},
                {label:'Fifth post', id: '', title: ''},
                {label:'Sixth post', id: '', title: ''},
            ],
            posts: []
        };
    },
    components: {
        SearchableInput
    },
    methods: {
        getAllPostTitles(){
            axios.post('/getAllPostTitles')
                .then(response => {
                    this.posts = response.data;
                });
        },
        getSelectedPosts(){
            axios.post('/getSelectedPosts')
                .then(response => {
                    console.log(response.data);
                    // response.data.forEach((item, i) => {
                    //     delete item.img;
                    //  });
                });
        },
        selectPost(post){

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
