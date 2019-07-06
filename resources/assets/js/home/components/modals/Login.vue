<template>
  <div class="a-modal">
    <close @close="$emit('close')"/>
    <form @submit="submit" class="form">
      <div class="title">
        תורבחתה
      </div>

      <input
        type="text"
        required
        class="th-input"
        v-model="email"
        autocomplete="email"
        placeholder="מייל"
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

      <div v-if="err.length" class="err">{{ err }}</div>

      <button class="th-btn th-btn-gold" type="submit">המשרה</button>
      <div class="bottom">
        יש לך כבר משתמש באתר?
        <button class="link" @click="login">
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
import Reg from './../modals/Reg.vue';

export default {
  data() {
    return {
      email: '',
      pass: '',
      hide: {
        pass: true,
      },
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

      axios.post('/login', {
        email: this.email,
        password: this.pass,
      }).then(res => {
        this.$emit('close');
        document.location.reload();
      }).catch(err => {
        this.err = 'Invalid email or password';
      });
    },
    reg() {
      this.$emit('close');
      this.$modal.show(Reg, {}, {
        adaptive: true,
        width: 600,
        height: 'auto',
        scrollable: true,
      });
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
    .title {
      font-weight: bold;
      font-size: 50px;
      text-align: center;
      color: #000000;
    }
    .th-btn {
      margin-top: 10px;
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

    .err {
      color: #EB5757;
      font-size: 16px;
    }
  }
}

</style>
