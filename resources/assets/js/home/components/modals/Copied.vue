<template>
  <div class="a-modal">
    הקישור הועתק
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
