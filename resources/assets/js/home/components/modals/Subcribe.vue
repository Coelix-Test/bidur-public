<template>
  <div class="a-modal">
    <close @close="$emit('close')"/>
    <form @submit="submit" class="form">
      <div class="title">
        השארת פרטים
      </div>
 
      <input
        type="text"
        required
        class="th-input"
        v-model="email"
        placeholder="שם מלא"
      >
      <input
        type="text"
        autocomplete="tel"
        required
        class="th-input"
        v-model="phone"
        placeholder="מספר טלפון"
      >
      
      <div v-if="err.length" class="err">{{ err }}</div>
      <label ref="agreement" class="checkbox">
        <input v-model="agreement" class="th-checkbox" type="checkbox">
        <div class="label">
         <a href="/images/agreement.pdf" target="_blank">אני מסכים לתנאי השימוש באתר
         </a></div>
      </label>

      <button class="th-btn th-btn-gold" type="submit">לשלב הבא!</button>
    
      
    </form>

  </div>
</template>

<script>
import Eye from './../auth/Eye.vue';
import TextInput from './../TextInput.vue';
import Close from './../auth/Close.vue';


export default {
  data() {
    return {
      email: '',
      phone: '',
      agreement: true,
      timeout: false,
      err: '',
    };
  },
  components: {
    Eye,
    TextInput,
    Close,
  },
  methods: {
    submit(e) {

      e.preventDefault();

      this.$refs.agreement.classList.remove('shake', 'animated');
 

      if(!this.agreement) {
        setImmediate(() => {
          this.$refs.agreement.classList.add('shake', 'animated');
        });
        return;
      }
      axios.post('/api/subcribe', {
        email: this.email,
        phone: this.phone,
      }).then(res => {
        this.$emit('close');
        this.$router.push({name: 'new-year-survey'});
      }).catch(err => {
        this.err = 'Invalid email or phone';
      });
    },
   
  }
}
</script>

<style lang="scss" scoped>

.a-modal {
  padding: 0 10px;
  padding-top: 60px;
  .form {
    max-width: 430px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-bottom: 60px;
    input, .text-input {
      margin: 7px 0;
    }
    button {
      width:100%;
    }
    .title {
      font-weight: bold;
      font-size: 50px;
      text-align: center;
      color: #000000;
      line-height: 100%;
    }
    .button {
      background: linear-gradient(294.72deg, #D3A01D 1.57%, #F2C94C 98.82%);
      box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.15);
      width: 360px;
      height: 80px;
      font-weight: bold;
      font-size: 28px;
      border: 0;
      color: #fff;
      border-radius: 5px;
    }
    .bottom {
      padding-top: 20px;
      font-size: 14px;
      text-align: center;
      color: #828282;

      .link {
        color: #FF1744;
        text-decoration: underline;
        background: transparent;
        border: 0;
      }
    }
    .checkbox {
      display: flex;
      justify-content: flex-start;
      flex-direction: row;
      align-items: center;
      .label {
        color: #828282;
        font-size: 14px;
      }
      input {
        margin-left: 10px;
      }
    }
    .err {
      color: #EB5757;
      font-size: 16px;
    }
  }

  @media(max-width: 992px) {
    padding-top: 40px;
    height: 100%;
    .form {
      justify-content: center;
      height: 100%;
      .title {
        font-size: 32px;
      }
    }
  }
}

</style>
