<template >
  <li class="add-new-tag">

    <div class="tag-img-wrapper">
      <!-- <input type="file" accept="image/x-png,image/gif,image/jpeg" /> -->
      <!-- <img :src="data.img" @click="chooseImageFile" /> -->
      <picture-input
        ref="pictureInput"
        @change="onChanged"
        @remove="onRemoved"
        :width="100"
        :removable="true"
        removeButtonClass="ui red button"
        :height="100"
        accept="image/jpeg, image/png, image/gif"
        buttonClass="ui button primary"
        :customStrings="{
        upload: '<h4>Upload it!</h4>',
        drag: 'Drag and drop your image here'}">
      ></picture-input>
    </div>
    <input type="text" v-model="tagName" placeholder="Tag Name">
    <div class="events">
      <a class="add-tag" href="#" @click="addTag($event)">
        v-check
      </a>
    </div>
  </li>
</template>

<script>
// import TagImage from './TagImage.vue';
import PictureInput from 'vue-picture-input';
// import FormDataPost from '/upload';
export default {
  props : {
    data : {

    }
  },
  data() {
    return {
      tagName : null,
      tagImage : null,
    }
  },
  methods : {
    onChanged() {
      console.log('changed');
      if (this.$refs.pictureInput.file) {

         this.tagImage = this.$refs.pictureInput.file;
         console.log(this.tagImage);
       } else {

         console.log("Old browser. No support for Filereader API");
       }
    },
    onRemoved() {
      console.log('removed');
    },
    addTag() {
      if (this.tagImage && this.tagName){

        var data = new FormData();
        data.append('img', this.tagImage);
        data.append('name', this.tagName);
        console.log('data', data);
        axios
          .post('/addHashtag', data, {
            headers : {'Content-Type': 'multipart/form-data'}
          })
          .then((response) => {
            console.log(response);
          })
          .catch((error) => {
            console.log(error);
          });
      }
    }
  },
  components : {
    // TagImage,
    PictureInput
  }
}
</script>

<style lang="css" scoped>

</style>
