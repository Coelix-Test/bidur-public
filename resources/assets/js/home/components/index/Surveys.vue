<template>
  <div v-if="survey">
    <template v-if="survey.type == 'survey'">
      <div class="selected-poll">
        <img src="img/rihanna.png" alt="">
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
    }
  },
  data() {
    return {
      survey: {}
    };
  },
  methods: {
    onReceive(res) {
      if(res.data.value.answerVariants) {
        res.data.value.answers = Object.values(res.data.value.answerVariants);
      }

      console.log(res.data.value.answers);

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

<style lang="css" scoped>
</style>
