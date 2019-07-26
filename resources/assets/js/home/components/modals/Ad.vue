<template>
  <transition name="fade-anim">
    <Modal v-show="opened" @close="close">
      <!-- <video ref="video" src="http://clips.vorwaerts-gmbh.de/big_buck_bunny.mp4" :muted="muted"></video> -->

      <div class="cnt">
        <Adsense
          v-if="$store.getters['modals/ad/onceOpened']"
          data-ad-client="ca-pub-6511052822397382"
          data-ad-slot="3853489762"
        />

        <div
          class="rest a-row-center"
          v-text="$store.getters['modals/ad/timeLeft']"
        ></div>
      </div>
    </Modal>
  </transition>
</template>

<script>
import Modal from './../common/Modal';

export default {
  data() {
    return {
      // muted: true,
    };
  },
  methods: {
    close() {
      this.$store.commit('modals/ad/close');
    },
  },
  mounted() {

  },
  components: {
    Modal,
  },
  computed: {
    opened() {
      let opened = this.$store.getters['modals/ad/isOpened'];

      if(opened) {
        this.interval = setInterval(() => {
          this.$store.commit('modals/ad/decrementTime');
          if(this.$store.getters['modals/ad/timeLeft'] <= 0) {
            clearInterval(this.interval);
            this.close();
          }
        }, 1000);
      }

      return opened
    }
  }
}
</script>

<style lang="scss" scoped>

// .modal {
//   &.fade-anim {
//     &-enter {
//       opacity: 0;
//       .cnt {
//         transform: scale(1.2);
//       }
//     }
//     &-enter-to {
//       opacity: 1;
//       .cnt {
//         transform: scale(1);
//       }
//     }
//
//     &-leave {
//       opacity: 1;
//       .cnt {
//         transform: scale(1);
//       }
//     }
//     &-leave-to {
//       opacity: 0;
//       .cnt {
//         transform: scale(1.2);
//       }
//     }
//
//     &-leave-active,
//     &-enter-active {
//       transition: opacity 0.3s ease;
//       .cnt {
//         transition: transform 0.3s ease;
//       }
//     }
//   }
// }

.cnt {
  width: 100%;
  height: 100%;

  background: #fff;

  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;

  video {
    width: 100%;
  }

  .adswrapper {
    width: 600px;
    max-width: 100%;
    height: 300px;
  }

  .rest {
    background: #fff;
    top: 30px;
    right: 30px;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    position: absolute;
    box-shadow: 0 0 10px rgba(0,0,0,0.5);
    cursor: default;
    user-select: none;
  }

  .skip {
    border: 0;
    background: transparent;
    top: 20px;
    right: 20px;
    width: 50px;
    height: 50px;
    position: absolute;
  }

  .mute {
    border: 0;
    background: transparent;
    top: 20px;
    left: 20px;
    width: 50px;
    height: 50px;
    position: absolute;
  }
}
</style>
