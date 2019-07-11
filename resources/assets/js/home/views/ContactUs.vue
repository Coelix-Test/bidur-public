<template>
  <div class="contact-us">
    <div class="column right">
      <h1>צור קשר</h1>
      <p class="info">
        <a href="#"><span class="icon"><img src="img/icons/location.svg" alt=""></span>דבורה הנביאה  תל אביב-יפו</a>
        <a href="mailto:example@gmail.com"><span class="icon"><img src="img/icons/mail.svg" alt=""></span>israelbidur1@gmail.com</a>
        <a href="tel:+380631189234"><span class="icon"><img src="img/icons/phone.svg" alt=""></span>0505435701</a>
      </p>
      <div class="contact-form">
        <h2>יש לכם שאלה? שלחו לנו הודעה!</h2>
        <form @submit="sendMail" v-if="sendMessage">
          <input
            type="text"
            name="name"
            v-model="mailContent.name"
            required
            maxlength="40"
            placeholder="שם מלא"
          />
          <input
            type="email"
            name="email"
            v-model="mailContent.email"
            required
            maxlength="40"
            placeholder="מייל"
          />
          <input
            type="number"
            name="phone"
            v-model="mailContent.phone"
            required
            maxlength="20"
            placeholder="טלפון"
          />
          <textarea
            name="message"
            rows="8"
            cols="80"
            required
            maxlength="400"
            v-model="mailContent.message"
            placeholder="תוכן ההודעה"
          /></textarea>
          <button class="th-btn th-btn-gold" type="submit">שלח הודעה!</button>
        </form>
        <div v-if="sendMessage == false" class="form-notice">
          ההודעה שלך נשלחה בהצלחה!
        </div>
      </div>
    </div>
    <div class="column left">
      <img class="leftColImg" src="img/2471780.png" alt="contact-us-girl">
    </div>
  </div>

</template>

<script>
export default {
  data() {
    return {
      mailContent : {
        name : '',
        email : '',
        phone : '',
        message : ''
      },
      sendMessage : true
    }
  },
  methods : {
    sendMail(e) {
      e.preventDefault();
      axios
        .post('/sendMail',this.mailContent)
          .then(res => {
            // console.log(res);
            if(res.data.success == true) {
              // alert('Your message was successfully sent!');
              this.mailContent.name = null;
              this.mailContent.email = null;
              this.mailContent.phone = null;
              this.mailContent.message = null;
              this.sendMessage = false;
            }

          })
    }
  }
}
</script>

<style lang="scss" scoped>
  .contact-us {
    max-width: 1440px;
    margin: 0 auto;
    padding:32px 24px;
    display: flex;
    flex-direction: row;
      .column {
        flex-basis:50%;
        width:50%;
          &.right {
            padding-left:12px;
          }
          &.left {
            padding-right:12px;
          }
          .leftColImg {
            width:100%;
          }
          h1 {
            color:#333;
            font-weight: 900;
          }
          .info {
            display: flex;
            flex-direction: row;
            align-items: center;
            padding-bottom: 24px;
            margin-bottom: 24px;
            flex-wrap: wrap;
            border-bottom: 1px solid #333;
            > a {
              color:#333;
              padding-left: 24px;
              display: flex;
              flex-direction: row;
              align-items: center;
              white-space: nowrap;
              padding-bottom: 4px;
              text-decoration-color: #333;
              .icon {
                margin: 0 0 0 8px;
                width: 30px;
                display: block;
              }
            }
          }
        .contact-form {
          h2 {
            font-weight: 700;
            margin-bottom: 16px;
            color:#333;
            font-size: 40px;
          }
          form {
            display: flex;
            flex-direction: column;
             input {
               font-size:20px;
               color:#333;
               border-radius: 10px;
               border:1px solid #E0E0E0;
               margin-bottom: 16px;
               padding:6px 12px;
               -webkit-appearance: none;
               -moz-appearance: textfield;
               &::placeholder {
                 color:#333;
               }
               &[type=number]::-webkit-inner-spin-button,
               &[type=number]::-webkit-outer-spin-button {
                 -webkit-appearance: none;
                 margin: 0;
               }
             }
             textarea {
               font-size: 20px;
               color: #333;
               border:1px solid #E0E0E0;
               border-radius: 10px;
               margin-bottom: 16px;
               min-height:200px;
               padding:6px 12px;
               &::placeholder {
                 color:#333;
               }
             }
             button {
                align-self: flex-start;
             }
          }

        }
      }
  }
  @media(max-width:768px) {
    .contact-us {
      flex-direction: column;
      padding:16px 12px;
        .column {
          flex-basis:100%;
          width:100%;
          padding-right: 0!important;
          padding-left: 0!important;
          margin-bottom: 16px;
          .info {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            > span {
              padding-bottom: 8px;
            }
          }
          h1 {
            font-size: 32px;
          }
         .contact-form {
           h2 {
             font-size: 32px;
           }
         }
        }

    }
  }

</style>
