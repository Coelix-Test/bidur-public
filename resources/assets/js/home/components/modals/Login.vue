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
      >

      <text-input
        :type="hide.pass ? 'password' : 'text'"
        required
        v-model="pass"
      >
        <template v-slot:button>
          <eye v-model="hide.pass"/>
        </template>
      </text-input>

      <div v-if="err.length" class="err">{{ err }}</div>

      <label ref="agreement" class="checkbox">
        <input v-model="agreement" class="th-checkbox" type="checkbox">
        <div class="label">
          רתאב שומישה יאנתל םיכסמ ינא
        </div>
      </label>
      <button class="th-btn th-btn-gold" type="submit">המשרה</button>
      <div class="bottom">
        ?רתאב שמתשמ רבכ ךל שי
        <button class="link" @click="reg">
          ןאכ ץחל
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
      agreement: false,
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

      this.$refs.agreement.classList.remove('shake', 'animated');

      if(!this.agreement) {
        setImmediate(() => {
          this.$refs.agreement.classList.add('shake', 'animated');
        });
        return;
      }

      axios.post('/login', {
        email: this.email,
        password: this.pass,
      }).then(res => {
        this.$emit('close');
        document.location.reload();
      }).catch(err => {
        this.err = 'Invalid email or password';
      });
      e.preventDefault();
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
    .button {

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
}

</style>
