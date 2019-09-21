<template>
  <div class="right-column-bot">

    <surveys v-if="!$env.MOBILE"/>
		<latest-posts v-if="!$env.MOBILE"/>

  </div>
</template>

<script>
import Surveys from './Surveys'
import LatestPosts from './LatestPosts'

export default {
  components: {
    Surveys,
		LatestPosts,
  },
  methods: {
    // addVote(obj, id){
    //   console.log(obj);
    //   axios
    //     .post('/addSurveyVote',{ surveyId : id, answer : obj.value })
    //       .then(response => {
    //         // console.log(response);
    //       });
    // }
  },
}
</script>

<style lang="scss" scoped>
.right-column-bot {
  flex-basis:50%;
  width:50%;
  padding-left: 8px;
  /* max-width: 500px; */

}
.selected-poll {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: flex-start;
  overflow: hidden;
  background: #FFFFFF;
  box-sizing: border-box;
  border:4px solid #E4A913;
  box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
}
.selected-poll img {
  width:100%;
  height:auto;
  max-width:100%;
  object-fit: cover;
  margin-bottom: 0;
}
.poll {
  width:100%;
}
.selected-poll h3 {
  padding-top: 32px;
  font-size: 32px;
  color:#0E0E0E;
  margin:0;
  background: linear-gradient(270deg, #E4A913 0%, #EED074 99.53%);
  padding-bottom: 32px;
}

@media (max-width:768px) {
  .selected-poll {
    margin-bottom: 8px;
  }
}
@media (max-width:768px) {
  .right-column-bot {
    order: 2;
    flex-basis:100%;
    width:100%;
    padding-left: 0;
    margin-bottom: 16px;
    margin-top: 8px;
    padding-left: 8px;
    padding-right: 8px;
  }
}
@media (max-width:550px) {
  .right-column-bot {
    margin-top: 0;
  }
}

.like-survey {
  background: #FFFFFF;
  box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
  margin-bottom: 50px;
}
.one-survey {
  background: #FFFFFF;
  box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
  margin-bottom: 50px;
}

</style>
