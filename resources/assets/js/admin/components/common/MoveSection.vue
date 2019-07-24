<template>
  <div class="move-selection">
    <button type="button" @click="moveTop" class="top">
      &uarr;
    </button>
    <button type="button" @click="moveBot" class="bot">
      &darr;
    </button>
  </div>
</template>

<script>
export default {
  methods: {
    moveTop() {
      this.$emit('move', 'top')
    },
    moveBot() {
      this.$emit('move', 'bottom')
    }
  }
}
</script>

<style lang="scss" scoped>

.move-selection {
  position: absolute;
  display: flex;
  flex-direction: column;
  align-items: stretch;
  justify-content: flex-start;
  right: -40px;
  top: 50%;
  transform: translateY(-50%);

  button {
    background: #80B516;
    border: 0;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    color: #fff;
    margin: 5px 0;

    height: 30px;
  }
}

</style>
