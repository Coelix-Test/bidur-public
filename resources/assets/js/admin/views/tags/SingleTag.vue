<template>
  <li class="single-tag" :data-tag_id="data.id">

    <div class="tag-img-wrapper">
      <picture-input
        ref="pictureInput"
        @change="onChanged($event)"
        @remove="onRemoved"
        :width="100"
        :removable="true"
        removeButtonClass="ui red button"
        :height="100"
        :class="{ changed }"
        accept="image/jpeg, image/png, image/gif"
        buttonClass="ui button primary"
        :customStrings="{
        upload: '<h4>Upload it!</h4>',
        drag: 'להעלות'}">
      ></picture-input>
      <img :src="data.img" @click="chooseImageFile" />
    </div>
    <input type="text" v-model="data.name" @input="nameChanging" placeholder="Tag Name">
    <div class="events">
      <a class="delete-tag" href="#" @click="deleteTag(data.id, $event)">
        <input type="hidden" name="tag_id" :value="data.id">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="19" viewBox="0 0 14 19" fill="none">
          <path d="M1.61637 17.5821C1.63722 18.0801 2.04694 18.473 2.54521 18.473H11.2241C11.7224 18.473 12.1321 18.0801 12.1529 17.5821L12.7727 4.49829H0.996582L1.61637 17.5821ZM8.84791 7.74809C8.84791 7.53961 9.01696 7.37052 9.22552 7.37052H9.82948C10.0379 7.37052 10.2071 7.53957 10.2071 7.74809V15.2232C10.2071 15.4317 10.0381 15.6008 9.82948 15.6008H9.22552C9.01705 15.6008 8.84791 15.4318 8.84791 15.2232V7.74809ZM6.2051 7.74809C6.2051 7.53961 6.37414 7.37052 6.58267 7.37052H7.18663C7.39506 7.37052 7.5642 7.53957 7.5642 7.74809V15.2232C7.5642 15.4317 7.3952 15.6008 7.18663 15.6008H6.58267C6.37419 15.6008 6.2051 15.4318 6.2051 15.2232V7.74809ZM3.5622 7.74809C3.5622 7.53961 3.73124 7.37052 3.93977 7.37052H4.54377C4.75225 7.37052 4.92134 7.53957 4.92134 7.74809V15.2232C4.92134 15.4317 4.7523 15.6008 4.54377 15.6008H3.93977C3.73129 15.6008 3.5622 15.4318 3.5622 15.2232V7.74809Z" fill="#828282"/>
          <path d="M13.1849 0.951636H9.18108V0.194687C9.18108 0.0871907 9.09393 0 8.98639 0H4.78192C4.67443 0 4.58728 0.0871907 4.58728 0.194687V0.951591H0.583382C0.261165 0.951591 0 1.2128 0 1.53502V3.36779H13.7683V1.53506C13.7683 1.21285 13.5071 0.951636 13.1849 0.951636Z" fill="#828282"/>
        </svg>
      </a>
      <a class="edit-tag" href="#" @click="editTag(data.id, $event)">לשמור</a>
    </div>
  </li>
</template>

<script>
import PictureInput from 'vue-picture-input';
export default {
  props: {
    data: {
      requred: true,
    }
  },
  data() {
    return{
      tagName : this.data.name,
      tagImage : null,
      tagImageUrl : null,
      changed : false
    }

  },
  methods : {
    nameChanging() {
      this.tagName = this.data.name;
    },
    onChanged(e) {
      this.changed = true;
      if (this.$refs.pictureInput.file) {

         this.tagImage = this.$refs.pictureInput.file;

       } else {

         console.log("Old browser. No support for Filereader API");
       }
    },
    onRemoved() {
    },
    chooseImageFile : function (e) {

    },
    deleteTag : function (id,e) {
      e.preventDefault();
      axios
        .post('/api/deleteHashtag',{
          id: id,
        })
         .then((response) => {
           this.$emit('delete', response.data)
         })
         .catch((error) => {
           console.log(error);
         });
    },
    editTag(id,e) {
      e.preventDefault();

      var sendData = new FormData();
      sendData.append('id', id);
      sendData.append('image', this.tagImage);
      sendData.append('text', this.tagName);

      axios
        .post('/api/updateHashtag',sendData,{
          headers : {'Content-Type': 'multipart/form-data'}
        })
        .then((response) => {
          this.$emit('editTag', response.data)
        })
        .catch((error) => {
          console.log(error);
        });
    }


  },
  components : {
    PictureInput
  }
}
</script>

<style lang="css" scoped>
  a {
    color:#333;
  }
</style>
