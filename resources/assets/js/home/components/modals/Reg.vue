<template>
  <div class="a-modal">
    <close @close="$emit('close')"/>
    <form @submit="submit" class="form">
      <div class="title">
        המשרה
      </div>

      <input
        type="text"
        required
        class="th-input"
        v-model="name"
        autocomplete="name"
      >
      <input
        type="text"
        required
        class="th-input"
        v-model="email"
        autocomplete="email"
      >
      <input
        type="text"
        autocomplete="tel"
        required
        class="th-input"
        v-model="phone"
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
      <text-input
        :type="hide.repeat ? 'password' : 'text'"
        required
        v-model="repeat"
      >
        <template v-slot:button>
          <eye v-model="hide.repeat"/>
        </template>
      </text-input>

      <label class="checkbox">
        <input class="th-checkbox" type="checkbox">
        <div class="label">
          רתאב שומישה יאנתל םיכסמ ינא
        </div>
      </label>
      <button class="a-row-center button" type="submit">המשרה</button>
      <div class="bottom">
        ?רתאב שמתשמ רבכ ךל שי
        <router-link class="link" to="/">
          ןאכ ץחל
        </router-link>
      </div>
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
      name: '',
      email: '',
      phone: '',
      pass: '',
      repeat: '',
      hide: {
        pass: true,
        repeat: true,
      }
    };
  },
  components: {
    Eye,
    TextInput,
    Close,
  },
  methods: {
    submit(e) {
      console.log('qweqweqwe');
      console.log('12312312312312');
      axios.post('/register', {
        name: this.name,
        email: this.email,
        phone: this.phone,
        password: this.pass,
      }).then(res => {
        console.log(res);
      });
      e.preventDefault();
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
  }
}

</style>
