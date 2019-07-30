<template>
  <div class="wrapper survey-component-container">
      <image-input class="image" :value="image" @update:value="updateImage"></image-input>
      <div class="assessment-title">
        <input type="text" class="theme-input-text w-100 image-caption" placeholder="תיאור"
          :value="description"
          @input="$emit('update:description', $event.target.value)">
        <input type="text" placeholder="כותרת" :value="title" @input="$emit('update:title', $event.target.value)" class="title">
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
        MoveSection,
    },
    props: {
        deletable: {
          default: true,
          type: Boolean,
        },
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
        description: {
            type: String,
            default: ''
        },
    },
    methods: {
        updateImage(image){
            this.$emit('update:image', image);
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
            // console.log(index);
            newAnswers = newAnswers.filter((answer,i) => i !== index);
            this.$emit('update:answers', newAnswers);
        }

    }
}
</script>

<style lang="scss" scoped>
    @import "~@/vars.scss";
    .survey-component-container{
        padding-bottom: 100px;
        position: relative;
    }
    .assessment-title{
        width: 82%;
        margin-right: auto;
        margin-left: auto;

    }
    .image-caption{
      margin-bottom: 15px;
      height: 35px;
      font-style: italic;
      font-size: 16px;
    }
    .image{
        margin-bottom: 16px;
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
