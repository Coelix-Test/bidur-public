<template>
  <div v-if="survey" class="single-survey">

    <div class="heading">
      <div class="date">{{ survey.survey.created_at | formatDate }}</div>
      <div class="actions">
        <!-- <button @click="deleteSurvey">D</button> -->
        <button @click="updateSurvey">שמור</button>
      </div>
    </div>
    <div class="content">
      <div class="survey-img-wrapper">
        <picture-input
          ref="pictureInput"
          @change="onChanged($event)"
          @remove="onRemoved"
          :width="100"
          :removable="true"
          removeButtonClass="ui red button"
          :height="100"
          :class="{ changed }"
          accept="image/jpeg, image/png, image/gif"
          buttonClass="ui button primary"
          :customStrings="{
          upload: '<h4>להעלות את זה!</h4>',
          drag: 'בחר תמונה'}">
        ></picture-input>
        <img v-if="surveyImage == null" class="thumbnail" :src="survey.survey.image">
      </div>
      <div class="column">
        <textarea class="title" type="text" v-model="survey.survey.question"></textarea>
        <div class="variant" v-if="variants" v-for="variant in variants" :key="variant.id">
          <!-- {{variant}} -->
          <input type="text" :name="variant.id" v-model="variant.variant">
          <span>הצבעות : {{variant.votes}}</span>
          <!-- {{variant.variant}} -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import PictureInput from 'vue-picture-input';

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
      variants : this.data.variants,
      surveyImage : null,
      surveyImageUrl : null,
      changed : false
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

      if(this.surveyImage){

        var sendData = new FormData();
        sendData.append('id', this.survey.survey.id);
        sendData.append('image', this.surveyImage);

        axios
          .post('/api/editSurveyEditImage',sendData,{
            headers : {'Content-Type': 'multipart/form-data'}
          })
          .then(res => {
            console.log(res);
          });
      }
        axios
          .post('/api/editSurvey',{survey : this.survey})
            .then(res => {
              console.log(res);
            });


    },
    onChanged(e) {
      this.changed = true;
      if (this.$refs.pictureInput.file) {

         this.surveyImage = this.$refs.pictureInput.file;

       } else {

         console.log("Old browser. No support for Filereader API");
       }
    },
    onRemoved() {
      this.surveyImage = null
    },
    chooseImageFile : function (e) {
      console.log(e);
    },
  },
  components : {
    PictureInput
  }
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
      .survey-img-wrapper {
        position: relative;
        &::v-deep {
          #picture-input {
          // display: none;
            div {
              // display:none;
              .preview-container {
                max-width:100%!important;
                height:300px!important;
                .picture-preview {
                  height:300px!important;
                }
                .picture-inner {
                  top:-300px!important;
                  span {
                    font-size: 16px;
                  }
                }
              }
            }
          }
        }
        > img {
          position: absolute;
          top:0;
          right:0;
          max-width: 100%;
          height:300px;
          object-fit: cover;
        }
      }
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
