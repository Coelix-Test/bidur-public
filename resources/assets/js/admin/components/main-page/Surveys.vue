<template>
  <div class="surveys">
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
    <PostSelection :deletable="false" v-if="selected == 'selection'"/>
    <PostSurvey :deletable="false" v-else-if="selected == 'assessment'"/>
    <PostAssessment :deletable="false" v-else-if="selected == 'survey'"/>
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
      survey: {},
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
      data.append('imageUrl', this.image);
      data.append('linkToInsta', this.link);

      axios.post('/createInsta', data, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }).then(res => {
        console.log(res);
      });
    }
  }
}
</script>

<style lang="scss" scoped>

@import "~@/vars.scss";

.surveys {
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
