<template>
  <div class="surveys">
    <div class="surveys-wrapper">
      <single-survey v-if="surveys" v-for="survey in surveys" :data="survey" :key="survey.id"  />
    </div>

  </div>
</template>

<script>
import SingleSurvey from './../components/SingleSurvey.vue';

export default {
  data() {
    return {
      surveys : null,

    }
  },
  created() {
    axios
      .post('/getAllSurveys')
        .then(res => {
          this.surveys = res.data;
        })
  },
  components : {
    SingleSurvey
  }
}
</script>

<style lang="scss" scoped>
  .surveys {
    max-width:1440px;
    padding:0 24px;
    margin: 32px auto;
    .surveys-wrapper {
      display: flex;
      flex-direction: row;
      flex-wrap:wrap;
        .single-survey {
          flex-basis:calc(25% - 24px);
          padding:12px;
          margin: 0 12px 16px;
        }
    }
  }
</style>
