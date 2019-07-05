<template>
  <div class="one-survey">
    <div class="title">
      What do you think about it?
    </div>
    <div class="body">
      <svg class="lightning" width="26" height="46" viewBox="0 0 26 46" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M25.9284 15.7765C25.803 15.5066 25.533 15.3334 25.2356 15.3334H16.1738L25.117 1.17687C25.2661 0.940756 25.2753 0.641755 25.1408 0.3972C25.0062 0.151836 24.7492 0 24.4708 0H12.2356C11.9458 0 11.6811 0.164055 11.5512 0.423974L0.0806353 23.424C-0.0379238 23.6609 -0.0249298 23.943 0.11424 24.1692C0.254217 24.3953 0.49967 24.5333 0.765016 24.5333H8.62845L0.0599343 44.9359C-0.0861363 45.2848 0.0438936 45.6895 0.365786 45.8873C0.489633 45.9633 0.627279 46 0.764209 46C0.983674 46 1.20009 45.9057 1.35002 45.7279L25.8206 16.5944C26.0125 16.3661 26.0538 16.0471 25.9284 15.7765Z" fill="#F2C94C"/>
      </svg>

      <div class="left" ref="left">
        <img :src="data.imageLeft">
        <hearth-button @click="left"/>
      </div>
      <div class="right" ref="right">
        <img :src="data.imageRight">
        <hearth-button @click="right"/>
      </div>
    </div>
  </div>
</template>

<script>
import HearthButton from './HearthButton'

export default {
  props: {
    data: {},
  },
  data() {
    return {

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
      this.selected = 'left';
      setTimeout(() => {
        el.classList.add('none');
      }, 500);

      axios.post('/likeForSelectOne', {
        position: 'left',
        serviceId: this.data.id,
      })
    },
    right() {
      if(this.popped) return;
      let el = this.$refs.left;
      this.$refs.right.classList.add('selected');
      el.classList.add('fade');
      this.popped = true;
      this.selected = 'right';
      setTimeout(() => {
        el.classList.add('none');
      }, 500);

      axios.post('/likeForSelectOne', {
        position: 'right',
        serviceId: this.data.id,
      })
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
  display: flex;
  flex-direction: column;
  align-items: stretch;
  padding-bottom: 50px;
  .title {
    font-weight: bold;
    font-size: 36px;
    color: #333333;
    text-align: center;
    padding-bottom: 50px;
    padding-top: 50px;
  }

  .body {
    flex-grow: 1;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    img {
      width: 300px;
      height: 100%;
    }
    .lightning {

    }
    .left,
    .right {
      height: 100%;
      position: absolute;
      top: 0;
      transition: box-shadow 0.5s ease, opacity 0.5s ease, left 0.5s ease, right 0.5s ease, transform 0.5s ease;
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
      &.selected {
        z-index: 1;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        .hearth-button {
          display: none;
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
