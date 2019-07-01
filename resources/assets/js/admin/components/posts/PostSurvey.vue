<template>
  <div class="wrapper">
      <image-input class="image" :value="image" @update:value="updateImage"></image-input>
      <div class="survey-container">

      </div>
  </div>
</template>

<script>
import ImageInput from './../common/ImageInput.vue';

export default {
    data: function(){
        return {};
    },
    components: {
        ImageInput
    },
    props: {
        index: {
            type: Number
        },
        image: {
            type: [String, File],
            default: function(){
                return '';
            }
        },
        title: {
            type: String,
            default: ''
        },
        answers: {
            type: Array,
            default: function(){
                return [];
            }
        }
    },
    methods: {
        updateImage(image){
            this.$emit('update:image', image);
        },
    }
}
</script>

<style lang="scss" scoped>
    .survey-container{
        width: 82%;
        margin-right: auto;
        margin-left: auto;
    }
    .image{
        margin-bottom: 50px;
    }
</style>
