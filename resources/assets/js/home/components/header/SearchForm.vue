<template>
  <form action="#" class="search-form">
    <div class="search-overlay"></div>
    <div class="search-input-wrap">
      <input type="text" class="search-input" placeholder="שופיח">
      <ul class="results">
        <li>result post</li>
        <li>result post</li>
        <li>result post</li>
        <li>result post</li>
        <li>result post</li>
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
      results: []
    };
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

    max-height: 170px;
    overflow: scroll;
    li{
      padding: 3px 15px;
    }
    a{
      color: $dark;
      text-decoration: none;
    }
  }
}
.search-overlay{
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 100;
  background: transparent;
}
</style>
