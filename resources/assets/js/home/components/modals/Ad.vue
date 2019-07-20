<template>
  <div class="a-modal">
    <!-- <video ref="video" src="http://clips.vorwaerts-gmbh.de/big_buck_bunny.mp4" :muted="muted"></video> -->

    <Adsense
      data-ad-client="ca-pub-6511052822397382"
      data-ad-slot="3853489762"
    />

    <div v-if="!$store.getters['global/ad/canClose']" class="rest a-row-center" v-text="rest"></div>
    <button @click="close" v-else class="skip a-row-center">
      <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g filter="url(#filter0_d)">
          <path d="M40 7.73877L38.2608 6L25 19.2617L11.7391 6L10 7.73877L23.2609 21.0005L10 34.2613L11.7391 36L25 22.7393L38.2608 36L40 34.2613L26.7382 21.0005L40 7.73877Z" fill="white"/>
        </g>
        <defs>
          <filter id="filter0_d" x="0" y="0" width="50" height="50" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
            <feFlood flood-opacity="0" result="BackgroundImageFix"/>
            <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
            <feOffset dy="4"/>
            <feGaussianBlur stdDeviation="5"/>
            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.15 0"/>
            <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow"/>
            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"/>
          </filter>
        </defs>
      </svg>

    </button>
    <!-- <button @click="mute" class="mute a-row-center">
      <svg v-show="muted" width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g filter="url(#filter0_d)">
          <path d="M32.3756 20.9171C32.3756 17.9337 30.7182 15.4475 28.232 14.2873V17.9337L32.3756 22.0773C32.3756 21.5801 32.3756 21.2486 32.3756 20.9171ZM36.5193 20.9171C36.5193 22.4088 36.1878 23.9005 35.6906 25.2265L38.1767 27.7127C39.337 25.7237 39.8342 23.2375 39.8342 20.7513C39.8342 13.6243 34.8618 7.65745 28.232 6.16575V9.6464C33.0386 11.3039 36.5193 15.6132 36.5193 20.9171ZM12.1547 6L10 8.15469L17.79 15.9447H10V25.8895H16.6298L24.9171 34.1767V23.0718L32.0441 30.1988C30.8839 31.0276 29.7237 31.6906 28.232 32.1879V35.6685C30.5524 35.1713 32.5414 34.1768 34.3646 32.6851L37.6795 36L39.8342 33.8454L24.9171 18.9283L12.1547 6ZM24.9171 7.65745L21.4364 11.1381L24.9171 14.6188V7.65745V7.65745Z" fill="white"/>
        </g>
        <defs>
          <filter id="filter0_d" x="0" y="0" width="49.8342" height="50" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
            <feFlood flood-opacity="0" result="BackgroundImageFix"/>
            <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
            <feOffset dy="4"/>
            <feGaussianBlur stdDeviation="5"/>
            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.15 0"/>
            <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow"/>
            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"/>
          </filter>
        </defs>
      </svg>

      <svg v-show="!muted" width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g filter="url(#filter0_d)">
          <path d="M10 15.9999V25.9999H16.6667L25 34.3333V7.66659L16.6667 15.9999H10ZM32.5 20.9999C32.5 17.9999 30.8333 15.4999 28.3333 14.3333V27.6666C30.8333 26.4999 32.5 23.9999 32.5 20.9999ZM28.3333 6.33325V9.83325C33.1667 11.3333 36.6667 15.6665 36.6667 20.9999C36.6667 26.3333 33.1667 30.6666 28.3333 32.1666V35.6666C35 34.1665 40 28.1666 40 20.9999C40 13.8333 35 7.83319 28.3333 6.33325Z" fill="white"/>
        </g>
        <defs>
          <filter id="filter0_d" x="0" y="0" width="50" height="50" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
            <feFlood flood-opacity="0" result="BackgroundImageFix"/>
            <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
            <feOffset dy="4"/>
            <feGaussianBlur stdDeviation="5"/>
            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.15 0"/>
            <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow"/>
            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"/>
          </filter>
        </defs>
      </svg>


    </button> -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      rest: 5,
      interval: null,
      muted: true,
    };
  },
  methods: {
    close() {
      this.$emit('close');
    },
    mute() {
      this.muted = !this.muted;
    }
  },
  mounted() {
    // this.$refs.video.play();
    this.interval = setInterval(() => {
      this.rest--;
      if(this.rest <= 0) {
        clearInterval(this.interval);
        this.$store.commit('global/ad/canClose');
      }
    }, 1000);
  },
}
</script>

<style lang="scss" scoped>
.a-modal {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;

  video {
    width: 100%;
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
