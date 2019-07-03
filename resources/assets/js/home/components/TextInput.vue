<template lang="html">
  <div class="text-input">
    <input
      @input="$emit('input', $event.target.value)"
      @focus="$emit('focus', $event)"
      @change="$emit('change', $event)"
      @blur="$emit('blur', $event)"
      :class="{ 'has-button': $slots['button'] }"
      :type="type"
      class="th-input"
      :placeholder="placeholder"
      :autocomplete="autocomplete"
    >
    <div class="button">
      <slot name="button"/>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    value: {},
    type: {
      default: 'text',
      type: String,
    },
    placeholder: String,
    autocomplete: String,
  },
}
</script>

<style lang="scss" scoped>

.text-input {
  width: 100%;
  position: relative;
  input {
    &.has-button {
      padding-right: 50px;
    }
  }
  .button {
    top: 0;
    position: absolute;
    right: 0;
    width: 50px;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
  }
}

</style>
