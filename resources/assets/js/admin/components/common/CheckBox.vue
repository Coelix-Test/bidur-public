<template>
  <label class="check-box">
    <input
      type="checkbox"
      @change="$emit('input', checked)"
      v-model="checked"
    >
    <div class="content">
      <slot/>
    </div>
  </label>
</template>

<script>
export default {
  props: {
    value: {}
  },
  data() {
    return {
      checked: this.value
    };
  }
}
</script>

<style lang="scss" scoped>

.check-box {
  display: flex;
  flex-direction: row;
  justify-content: flex-start;
  align-items: center;

  font-size: 30px;

  input {
    appearance: none;
    transition: background 0.3s ease;
    background: transparent;
    border: 2px solid #80B516;
    border-radius: 5px;
    width: 30px;
    height: 30px;
    position: relative;
    margin-left: 10px;

    &::before {
      content: '';
      width: 10px;
      height: 20px;
      border-bottom: 3px #fff solid;
      border-right: 3px #fff solid;
      position: absolute;
      left: 50%;
      top: 50%;
      transform: rotate(0) translate(-20%, 0);
      opacity: 0;
      transition: transform 0.3s ease, opacity 0.3s ease;
    }

    &:checked {
      background: #80B516;
      &::before {
        opacity: 1;
        transform: rotate(45deg) translate(-120%, -30%);
      }
    }
  }

}

</style>
