<template>
  <div class="modal">
    <div class="wrapper">
      <div class="bg" @click="close"></div>
      <slot></slot>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    close(e) {
      this.$emit('close', e);
    }
  }
}
</script>

<style lang="scss" scoped>

.modal {
  position: fixed;
  width: 100%;
  height: 100%;
  left: 0;
  top: 0;
  z-index: 200;
  .wrapper {
    overflow-y: auto;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

    > * {
      position: relative;
    }

    .bg {
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      background: rgba(0, 0, 0, 0.3);
      position: absolute;
      cursor: pointer;
    }
  }


  &.fade-enter {
    opacity: 0;
  }
  &.fade-enter-to {
    opacity: 1;
  }

  &.fade-leave {
    opacity: 1;
  }
  &.fade-leave-to {
    opacity: 0;
  }

  &.fade-leave-active,
  &.fade-enter-active {
    transition: opacity 0.3s ease;
  }
}

</style>
