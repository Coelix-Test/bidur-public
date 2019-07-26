<template>
  <form action="#" class="search-form">
    <div class="search-overlay" @click="toggleSearch"></div>
    <div class="search-input-wrap">
      <input type="text" class="search-input" placeholder="שופיח" @click="toggleSearch" @input="renderSearch($event.target.value)" @blur="blur" >
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
  flex-grow: 1;
  padding: 0 20px;
  display: flex;
  justify-content: center;
  .search-input-wrap{
    position: relative;
    max-width: 280px;
    width: 100%;
  }
  input{
    width: 100%;
    height: 35px;
    background: #FFFFFF;
    border: 1px solid #E0E0E0;
    box-sizing: border-box;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.05);
    border-radius: 50px;
    padding: 0 20px 0 32px;
    background: url('/img/icons/search-yellow.svg') no-repeat 14px center;
    background-size: 18px;
    position: relative;
    z-index: 101;

  }
  .results{
    border-radius: 5px;
    background: #fff;
    position: absolute;
    top: calc(100% + 2px);
    width: 100%;
    z-index: 101;
    border: 1px solid #E0E0E0;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    max-height: 170px;
    overflow-y: scroll;
    li{
      padding: 3px 15px;
    }
    a{
      color: $dark;
      text-decoration: none;
    }
  }

  // &.active{
  //   .search-overlay{
  //     position: fixed;
  //     top: 0;
  //     left: 0;
  //     width: 100%;
  //     height: 100%;
  //     z-index: 100;
  //     background: transparent;
  //   }
  // }
}
</style>
