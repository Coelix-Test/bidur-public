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
            <input type="file" accept="image/x-png,image/gif,image/jpeg" />
            <img :src="tag.img" @click="chooseImageFile" />
          </div>
          <input type="text" v-model="tag.name" placeholder="Tag Name">
          <div class="events">
            <a class="delete-tag" href="#" @click="deleteTag">
              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="19" viewBox="0 0 14 19" fill="none">
                <path d="M1.61637 17.5821C1.63722 18.0801 2.04694 18.473 2.54521 18.473H11.2241C11.7224 18.473 12.1321 18.0801 12.1529 17.5821L12.7727 4.49829H0.996582L1.61637 17.5821ZM8.84791 7.74809C8.84791 7.53961 9.01696 7.37052 9.22552 7.37052H9.82948C10.0379 7.37052 10.2071 7.53957 10.2071 7.74809V15.2232C10.2071 15.4317 10.0381 15.6008 9.82948 15.6008H9.22552C9.01705 15.6008 8.84791 15.4318 8.84791 15.2232V7.74809ZM6.2051 7.74809C6.2051 7.53961 6.37414 7.37052 6.58267 7.37052H7.18663C7.39506 7.37052 7.5642 7.53957 7.5642 7.74809V15.2232C7.5642 15.4317 7.3952 15.6008 7.18663 15.6008H6.58267C6.37419 15.6008 6.2051 15.4318 6.2051 15.2232V7.74809ZM3.5622 7.74809C3.5622 7.53961 3.73124 7.37052 3.93977 7.37052H4.54377C4.75225 7.37052 4.92134 7.53957 4.92134 7.74809V15.2232C4.92134 15.4317 4.7523 15.6008 4.54377 15.6008H3.93977C3.73129 15.6008 3.5622 15.4318 3.5622 15.2232V7.74809Z" fill="#828282"/>
                <path d="M13.1849 0.951636H9.18108V0.194687C9.18108 0.0871907 9.09393 0 8.98639 0H4.78192C4.67443 0 4.58728 0.0871907 4.58728 0.194687V0.951591H0.583382C0.261165 0.951591 0 1.2128 0 1.53502V3.36779H13.7683V1.53506C13.7683 1.21285 13.5071 0.951636 13.1849 0.951636Z" fill="#828282"/>
              </svg>
            </a>
          </div>
        </li>

      </ul>

    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      qwe: 'qweqweqwe',
      tags : null

    }
  },
  mounted() {
   axios
     .post('/getAllHashtags')
     .then(response => (this.tags = response.data));
 },
 methods : {
   chooseImageFile : function (e) {
     e.target.parentNode.childNodes[0].click();
   },
   deleteTag : function (e) {
     e.preventDefault();
     console.log(e.target.parentNode.parentNode.getAttribute('data-tag_id'));
     let tagToDeleteId = e.target.parentNode.parentNode.getAttribute('data-tag_id');
     
   }

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
    justify-content: center;
    width:100%;
    padding: 0;
    margin: 0;
  }
  .single-tag {
    list-style-type: none;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding:16px 12px;
    font-size: 20px;
    margin: 0 8px 12px auto;
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
  }
  .single-tag input:focus {
    border:1px solid #E0E0E0;
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
  }
  .tag-img-wrapper img {
    width:76px;
    height:76px;
    object-fit: cover;
    object-position: center;
    border-radius: 50%;
  }
  .tag-img-wrapper input[type="file"] {
    display: none;
  }
  .delete-tag svg {
    pointer-events: none;
  }
</style>
