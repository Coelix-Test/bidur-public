<template>
  <div class="post-list">
    <div class="posts-wrapper">
      <div v-for="post in posts" v-if="posts" class="post" :key="post.post.id">

        <h2>{{post.post.metaTitle}}</h2>
        <div class="post-meta">
          <span class="date">{{post.post.created_at}}</span>
          <span class="author">by {{post.post.author}}</span>
          <span class="id">#{{post.post.id}}</span>
        </div>
        <div class="actions">
          <a :href="'.#/post/'+post.post.id" target="_blank">view</a>
          <button @click="editPost(post.post.id)">edit</button>
          <button @click="deletePost(post.post.id)">delete</button>
        </div>

      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      posts : null
    }
  },
  created() {
    axios
      .post('/getAllPosts')
        .then(res => {
          this.posts = res.data;
        });
  },
  methods : {
    editPost(id) {
      this.$router.push({ name: 'post-single', params: { id: id } });
    },
    deletePost(id) {
      axios
        .post('/deletePost',{id : id})
          .then(res => {
              this.posts = res.data;
              alert('Post Deleted!');
          });
    }
  }
}
</script>

<style lang="scss" scoped>
  .post-list {
    max-width:1440px;
    padding:0 24px;
    margin: 32px auto;
      .posts-wrapper {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: flex-start;
        align-items: flex-start;
          .post {
            flex-basis: calc(25% - 24px);
            padding:12px;
            margin:0 12px 16px;
            border:1px solid #eee;
            box-shadow:0 0 12px rgba(0,0,0,0.1);
            color:#000;
              h2 {

              }
              .post-meta {
                display: flex;
                flex-direction: row;
                justify-content: flex-start;
                align-items: flex-end;
                border-bottom: 1px solid #eee;
                padding-bottom: 6px;
                margin-bottom: 6px;
                  .author {
                    margin-right: 6px;
                    padding-right: 6px;
                    border-right: 1px solid #000;
                  }
                  .id {
                    color:lightgrey;
                    margin-right: 16px;
                  }
              }
              .actions {
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: row;
                  button, a {
                    border-width:0;
                    background-color: transparent;
                    margin: 0 8px;
                    font-weight: 600;
                    display: block;
                    color:#000;
                      &:hover {
                        color:#EB5757;
                      }
                  }
              }
          }
      }
  }
</style>
