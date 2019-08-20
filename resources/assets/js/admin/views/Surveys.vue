<template>
  <div class="surveys">
    <!-- <div class="search">
      <input type="text" @input="renderSearch" v-model="searchQuery" placeholder="start type your survey name">
    </div> -->
    <div class="surveys-wrapper">
      <single-survey v-if="surveys" v-for="survey in surveys" :data="survey" :key="survey.id"  />
      <div v-if="surveys == null">
        שום דבר לא נמצא!
      </div>
    </div>

  </div>
</template>

<script>
import SingleSurvey from './../components/SingleSurvey.vue';

export default {
  data() {
    return {
      surveys : null,
      searchQuery : null,
    }
  },
  created() {
    axios
      .post('/api/getAllSurveys',{ title : 0 })
        .then(res => {
          this.surveys = res.data;
        })
  },
  methods : {
    renderSearch() {
      axios
        .post('/api/getAllSurveys', { title : this.searchQuery })
          .then(res => {
            if(res.data.success != false) {
              this.surveys = res.data;
            }else {
              this.surveys = null;
            }

          })
          .catch(error => this.surveys = null);
    }
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
    .search {
      padding:0 24px 16px;
      display: flex;
      flex-direction: row;
      justify-content: center;
      input {
        width:300px;
        padding:6px 16px;
        font-size: 16px;
        color:#333;
      }
    }
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
