<template>
  <div class="contact-us">
    <div class="column right">
      <h1>Contact Us</h1>
      <p class="info">
        <span><span class="icon"><img src="img/icons/location.svg" alt=""></span>Lorem ipsum dolor sit</span>
        <span><span class="icon"><img src="img/icons/mail.svg" alt=""></span>example@gmail.com</span>
        <span><span class="icon"><img src="img/icons/phone.svg" alt=""></span>+380631189234</span>
      </p>
      <div class="contact-form">
        <h2>Send us message!</h2>
        <form v-if="sendMessage" action="#">
          <input
            type="text"
            name="name"
            v-model="mailContent.name"
            required
            maxlength="40"
            placeholder="Your Name"
          />
          <input
            type="email"
            name="email"
            v-model="mailContent.email"
            required
            maxlength="40"
            placeholder="Email"
          />
          <input
            type="number"
            name="phone"
            v-model="mailContent.phone"
            required
            maxlength="20"
            placeholder="Phone Number"
          />
          <textarea
            name="message"
            rows="8"
            cols="80"
            required
            maxlength="400"
            v-model="mailContent.message"
            placeholder="Your Message"
          /></textarea>
          <button type="submit" @click="sendMail($event)">SEND</button>
        </form>
        <div v-if="sendMessage == false" class="form-notice">
          Your message was successfully sent!
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
            border-bottom: 1px solid #333;
            > span {
              color:#333;
              padding-left: 24px;
              display: flex;
              flex-direction: row;
              align-items: center;
              .icon {
                padding:0 0 0 8px;
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
                background: linear-gradient(294.72deg, #D3A01D 1.57%, #F2C94C 98.82%);
                box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.15);
                border-radius: 10px;
                align-self: flex-start;
                padding:16px 48px;
                border-style: hidden;
                color:#fff;
                font-weight: 900;
                font-size: 40px;
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
