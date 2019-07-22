<template>
  <div class="a-modal">
    <close @close="$emit('close')"/>
    <div class="message">This is test alert message!</div>
  </div>
</template>

<script>
import Close from './../auth/Close.vue';

export default {
  data() {
    return {
    };
  },
  components: {
    Close,
  },
  methods: {

  }
}
</script>

<style lang="scss" scoped>

.a-modal {
  padding: 0 10px;
  padding-top: 60px;
}

</style>
