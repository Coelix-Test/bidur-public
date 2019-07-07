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
        <li id="add-new-tag" class="single-tag" @click="addNewTag($event)">
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
        <AddNewTag @addedNewTag="addedNewTag"  v-if="showAddNewTag" />



        <SingleTag v-for="tag in tags" @delete="deleteHashtag" @editTag="updateTag" :data="tag" :key="tag.id"/>
      </ul>

    </div>
  </div>

</template>

<script>
import SingleTag from './tags/SingleTag.vue';
import AddNewTag from './tags/AddNewTag.vue';
import TagImage from './tags/TagImage.vue';
export default {
  data() {
    return {
      showAddNewTag : false,
      tags : null

    }
  },
  mounted() {
   axios
     .post('/getAllHashtags')
     .then(response => (this.tags = response.data));
 },
 methods : {
   deleteHashtag(data) {
     console.log('data', data);
     this.tags = data;
   },
   addNewTag : function(e) {
      e.preventDefault();
      this.showAddNewTag = true;
      console.log('addNew');
   },
   addedNewTag(data) {
     this.tags = data;
     this.showAddNewTag = false;
   },
   updateTag(data) {
     this.tags = data;
     this.showAddNewTag = false;
     alert('tag saved!');
   }


 },
 components : {
   SingleTag,
   AddNewTag,
   TagImage
 }


}
</script>

<style lang="css">
  .tags-list >>> .picture-input {
    opacity: 0;
    /* z-index:-1; */
    position: absolute;
  }
  .tags-list >>> .picture-input.changed {
    opacity: 1;
  }
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
  #add-new-tag {
    cursor:pointer;
  }
  .single-tag {
    flex-basis: calc(20% - 16px);
    list-style-type: none;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding:16px 12px;
    font-size: 20px;
    margin: 0 8px 12px 8px;
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
    border-color:transparent;
    outline: none;
    border-width: 1px;
  }
  .single-tag input:focus {
    border:1px solid #ccc;
  }
  .tag-img-wrapper {
    width:80px;
    height:80px;
    border-radius: 50%;
    overflow: hidden;
    margin-bottom: 16px;
    padding: 2px;
    cursor:pointer;
    background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
    position: relative;
  }
  .tag-img-wrapper img {
    width:76px;
    height:76px;
    object-fit: cover;
    object-position: center;
    border-radius: 50%;
    z-index:5;
    position: absolute;
    top:1px;
  }
  .tag-img-wrapper input[type="file"] {
    display: none;
  }
  .delete-tag svg {
    pointer-events: none;
  }
  .picture-inner {
    border-width:0!important;
  }
</style>
