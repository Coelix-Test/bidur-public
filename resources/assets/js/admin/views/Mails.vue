<template>
  <div class="mails">
    <div class="mails-wrapper">
      <div v-for="mail in mails" :key="mail.id" class="single-mail">
        <button class="deleteMessage" @click="deleteMessage(mail.id)">למחוק</button>
        <div class="author">
          <div class="name"><span>שם :</span> {{mail.name}} </div>
          <div class="email"><span>דוא"ל :</span> {{mail.email}} </div>
          <div class="phone"><span>מספר טלפון :</span> {{mail.phone}} </div>
        </div>
        <div class="message">
          <div>הודעה :</div>
          <p> {{mail.message}} </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      mails : null
    }
  },
  created() {
    axios
      .post('/getAllMails')
        .then(res => {
          this.mails = res.data;
        })
  },
  methods : {
    deleteMessage(id) {
      axios
        .post('/deleteMail')
          .then(res => {
            console.log(res.data);
            this.mails = res.data;
          });
    }
  }
}
</script>

<style lang="scss" scoped>
  .mails {
    max-width: 1440px;
    margin:0 auto;
    padding:32px 24px;
    .mails-wrapper {
      display: flex;
      flex-direction: row;
      flex-wrap:wrap;
      .single-mail {
        flex-basis:calc(33% - 16px);
        margin:0 8px 16px;
        border:1px solid #eee;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: flex-start;
        padding:12px;
        position: relative;
        .author {
           span {
            font-weight: 700;
          }
        }
        .message {
          > div {
            font-weight: 700;
          }
        }
        .deleteMessage {
          position: absolute;
          top:12px;
          left:12px;
          color:#EB5757;
          background-color: transparent;
          border-width:0;
        }
      }
    }
  }
</style>
