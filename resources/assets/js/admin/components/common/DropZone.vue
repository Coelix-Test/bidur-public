<template>
  <div
    ref="zone"
    class="drop-zone"
  >
    <slot/>
  </div>
</template>

<script>
export default {
  methods: {

  },
  mounted() {
    [ 'drag', 'dragstart', 'dragend', 'dragover', 'dragenter', 'dragleave', 'drop' ].forEach( evt => {
      this.$refs.zone.addEventListener(evt, e => {
        if(evt == 'dragenter') {
          this.dragover = true;
        }

        else if(evt == 'drop' && e.dataTransfer) {
          this.dragover = false;
          this.$emit('input', e.dataTransfer.files);
        }

        else if(evt == 'dragleave' && e.dataTransfer) {
          var rect = this.$refs.zone.getBoundingClientRect();
          console.log(rect);
          console.log({ x: e.x, y: e.y });

          // Check the mouseEvent coordinates are outside of the rectangle
          if(
            e.x > rect.left + rect.width ||
            e.x < rect.left ||
            e.y > rect.top + rect.height ||
            e.y < rect.top
          ) {
            this.dragover = false;
          }
        }
        e.preventDefault();
        e.stopPropagation();
      }, false);
    });
  }
}
</script>

<style lang="scss" scoped>

.drop-zone {
  width: 100%;
  height: 100%;
}

</style>
