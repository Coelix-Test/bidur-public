<template >
  <li class="add-new-tag single-tag">

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
        drag: 'להעלות'}">
      ></picture-input>
    </div>
    <input type="text" v-model="tagName" placeholder="תג שם">
    <div class="events">
      <a class="add-tag" href="#" @click="addTag($event)">
        לשמור
      </a>
    </div>
  </li>
</template>

<script>
import PictureInput from 'vue-picture-input';
export default {
  props : {
    data : {

    }
  },
  data() {
    return {
      tagName : null,
      tagImage : null,
      tagImageUrl : null
    }
  },
  methods : {
    onChanged() {
      console.log('changed');
      if (this.$refs.pictureInput.file) {

         this.tagImage = this.$refs.pictureInput.file;

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
        data.append('image', this.tagImage);
        data.append('text', this.tagName);

        axios
          .post('/addHashtag', data, {
            headers : {'Content-Type': 'multipart/form-data'}
          })
          .then((response) => {
            console.log(response);
            this.$emit('addedNewTag', response.data)
          })
          .catch((error) => {
            console.log(error);
          });
      }
    }
  },
  components : {
    PictureInput
  }
}
</script>

<style lang="css" scoped>
  a {
    color: #333;
  }
</style>
