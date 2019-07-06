<template>
  <div class="contact-us">
    <div class="column">
      <h1>Contact Us</h1>
      <p class="info">
        <span><span class="icon">l</span>Lorem ipsum dolor sit</span>
        <span><span class="icon">m</span>example@gmail.com</span>
        <span><span class="icon">p</span>+380631189234</span>
      </p>
      <div class="contact-form">
        <h2>Send us message!</h2>
        <form action="#">
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
      </div>
    </div>
    <div class="column">
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
      }
    }
  },
  methods : {
    sendMail(e) {
      e.preventDefault();
      axios
        .post('/sendMail',this.mailContent)
          .then(res => {
            console.log(res);
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
          .leftColImg {
            width:100%;
          }
          h1 {
            color:#333;
          }
          .info {
            display: flex;
            flex-direction: row;
            align-items: center;
            padding-bottom: 24px;
            margin-bottom: 24px;
            border-bottom: 1px solid #333;
            span {
              color:#333;
              .icon {
                padding:0 6px;
              }
            }
          }
        .contact-form {
          form {
            display: flex;
            flex-direction: column;
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
        }

    }
  }

</style>
