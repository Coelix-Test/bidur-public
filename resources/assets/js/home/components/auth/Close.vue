<template>
  <button @click="$emit('close')" class="close" type="button">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M24 1.39102L22.6087 0L12 10.6093L1.39129 0L0 1.39102L10.6087 12.0004L0 22.609L1.39129 24L12 13.3914L22.6087 24L24 22.609L13.3905 12.0004L24 1.39102Z" fill="#333333"/>
    </svg>
  </button>
</template>

<script>
export default {

}
</script>

<style lang="scss" scoped>

.close {
  position: absolute;
  left: 30px;
  top: 30px;
  @media(max-width: 992px) {
    left: 10px;
    top: 10px;
  }
}

</style>
