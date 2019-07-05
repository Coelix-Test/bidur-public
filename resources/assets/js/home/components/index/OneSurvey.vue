<template>
  <div class="one-survey">
    <div class="title">
      What do you think about it?
    </div>
    <div class="body">
      <div class="left" ref="left">
        <img src="https://via.placeholder.com/300x460">
        <hearth-button @click="left"/>
      </div>
      <div class="right" ref="right">
        <img src="https://via.placeholder.com/300x460">
        <hearth-button @click="right"/>
      </div>
    </div>
  </div>
</template>

<script>
import HearthButton from './HearthButton'

export default {
  data() {
    return {
      selected: null,
    };
  },
  components: {
    HearthButton,
  },
  methods: {
    left() {
      if(this.popped) return;
      let el = this.$refs.right;
      this.$refs.left.classList.add('selected');
      el.classList.add('fade');
      this.popped = true;
      setTimeout(() => {
        el.classList.add('none');
      }, 500);
    },
    right() {
      if(this.popped) return;
      let el = this.$refs.left;
      this.$refs.right.classList.add('selected');
      el.classList.add('fade');
      this.popped = true;
      setTimeout(() => {
        el.classList.add('none');
      }, 500);
    }
  }
}
</script>

<style lang="scss" scoped>

.one-survey {
  background: #FFFFFF;
  box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
  margin-bottom: 50px;
  height: 700px;
  padding: 0 20px;
  .title {
    font-weight: bold;
    font-size: 36px;
    color: #333333;
    text-align: center;
    padding-bottom: 50px;
    padding-top: 50px;
  }

  .body {
    position: relative;
    .left,
    .right {
      position: absolute;
      top: 0;
      transition: opacity 0.5s ease, left 0.5s ease, right 0.5s ease, transform 0.5s ease;
      &.fade {
        opacity: 0;
      }
      &.none {
        display: none;
      }
      &:hover {
        .hearth-button {
          opacity: 1;
        }
      }
    }
    .left {
      left: 0;
      &.selected {
        left: 50%;
        transform: translateX(-50%) scale(1.1);
      }
    }
    .right {
      right: 0;
      &.selected {
        right: 50%;
        transform: translateX(50%) scale(1.1);
      }
    }
  }
}

</style>
