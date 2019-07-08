<template>
  <div class="surveys">
    <h2 class="heading">Surveys</h2>
    <div class="plate shadow-section">
      <div class="types">
        <div class="add-section" @click="select('survey')">
          <img src="/img/icons/edit-post-survey.svg" alt="">
          <span>Survey</span>
        </div>
        <div class="add-section" @click="select('assessment')">
          <img src="/img/icons/edit-post-assessment.svg" alt="">
          <span>Assessment</span>
        </div>
        <div class="add-section" @click="select('selection')">
          <img src="/img/icons/edit-post-selection.svg" alt="">
          <span>Selection</span>
        </div>
      </div>

      <PostSelection
        v-bind.sync="selection"
        :deletable="false"
        v-if="selected == 'selection'"
      />
      <PostSurvey
        v-bind.sync="survey"
        :deletable="false"
        v-else-if="selected == 'survey'"
      />
      <PostAssessment
        v-bind.sync="ass"
        :deletable="false"
        v-else-if="selected == 'assessment'"
      />

      <button @click="save" class="theme-btn-red big-btn">SAVE</button>
    </div>
  </div>
</template>

<script>
import PostSelection from './../posts/PostSelection.vue';
import PostSurvey from './../posts/PostSurvey.vue';
import PostAssessment from './../posts/PostAssessment.vue';

export default {
  data(){
    return {
      selected: 'selection',
      selection: {
        image1: '',
        image2: '',
        title: '',
      },
      survey: {
        title: '',
        answers: [],
        image: '',
      },
      ass: {
        title: '',
        image: '',
      }
    }
  },
  components: {
    PostSelection,
    PostSurvey,
    PostAssessment,
  },
  methods: {
    select(type) {
      this.selected = type;
    },
    save() {
      var data = new FormData();

      if(this.selected == 'selection') {
        data.append('title', this.selection.title);
        data.append('leftImage', this.selection.image1);
        data.append('rightImage', this.selection.image2);
        axios.post('/createNewComparison', data, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        }).then(res => {
          console.log('qweqweqwew');
        });
        axios.post('/showCompareFromMain');
      }
      else if(this.selected == 'assessment') {
        data.append('title', this.ass.title);
        data.append('image', this.ass.image);
        axios.post('/createSinglePhoto', data, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        }).then(res => {
          console.log('qweqweqwew');
        });
        axios.post('/showSinglePhotoFromMain');
      }
      // else if() {
      //
      // }


    }
  }
}
</script>

<style lang="scss" scoped>

@import "~@/vars.scss";

.surveys {
  padding-top: 20px;
  width: 49%;
  display: flex;
  flex-direction: column;
  align-items: stretch;
  padding-bottom: 40px;
  .birthday-section{
    padding-bottom: 35px;
  }
  .text{
    font-size: $fzTitle;
    font-weight: 700;
    width: 80%;
    margin-right: auto;
    margin-left: auto;
    margin-top: 30px;
    margin-bottom: 30px;
  }
  .btn-wrap{
    display: flex;
    justify-content: center;
  }
  .form {
    padding: 50px 70px;
    input {
      width: 100%;
    }
  }
  .types {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: flex-start;
    .add-section{
      background: #F2F2F2;
      font-size: 14px;
      color: #828282;
      text-align: center;
      padding: 8px 25px 2px 25px;
      margin-left: 16px;
      cursor: pointer;
      span{
        display: block;
      }
      img{
        height: 24px;
        width: auto;
      }
      &.add-image-text{
        padding-right: 10px;
        padding-left: 10px;
      }
    }
  }
}
</style>
