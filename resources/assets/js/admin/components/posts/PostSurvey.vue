<template>
  <div class="wrapper survey-component-container">
      <image-input class="image" :value="image" @update:value="updateImage"></image-input>
      <div class="survey-container">
        <input type="text" class="theme-input-text w-100 image-caption" placeholder="תיאור"
          :value="description"
          @input="$emit('update:description', $event.target.value)">
        <input type="text" placeholder="כותרת" :value="title" @input="$emit('update:title', $event.target.value)" class="survey-title">
        <div class="answers-list">
            <div v-for="(answer, index) in answers" class="answer-item">
                <input type="text" class="answer-title" :value="answer"  @input="editAnswer(index, $event.target.value)" placeholder="תשובה">
                <div class="delete-answer delete-btn" @click="deleteAnswer(index)"></div>
            </div>
            <div class="add-new-answer" @click="addAnswer">
                הוסף תשובה
            </div>
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
    .survey-component-container{
        padding-bottom: 100px;
        position: relative;
    }
    .survey-container{
        width: 82%;
        margin-right: auto;
        margin-left: auto;

    }
    .image-caption{
      margin-bottom: 15px;
      height: 35px;
      font-style: italic;
      font-size: 16px;
      text-indent: 5px;
    }
    .image{
        margin-bottom: 20px;
    }
    .survey-title{
        width: 100%;
        padding: 4px 10px;
        color: $black;
        font-size: 34px;
        font-weight: 700;
        border: 1px solid $light-gray;
        border-radius: 3px;
    }
    .answers-list{
        margin-top: 20px;
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
    .answer-item{
        display: -webkit-flex;
        display: -ms-flex;
        display: flex;
        position: relative;
        width: 85%;
        height: 58px;
        overflow: hidden;
        padding-left: 50px;
        margin: 20px 0;
        border-bottom-left-radius: 50px;
        border-top-left-radius: 50px;
        box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.15);
        background: #FFFFFF;
        input{
            height: 100%;
            flex-grow: 1;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border: none;
        }
        .delete-answer{
            left: 20px;
            top: 14px;
        }
        &:before{
            content: '';
            display: inline-block;
            width: 14px;
            margin-left: 20px;
            height: 100%;

        }
        &:nth-child(3n+1):before{
            background: url('/img/icons/answer-gradient-1.svg');
        }
        &:nth-child(3n+2):before{
            background: url('/img/icons/answer-gradient-2.svg');
        }
        &:nth-child(3n+3):before{
            background: url('/img/icons/answer-gradient-3.svg');
        }
    }
    .add-new-answer{
        display: -webkit-flex;
        display: -ms-flex;
        display: flex;
        -ms-align-items: center;
        align-items: center;
        cursor: pointer;
        margin-top: 30px;
        &:before{
            content: '';
            display: inline-block;
            width: 38px;
            height: 38px;
            background: url('/img/icons/plus-in-red-circle.svg') no-repeat center;
            -webkit-background-size: cover;
            background-size: cover;
            margin-left: 12px;
        }
    }
    .delete-self{
        bottom: 25px;
        left: 25px;
    }
</style>
