<template>

  <div class="main-wrapper">
    <div class="tags-wrapper">
      <div class="tags-heading">
        <div class="show-per-page">

        </div>
        <div class="sort-by">

        </div>
      </div>
      <ul class="tags-list">
        <li id="add-new-tag" class="single-tag">
          <svg xmlns="http://www.w3.org/2000/svg" width="62" height="62" viewBox="0 0 62 62" fill="none">
            <path d="M2.19181 33.2064C0.97063 33.2064 0 32.2047 0 30.9842C0 29.7637 0.97063 28.7936 2.19181 28.7936H28.7756V2.22217C28.7776 1.00165 29.7798 0 31.001 0C32.2222 0 33.1928 1.00165 33.1928 2.22217V28.7936H59.7766C60.9978 28.7936 62 29.7637 62 30.9842C62 32.2047 60.9978 33.2064 59.7766 33.2064H33.1928V59.7778C33.1928 60.9983 32.2222 62 31.001 62C29.7798 62 28.7776 60.9983 28.7776 59.7778V33.2064H2.19181Z" fill="url(#paint0_linear)"/>
            <defs>
            <linearGradient id="paint0_linear" x1="62" y1="33.0668" x2="-2.56034e-07" y2="33.0668" gradientUnits="userSpaceOnUse">
            <stop stop-color="#FF8383"/>
            <stop offset="1" stop-color="#4200FF"/>
            </linearGradient>
            </defs>
          </svg>
          <h3>Add new tag</h3>
        </li>
        <li v-for="tag in tags" class="single-tag" :data-tag_id="tag.id">
          <div class="tag-img-wrapper">
            <img :src="tag.img">
          </div>
          <input type="text" v-model="tag.name" placeholder="Tag Name">
        </li>

      </ul>
      <div>
        {{info}}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      qwe: 'qweqweqwe',
      tags : {
        0 : {
          name : 'Tag 1',
          img : '/img/abama/4.png',
          id : 0
        },
        1 : {
          name : 'Tag 2',
          img : '/img/abama/2.png',
          id : 1
        },
        2 : {
          name : 'Tag 3',
          img : '/img/abama/3.png',
          id : 2
        },
        3 : {
          name : 'Tag 1',
          img : '/img/abama/4.png',
          id : 3
        },
        4 : {
          name : 'Tag 1',
          img : '/img/abama/4.png',
          id : 4
        },
        5 : {
          name : 'Tag 1',
          img : '/img/abama/4.png',
          id : 5
        },
        6 : {
          name : 'Tag 1',
          img : '/img/abama/4.png',
          id : 6
        },
      },
      info : null

    }
  },
  mounted() {
   axios
     .get('/getAllHashtags')
     .then(response => (this.info = response));
 }


}
</script>

<style lang="css" scoped>
  .main-wrapper {
    max-width: 1440px;
    margin:0 auto;
    padding:32px 24px;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
  }
  .tags-wrapper {
    width:100%;
  }
  .tags-list {
    display: flex;
    flex-direction: row;
    flex-wrap:wrap;
    justify-content: flex-start;
    width:100%;
    padding: 0;
    margin: 0;
  }
  .single-tag {
    flex-basis:calc(16% - 8px);
    list-style-type: none;
    display: flex;
    flex-direction: column;
    align-items: center;
    /* justify-content: flex-start; */
    padding:16px 12px;
    font-size: 20px;
    margin: 0 auto 12px;
    width:200px;
    height:200px;
    box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
    background-color: #fff;
  }
  #add-new-tag.single-tag svg{
    margin-bottom: 16px;
  }
  .single-tag h3 {
    font-size: 18px;
    font-weight: 600;
    color:#333333;
  }
  .single-tag input::placeholder {
    color:#BDBDBD;
    font-weight: 600;
    text-align: center;
  }
  .single-tag input {
    width:100%;
    font-weight: 600;
    text-align: center;
    color: #333333;
  }
  .tag-img-wrapper {
    width:80px;
    height:80px;
    border-radius: 50%;
    overflow: hidden;
    margin-bottom: 16px;
    padding: 2px;
    background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
  }
  .tag-img-wrapper img {
    width:76px;
    height:76px;
    object-fit: cover;
    object-position: center;
    border-radius: 50%;
  }
</style>
