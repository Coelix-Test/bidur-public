<template>
  <div class="a-modal">
    <form class="form">
      <div class="title">
        Registration
      </div>
      <input type="text">
      <input type="text">
      <input type="text">
      <input type="text">
      <input type="text">
      <label class="checkbox">
        <input type="text">
        <div class="label">
          I agree with the Privacy Policy and Terms of Use
        </div>
      </label>
      <button type="button" name="button">Registration</button>
      <div class="bottom">
        Already have an account? Sign in.
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    name: '',
    gmail: '',
    phone: '',
    pass: '',
    confirm: '',
  }
}
</script>

<style lang="scss" scoped>

.a-modal {
  .form {
    input {
      border: 1px solid #7C92FF;

    }
    .bottom {
      font-size: 14px;
      text-align: center;
      color: #828282;
    }
  }
}

</style>
