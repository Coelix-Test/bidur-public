<template>
  <div v-if="survey" class="single-survey">

    <div class="heading">
      <div class="date">{{ survey.survey.created_at }}</div>
      <div class="actions">
        <!-- <button @click="deleteSurvey">D</button> -->
        <button @click="updateSurvey">Save</button>
      </div>
    </div>
    <div class="content">
      <img class="thumbnail" :src="survey.survey.image">
      <div class="column">
        <textarea class="title" type="text" v-model="survey.survey.question"></textarea>
        <div class="variant" v-if="variants" v-for="variant in variants" :key="variant.id">
          <!-- {{variant}} -->
          <input type="text" :name="variant.id" v-model="variant.variant">
          <span>Votes : {{variant.votes}}</span>
          <!-- {{variant.variant}} -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    data: {
      requred: true,
    }
  },
  data() {
    return {
      survey : this.data,
      surveyId : this.data.survey.id,
      variants : this.data.variants
    }
  },
  methods : {
    deleteSurvey() {
      // console.log(this.surveyId);
      // axios
      //   .post('/')
      //     .then(res => {
      //       console.log(res);
      //     });
    },
    updateSurvey() {
      console.log(this.survey);
      axios
        .post('/editSurvey',{survey : this.survey})
          .then(res => {
            console.log(res);
          });
    }
  },
}
</script>

<style lang="scss" scoped>
  .single-survey {
    background: #FFFFFF;
    box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
    .heading {
      font-weight: 400;
      color:#000;
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      border-bottom: 1px solid #eee;
      font-size:18px;
      margin-bottom: 8px;
      padding:4px 0;
        .actions {
          button {
            padding: 0;
            border-width:0;
            background-color:transparent;
            &:hover {
              color:#EB5757;
            }
          }
        }
    }
    .content {
      margin-left: -12px;
      margin-right: -12px;
      .thumbnail {
        width:100%;
        object-fit: cover;
      }
      .column {
        padding: 8px 12px 0;
          .title {
            border-color: transparent;
            border-style: solid;
            font-size: 24px;
            color: #333;
            width: 100%;
            font-weight: 700;
              &:hover, &:focus {
                border-color: #eee;
              }
          }
          .variant {
            margin-bottom: 4px;
          }
      }
    }
  }
</style>
