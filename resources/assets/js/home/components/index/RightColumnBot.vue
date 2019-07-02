<template>
  <div class="right-column-bot">
    <div class="selected-poll">

      <img src="img/rihanna.png" alt="">
      <vue-poll class="poll" v-bind="options" @addvote="addVote"/>

    </div>
  </div>
</template>

<script>
import VuePoll from 'vue-poll'
export default {
    data() {
        return {
            options: {
                question: 'מה חשבתם על ההופעה האחרונה של ריהנה',
                answers: [
                    { value: 1, text: 'Supper, it is wonder news!', votes: 53 },
                    { value: 2, text: 'Normal, i know it', votes: 35 },
                    { value: 3, text: 'Oh my God, what is it!!??', votes: 30 },
                    { value: 4, text: 'Oh my God, what is it!!??', votes: 10 }
                ]
            }
        }
    },
    components: {
        VuePoll
    },
    methods: {
        addVote(obj){
            console.log('You voted ' + obj.value + '!');
        }
    },
}
</script>

<style lang="css" scoped>
  .right-column-bot {
    flex-basis:50%;
    padding-left: 8px;
  }
  .selected-poll {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    overflow: hidden;
    background: #FFFFFF;
    box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
  }
  .selected-poll img {
    width:100%;
    height:auto;
    max-width:100%;
    object-fit: cover;
    margin-bottom: 24px;
  }
  .poll {

  }
  h2 {
    margin-top: 32px;
    font-size: 32px;
    color:#0E0E0E;
    margin-bottom: 32px;
  }
  @media (max-width:768px) {
    .right-column-bot {
      order: 3;
      flex-basis:100%;
      padding-left: 0;
      margin-bottom: 16px;
      margin-top: 8px;
    }
  }
  @media (max-width:550px) {
    .right-column-bot {
      margin-top: 0;
    }
  }
</style>
