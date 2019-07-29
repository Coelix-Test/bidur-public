<template>
  <div class="wrapper selection-component-container">
      <div class="selection-title">
          <input type="text" placeholder="כותרת" :value="title" @input="$emit('update:title', $event.target.value)" class="title">
      </div>
      <div class="images-row">
          <div class="image-wrap">
            <image-input class="image" :value="image1" @update:value="updateImage1"></image-input>
            <input type="text" class="theme-input-text w-100 image-caption" placeholder="תיאור">
          </div>
          <div class="delimiter"></div>
          <div class="image-wrap">
            <image-input class="image" :value="image2" @update:value="updateImage2"></image-input>
            <input type="text" class="theme-input-text w-100 image-caption" placeholder="תיאור">
          </div>
      </div>
      <div v-if="deletable" class="delete-self delete-btn" @click="$emit('deleteSection', index)"></div>

      <move-section @move="$emit('move', $event)"/>
  </div>
</template>

<script>
import ImageInput from './../common/ImageInput.vue';
import MoveSection from './../common/MoveSection';

export default {
    data: function(){
        return {};
    },
    components: {
        ImageInput,
        MoveSection
    },
    props: {
        deletable: {
          default: true,
          type: Boolean,
        },
        index: {
            type: Number
        },
        image1: {
            type: [String, File],
            default: function(){
                return '';
            }
        },
        image2: {
            type: [String, File],
            default: function(){
                return '';
            }
        },
        title: {
            type: String,
            default: ''
        }
    },
    methods: {
        updateImage1(image){
            this.$emit('update:image1', image);
        },
        updateImage2(image){
            this.$emit('update:image2', image);
        },
        addAnswer(){
            let newAnswers = this.answers;
            newAnswers.push('');
            this.$emit('update:answers', newAnswers);
        },
        editAnswer(index, value){
            let newAnswers = this.answers;
            newAnswers = newAnswers.map((answer, i) => {
                    if(i === index){
                        answer = value;
                    }
                    return answer;
            });
            this.$emit('update:answers', newAnswers);
        },
        deleteAnswer(index){
            let newAnswers = this.answers;
            console.log(index);
            newAnswers = newAnswers.filter((answer,i) => i !== index);
            this.$emit('update:answers', newAnswers);
        }

    }
}
</script>

<style lang="scss" scoped>
    @import "~@/vars.scss";
    .selection-component-container{
        padding: 29px 20px 100px;
        position: relative;
        .image::v-deep{
            .upload-btn{
                width: 85%;
                height: 55px;
            }
        }
    }
    .image-caption{
      margin-top: 15px;
      height: 35px;
      font-style: italic;
      font-size: 16px;
    }
    .selection-title{
        width: 82%;
        margin-right: auto;
        margin-left: auto;

    }
    .title{
        width: 100%;
        padding: 4px 8px;
        color: $black;
        font-size: 34px;
        font-weight: 700;
        border: 1px solid $light-gray;
        border-radius: 3px;

        text-align: center;
    }
    .images-row{
        display: -webkit-flex;
        display: -ms-flex;
        display: flex;
        margin-top: 45px;
        &>.delimiter{
            flex-grow: 1;
            background: url('/img/icons/lighting-yellow.svg') no-repeat center;
            -webkit-background-size: 26px 46px;
            background-size: 26px 46px;
        }
        &>.image-wrap{
            width: 43%;
            flex-shrink: 0;
        }
    }
    .delete-btn{
        position: absolute;
        width: 30px;
        height: 30px;
        background: url('/img/icons/trash.svg') no-repeat center;
        -webkit-background-size: 20px 26px;
        background-size: 20px 26px;
        cursor: pointer;
    }
    .delete-self{
        bottom: 25px;
        left: 25px;
    }
</style>
