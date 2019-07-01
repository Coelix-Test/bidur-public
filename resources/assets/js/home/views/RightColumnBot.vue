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
    mounted() {
      axios.post('/post/12').then(response => {console.log(response);})
    }
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
    }
  }
</style>

<style>
  .vue-poll .ans-cnt {
    margin:20px 12px;
  }
  .vue-poll .ans-cnt .ans-no-vote {
    border-radius: 0;
    border-color: #0E0E0E;
  }
  .vue-poll .ans-cnt .ans-no-vote:hover {
    background-color: #0E0E0E;
  }
  .vue-poll .ans-cnt .ans-no-vote .txt {
    color:#0E0E0E;
  }
  .vue-poll .ans-cnt .ans-no-vote:hover .txt {
    color:#fff;
  }

  .vue-poll .ans-cnt .ans .bg {
    right:0;
    left:unset;
    transition: 1s;
    /* clip-path: polygon(25px 0%, 100% 1%, 100% 100%, 25px 100%, 0% 50%); */
  }
  .vue-poll .ans-cnt .ans-voted {
    display: flex;
    flex-direction: row-reverse;
    justify-content: space-between;
    box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.15);
    padding:12px 12px;
  }
  .vue-poll .ans-cnt .ans {
    margin-top: 16px;
  }
  .vue-poll .ans-cnt .ans-voted .percent {
    margin:0;
    text-align: left;
  }
  .vue-poll .ans-cnt .ans:nth-child(1) .bg {
    background: linear-gradient(270.03deg, #F6AB62 2.44%, #B63E8E 41.46%, #3F5EFB 100.08%);
  }
  .vue-poll .ans-cnt .ans:nth-child(2) .bg {
    background: linear-gradient(180deg, rgba(128, 241, 255, 0.66) 55.56%, #1389EF 100%);
  }
  .vue-poll .ans-cnt .ans:nth-child(3) .bg {
    background: linear-gradient(270deg, #FFFB95 0.51%, #FF004D 99.32%);
  }
  .vue-poll .ans-cnt .ans:nth-child(4) .bg {
    background: linear-gradient(270deg, #403EC0 2.58%, #3BB9FE 78.1%, #00F0FF 97.67%);
  }
  .vue-poll .ans-cnt .ans-voted.selected .txt:after {
    content:'\2714';
    margin-right: 10px;
  }
  @media (max-width:768px) {
    .vue-poll .ans-cnt .ans-voted .percent, .vue-poll .ans-cnt .ans-voted .txt {
      font-size: 16px;
    }
    .vue-poll .qst {
      font-size: 24px;
      line-height: 24px;
      padding:0 12px;
      text-align: center;
    }
  }
</style>
