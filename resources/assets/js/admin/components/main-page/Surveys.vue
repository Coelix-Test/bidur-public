<template>
  <div class="surveys">
    <h2 class="heading">{{ this.mobile ? 'Mobile' : '' }} Surveys</h2>
    <div class="plate shadow-section">

      <div class="types">
        <div class="add-section" @click="select('survey')">
          <img src="/img/icons/edit-post-survey.svg" alt="">
          <span>Survey</span>
        </div>
        <div class="add-section" @click="select('likableImage')">
          <img src="/img/icons/edit-post-assessment.svg" alt="">
          <span>הערכה</span>
        </div>
        <div class="add-section" @click="select('comparablePhotos')">
          <img src="/img/icons/edit-post-selection.svg" alt="">
          <span>פרסם</span>
        </div>
      </div>

      <PostSelection
        v-bind.sync="selection"
        :deletable="false"
        v-if="selected == 'comparablePhotos'"
        :moveble="false"
      />
      <PostSurvey
        v-bind.sync="survey"
        :deletable="false"
        v-else-if="selected == 'survey'"
        :moveble="false"
      />
      <PostAssessment
        v-bind.sync="ass"
        :deletable="false"
        v-else-if="selected == 'likableImage'"
        :moveble="false"
      />

      <button @click="save" class="theme-btn-red big-btn">פרסם</button>
    </div>
  </div>
</template>

<script>
import PostSelection from './../posts/PostSelection.vue';
import PostSurvey from './../posts/PostSurvey.vue';
import PostAssessment from './../posts/PostAssessment.vue';

export default {
  props: {
    mobile: {
      type: Boolean,
      default: false,
    }
  },
  data(){
    return {
      selected: 'comparablePhotos',
      selection: {
        image1: '',
        image2: '',
        leftDescription: '',
        rightDescription: '',
        title: '',
        type: '',
      },
      survey: {
        title: '',
        answers: [],
        image: '',
        description: '',
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
    onReceive(res) {
      this.selected = res.data.type;
      if(res.data.type == 'comparablePhotos') {
        this.selection.title = res.data.value.description;
        this.selection.image1 = res.data.value.imageLeft;
        this.selection.image2 = res.data.value.imageRight;
        this.selection.leftDescription = res.data.value.descriptionLeft;
        this.selection.rightDescription = res.data.value.descriptionRight;
        this.selection.image2 = res.data.value.imageRight;
        this.selection.type = res.data.value.type;
      }
      else if(res.data.type == 'likableImage') {
        this.ass.title = res.data.value.description;
        this.ass.image = res.data.value.imgUrl;
      }
      else if(res.data.type == 'survey') {
        this.survey.title = res.data.value.question;
        this.survey.description = res.data.description;
        this.survey.image = res.data.image;
        this.survey.answers = res.data.value.answers.map(n => {
          return n.text;
        });
        // console.log(this.survey.image);
      }
    },
    select(type) {
      this.selected = type;
    },
    save() {
      var data = new FormData();

      if(this.selected == 'comparablePhotos') {
        data.append('title', this.selection.title);
        data.append('leftImage', this.selection.image1);
        data.append('descriptionLeft', this.selection.leftDescription);
        data.append('descriptionRight', this.selection.rightDescription);
        data.append('rightImage', this.selection.image2);
        data.append('type', this.selection.type);
        axios.post(this.mobile ? '/api/addNewComparisonSecond' : '/api/createNewComparison', data, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        }).then(res => {
          alert('נשמר!');
        });
        // axios.post('/api/showCompareFromMain');
      }
      else if(this.selected == 'likableImage') {
        data.append('title', this.ass.title);
        data.append('image', this.ass.image);
        axios.post(this.mobile ? '/api/addSinglePhotoSecond' : '/api/createSinglePhoto', data, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        }).then(res => {
          alert('נשמר!');
        });
        // axios.post('/api/showSinglePhotoFromMain');
      }
      else if(this.selected == 'survey') {
        data.append('title', this.survey.title);
        data.append('image', this.survey.image);
        data.append('description', this.survey.description);
        data.append('answers', JSON.stringify(this.survey.answers));
        axios.post(this.mobile ? '/api/addNewSurveyToMainSecond' : '/api/addNewSurveyToMain', data, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        }).then(res => {
          alert('נשמר!');
        });
      }
    }
  },
  created() {
    if(!this.mobile) {
      axios.post('/api/getServiceForMainPage').then(this.onReceive);
    } else {
      axios.post('/api/getServiceForMainPageSecond').then(this.onReceive)
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
  .plate {
    display: flex;
    flex-direction: column;
    align-items: stretch;
    padding-bottom: 40px;
  }
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
    justify-content: center;
    padding: 10px;
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
  .big-btn {
    align-self: center;
  }
}
</style>
