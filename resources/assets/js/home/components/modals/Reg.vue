<template>
  <div class="a-modal">
    <close @close="$emit('close')"/>
    <form @submit="submit" class="form">
      <div class="title">
        הרשמה
      </div>

      <input
        type="text"
        required
        class="th-input"
        v-model="name"
        autocomplete="name"
        placeholder="שם"
      >
      <input
        type="email"
        required
        class="th-input"
        v-model="email"
        autocomplete="email"
        placeholder="מייל"
      >
      <input
        type="text"
        autocomplete="tel"
        required
        class="th-input"
        v-model="phone"
        placeholder="מכשיר טלפון"
      >

      <text-input
        :type="hide.pass ? 'password' : 'text'"
        required
        v-model="pass"
        placeholder="סיסמה"
      >
        <template v-slot:button>
          <eye v-model="hide.pass"/>
        </template>
      </text-input>
      <text-input
        ref="repeat"
        :type="hide.repeat ? 'password' : 'text'"
        required
        v-model="repeat"
        placeholder="חזור על הסיסמה"
      >
        <template v-slot:button>
          <eye v-model="hide.repeat"/>
        </template>
      </text-input>

      <div v-if="err.length" class="err">{{ err }}</div>

      <label ref="agreement" class="checkbox">
        <input v-model="agreement" class="th-checkbox" type="checkbox">
        <div class="label">
          אני מסכים לתנאי השימוש באתר
        </div>
      </label>
      <button class="th-btn th-btn-gold" type="submit">הרשמה</button>
      <div class="bottom">
        יש לך כבר משתמש באתר?
        <button class="link" type="button" @click="login">
          לחץ כאן
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import Eye from './../auth/Eye.vue';
import TextInput from './../TextInput.vue';
import Close from './../auth/Close.vue';
import Login from './../modals/Login.vue';

export default {
  data() {
    return {
      name: '',
      email: '',
      phone: '',
      pass: '',
      repeat: '',
      hide: {
        pass: true,
        repeat: true,
      },
      err: '',
      agreement: false,
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
      this.$refs.repeat.$el.classList.remove('shake', 'animated');

      if(!this.agreement) {
        setImmediate(() => {
          this.$refs.agreement.classList.add('shake', 'animated');
        });
        return;
      }

      if(this.pass !== this.repeat) {
        this.err = 'הסיסמה חוזרת כראוי';
        setImmediate(() => {
          this.$refs.repeat.$el.classList.add('shake', 'animated');
        });
        return;
      }

      axios.post('/register', {
        name: this.name,
        email: this.email,
        phone: this.phone,
        password: this.pass,
        password_confirmation: this.repeat,
      }).then(res => {
        this.$emit('close');
        document.location.reload();
      });
    },
    login() {
      this.$emit('close');
      this.$root.openLogin();
    }
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
    .form {
      .title {
        font-size: 32px;
      }
    }
  }
}

</style>
