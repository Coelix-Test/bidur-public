<template>
  <div class="wrapper">
    <DropZone @input="onFileChange($event[0])">
      <label class="empty" v-if="value === ''">
          <img src="/img/icons/edit-post-upload-image.svg" alt="">
          <div class="theme-btn theme-btn-red upload-btn">העלאת תמונה</div>
          <input type="file" accept="image/*" @change="onFileChange($event.target.files[0])">
      </label>
      <label v-else>
        <input type="file" accept="image/*" @change="onFileChange($event.target.files[0])">
        <div class="text-on-image">לחץ כדי לשנות את התמונה</div>
        <img v-if="typeof value === 'string'" :src="value" class="image" alt="">
        <img v-else :src="image" class="image" alt="">
      </label>
    </DropZone>
  </div>
</template>

<script>
import DropZone from './DropZone';

export default {
  data: function(){
    return {
      image: '',
    }
  },
  props: {
    value : {
      type: [ String, File ],
      default: function(){
        return null;
      }
    }
  },
  methods: {
    onDrag(data, e) {
      console.log(data, e);
    },
    onFileChange(file){
      this.fileToBase64(file);
      this.$emit('update:value', file);

    },
    fileToBase64(file){
      let reader = new FileReader();
      reader.addEventListener('load', () => {
        this.image = reader.result;
      }, false);
      reader.readAsDataURL(file);
    }
  },
  created(){
    if(typeof this.value !== 'string'){
      this.fileToBase64(this.value);
    }
  },
  components: {
    DropZone,
  }
}
</script>

<style lang="scss" scoped>
@import "~@/vars.scss";

.wrapper{
  position: relative;
  input[type="file"]{
    display: none;
  }
  label{
    margin-bottom: 0;
    width: 100%;
    cursor: pointer;
    overflow: hidden;
  }
  label.empty{
    height: 400px;
    background-color: #E0E0E0;
    display: -webkit-flex;
    display: -ms-flex;
    display: flex;
    justify-content: center;
    -ms-align-items: center;
    align-items: center;
    text-align: center;
    -webkit-flex-direction: column;
    -ms-flex-direction: column;
    flex-direction: column;
  }
  .upload-btn{
    width: 360px;
    height: 79px;
    border-radius: 10px;
    justify-content: center;
    font-size: 24px;
    font-weight: 600;
    margin-top: 20px;
    cursor: pointer;
  }
  .image{
    width: 100%;
    height: auto;
  }
  .text-on-image{
    position: absolute;
    display: -webkit-flex;
    display: -ms-flex;
    display: flex;
    -ms-align-items: center;
    align-items: center;
    justify-content: center;
    text-align: center;
    background: rgba(0,0,0,.3);
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    color: #fff;
    font-size: 18px;
    font-weight: 700;
  }
}
</style>
