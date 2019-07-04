<template>
  <div class="wrapper survey-component-container">
      <image-input class="image" :value="image" @update:value="updateImage"></image-input>
      <div class="assessment-title">
          <input type="text" placeholder="Assessment title" :value="title" @input="$emit('update:title', $event.target.value)" class="title">
      </div>
      <div class="delete-self delete-btn" @click="$emit('deleteSection', index)"></div>
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
        box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
        padding-bottom: 100px;
        position: relative;
    }
    .assessment-title{
        width: 82%;
        margin-right: auto;
        margin-left: auto;

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
