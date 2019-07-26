<template>
  <form action="#" class="search-form" :class="{ 'active' : focused }">
    <div class="search-toggle-bnt" @click="toggleSearch"></div>
    <div class="search-input-wrap" v-show="focused">
      <input type="text" class="search-input" placeholder="חיפוש" @click="toggleSearch" @input="renderSearch($event.target.value)" @blur="blur" >
      <ul class="results" v-show="results && focused">
        <li @click="closeSearch" v-for="post in results">
          <router-link  :to="'/post/'+post.post.id">{{ post.post.metaTitle }}</router-link>
        </li>
      </ul>
    </div>
  </form>
</template>

<script>
export default {
  data(){
    return {
      focused: false,
      query: '',
      results: false,
    };
  },
  methods: {
    toggleSearch(){
      this.focused = !this.focused;
    },
    closeSearch() {
      this.focused = false;
      this.query = '';
    },
    blur(){
      setTimeout(() => {
        this.focused = false;
      },100);
    },
    renderSearch(value){
      this.query = value;
      if(this.query && this.query.length > 2){
        axios
          .post('/postTitleSerach', {title : this.query})
          .then(res => {
            if(res.data.success != false) {
              this.results = res.data;
            }else {
              this.results = false;
            }
          })
          .catch(error => this.results = []);
      }
    }
  }
}
</script>

<style lang="scss" scoped>
@import "~@/vars.scss";
.search-form{
  .search-toggle-bnt{
    width: 20px;
    height: 20px;
    background: url('/img/icons/search-yellow.svg') no-repeat center;
    background-size: 19px;
    margin-right: 10px;
  }
  .search-input-wrap{
    //display: none;
    overflow: hidden;
    position: absolute;
    top: 15px;
    right: 85px;
    left: 105px;
    height: 20px;
    input{
      display: block;
      width: 100%;
      height: 100%;
      font-size: 14px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.05);
      border: 1px solid #E0E0E0;
      border-radius: 50px;
      background: #fff;
      padding: 0 15px;
    }
  }
  &.active{
    .search-toggle-bnt{
      background: url('/img/icons/close-black.svg') no-repeat center;
      background-size: 17px;
    }
  }
}
</style>
