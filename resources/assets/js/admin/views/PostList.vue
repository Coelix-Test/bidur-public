<template>
  <div class="post-list">
    <div class="post-list-nav">
      <div class="filter-by-status">
        <a href="#"
          class="btn-common"
          :class="filters.published ? 'btn-red' : 'btn-border-dark'"
          @click.prevent="filters.published = true">
          פורסם
        </a>
        <a href="#"
          class="btn-common"
          :class="!filters.published ? 'btn-red' : 'btn-border-dark'"
          @click.prevent="filters.published = false">
          טיוטה
        </a>
      </div>
      <div class="search">
        <input type="text" @input="renderSearch" v-model="searchQuery" placeholder="">
      </div>
    </div>
    <div class="posts-wrapper">
      <template v-if="posts">
        <template v-for="(post, index) in filteredPosts">
          <div class="post" v-if="!isDeletedPost(post.post.id)" :key="post.post.id">

            <h2>{{post.post.metaTitle}}</h2>
            <div class="post-meta">
              <span class="date">{{post.post.created_at | formatDate}}</span>
              <span class="author">מאת {{post.post.author}}</span>
              <span class="id">#{{post.post.id}}</span>
            </div>
            <div class="actions">
              <a :href="'.#/post/'+post.post.id" target="_blank">צפייה</a>
              <!-- <button @click="editPost(post.post.id)">edit</button> -->
              <router-link :to="'/post/' + post.post.id">ערוך</router-link>
              <button v-if="post.is_in_main_section == null" @click.prevent="deletePost(post.post.id)">מחק כתבה</button>
            </div>

          </div>
        </template>
      </template>
      <div v-if="posts == null">
        פוסטים לא נמצאו!
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      posts : null,
      searchQuery : null,
      deletedPostsCount : 0,
      deletedPosts: [],
      page: 0,
      loading: false,
      end: false,
      filters: {
        published: true,
      }
    }
  },
  methods : {
    editPost(id) {
      this.$router.push({ name: 'post-edit', params: { id: id } });
    },
    deletePost(id) {
      let result = confirm('למחוק את הפוסט?');
      if(result == true) {
        axios
          .post('/deletePost',{id : id})
            .then(res => {
                if(res.data.success){
                    this.deletedPostsCount++;
                    this.deletedPosts.push(id);
                }
            });
      }
    },
    isDeletedPost(id){
      return this.deletedPosts.indexOf(id) > -1;
    },
    renderSearch() {
      axios
        .post('/postTitleSerach', {title : this.searchQuery})
          .then(res => {
            if(res.data.success != false) {
              this.posts = res.data;
            }else {
              this.posts = null;
            }

          })
          .catch(error => this.posts = null);
    },
    getPaginatedPosts(append = false) {
      this.loading = true;
      return axios.post('/getAllPostsPaginated', {
        page: this.page,
        deletedCounter: this.deletedPostsCount
      }).then(res => {
        this.loading = false;

        if(res.data.hasOwnProperty('success')) {
          var data = [];
        } else {
          var data = res.data;
        }

        if(append) {
          this.posts.push(...data);
        } else {
          this.posts = data;
        }

        if(!data.length) {
          this.end = true;
        }

      });
    },
    getNextPage() {
      this.page++;
      this.getPaginatedPosts(true);
    },
    onScroll(e) {
      var doc = document.documentElement;
      var screen = doc.clientHeight;
      var top = ((window.pageYOffset || doc.scrollTop) - (doc.clientTop || 0));

      if(top >= doc.scrollHeight - (screen * 2) && !this.loading && !this.end) {
        this.getNextPage();
      }
    },
  },
  computed: {
    filteredPosts(){
      // this.posts.filter(post => post.publish == this.filters.published);
      // return this.posts;
      return this.posts.filter(post => post.post.publish == this.filters.published);

    }
  },
  created() {
    this.getPaginatedPosts();
  },
  mounted(){
    document.addEventListener('scroll', this.onScroll);
  },
  destroyed(){
    document.removeEventListener('scroll', this.onScroll);
  }
}
</script>

<style lang="scss" scoped>
  .post-list {
    max-width:1440px;
    padding:0 24px;
    margin: 32px auto;
      .post-list-nav {
        padding:0 24px 12px;
        display: flex;
        flex-direction: row;
        justify-content: center;
        input {
          width:300px;
          padding:6px 16px;
          font-size: 16px;
          color:#333;
          height: 40px;
          border: 1px solid #ddd;
          border-radius: 10px
        }
        .filter-by-status{
          .btn-common{
            height: 40px;
            padding: 0 16px;
            text-decoration: none;
          }
        }
      }
      .posts-wrapper {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: flex-start;
        // align-items: flex-start;
          .post {
            flex-basis: calc(25% - 24px);
            padding:12px;
            margin:0 12px 16px;
            border:1px solid #eee;
            padding: 24px 12px 12px;
            box-shadow:0 0 12px rgba(0,0,0,0.1);
            color:#000;
            position: relative;
              h2 {
                word-break: break-all;
                font-size: 24px;
                line-height: 24px;
                font-weight: 700;
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
                    word-break: break-all;
                  }
                  .id {
                    color:lightgrey;
                    margin-right: 16px;
                    position: absolute;
                    top:4px;
                    left:4px;
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
