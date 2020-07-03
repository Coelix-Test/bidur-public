<template>
  <div :class="{ mobile, first }" class="main-survey">
    <div>
      <a target="_blank" href="https://beachingbody.com/shop/">
        <img src="img/banners/adbanner.jpeg">
      </a>
    </div>
    <template v-if="survey.type == 'survey'">
      <div ref="poll" class="selected-poll">
        <img :src="survey.image">
        <div class="img-caption">{{survey.description}}</div>
        <vue-poll
          class="poll"
          v-bind="survey.value"
          @addvote="addVote($event, survey.id)"
        />
      </div>
    </template>

    <one-survey
      :data="survey.value"
      v-else-if="survey.type == 'comparablePhotos'"
    />
    <like-survey
      :data="survey.value"
      v-else-if="survey.type == 'likableImage'"
    />
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
    first: {
      default: false,
      type: Boolean,
    },
  },
  methods: {
    addVote(obj, id){
      makeItRain(70, this.$refs.poll);
      axios.post('/api/addSurveyVote',{ surveyId : id, answer : obj.value })
    },
  },
  components: {
    VuePoll,
    LikeSurvey,
    OneSurvey,
  },
  computed: {
    survey() {
      if(this.mobile) {
        return this.$store.getters['main-page/surveyMobile'];
      } else {
        return this.$store.getters['main-page/surveyDesktop'];
      }
    }
  }
}
</script>

<style lang="scss" scoped>

::v-deep {
  .vue-poll {
    .votes {
      display: none;
    }
  }
}

.selected-poll{
  .img-caption{
    text-align: center;
    padding-top: 5px;
    color: #fff;
    font-style: italic;
    font-weight: 400;
    font-size: 14px;
    line-height: 17px;
    background: linear-gradient(270deg, #E4A913 0%, #EED074 99.53%);
  }
}
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