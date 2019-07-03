<template>
  <div class="a-modal">
    Link copied to your buffer!
  </div>
</template>

<script>
export default {
  mounted() {
    setTimeout(() => {
      this.$emit('close');
    }, 500);
  },
}
</script>

<style lang="scss" scoped>
.a-modal {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 20px;
}
</style>
