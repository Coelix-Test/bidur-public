<template>
  <div v-if="survey" :class="{ mobile: this.mobile, is_first }" class="main-survey">
    <template v-if="survey.type == 'survey'">
      <div ref="poll" class="selected-poll">
        <img :src="survey.image" alt="">
        <vue-poll class="poll" v-bind="survey.value" @addvote="addVote($event, survey.id)"/>
      </div>
    </template>

    <one-survey :data="survey.value" v-else-if="survey.type == 'comparablePhotos'"/>
    <like-survey :data="survey.value" v-else-if="survey.type == 'likableImage'"/>
  </div>
</template>

<script>
import VuePoll from 'vue-poll'
import LikeSurvey from './../common/LikeSurvey'
import OneSurvey from './../common/OneSurvey'

export default {
  props: {
    mobile: {
      default: false,
      type: Boolean,

    },
    is_first: {
      default: false,
      type: Boolean,

    },
  },
  data() {
    return {
      survey: {},
    };
  },
  methods: {
    addVote(obj, id){
      makeItRain(70, this.$refs.poll);
      axios
        .post('/addSurveyVote',{ surveyId : id, answer : obj.value })
          .then(response => {
            // console.log(response);
          });
    },
    onReceive(res) {

      this.survey = res.data;
    },
    sync() {
      if(this.mobile) {
        axios.post('/getServiceForMainPageSecond').then(this.onReceive);
      } else {
        axios.post('/getServiceForMainPage').then(this.onReceive);
      }
    }
  },
  components: {
    VuePoll,
    LikeSurvey,
    OneSurvey,
  },
  created() {
    this.sync()
  }
}
</script>

<style lang="scss" scoped>
.main-survey.is_first {
  border: 4px solid;
  border-image: radial-gradient(circle at 33% 100%, #FED373 4%, #F15245 30%, #D92E7F 62%, #9B36B7 85%, #515ECF);
  border-image-slice: 1;
  &::v-deep {
    > div {
      border-width: 0;
    }
  }
}
.selected-poll {
  position: relative;
  border:4px solid #F2C94C;

  img {
    width:100%;
    object-fit: cover;
  }
}
.mobile {
  display: none;

  img {
    width: 100%;
  }

  @media (max-width: 992px) {
    display: block;
  }
}
@media(max-width:768px) {

}



</style>
