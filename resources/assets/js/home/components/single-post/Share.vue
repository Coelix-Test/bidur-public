<template>
  <div class="share" v-click-outside="() => opened = false">
    <button @click="opened = !opened" class="text">
      <span>שתף</span>
      <svg width="20" height="17" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0.201729 5.64176L5.6418 0.201804C5.7764 0.0671991 5.93571 -0.00012207 6.11989 -0.00012207C6.30406 -0.00012207 6.46349 0.0671991 6.59799 0.201804C6.73259 0.336484 6.79999 0.495874 6.79999 0.680012V3.39999H9.17997C14.2306 3.39999 17.3294 4.82732 18.477 7.6819C18.8523 8.63095 19.04 9.81046 19.04 11.22C19.04 12.3958 18.5902 13.9931 17.6906 16.0119C17.6694 16.0616 17.6323 16.1464 17.5791 16.2668C17.5259 16.3871 17.4782 16.4933 17.4357 16.5855C17.393 16.6775 17.347 16.7554 17.2974 16.8191C17.2125 16.9395 17.1133 16.9999 16.9999 16.9999C16.8937 16.9999 16.8105 16.9645 16.7502 16.8937C16.6901 16.8229 16.66 16.7342 16.66 16.6283C16.66 16.5643 16.6689 16.4706 16.6866 16.3466C16.7043 16.2225 16.7132 16.1395 16.7132 16.0969C16.7487 15.6155 16.7664 15.1795 16.7664 14.7902C16.7664 14.0748 16.7043 13.4338 16.5805 12.8671C16.4564 12.3004 16.2847 11.81 16.065 11.3955C15.8454 10.981 15.5622 10.6235 15.215 10.3225C14.868 10.0214 14.4944 9.77533 14.0942 9.58405C13.6939 9.39273 13.2229 9.2422 12.681 9.13245C12.1392 9.02267 11.5938 8.94649 11.0448 8.90395C10.4957 8.86142 9.87417 8.84028 9.17997 8.84028H6.79999V11.5603C6.79999 11.7445 6.73274 11.9039 6.59825 12.0384C6.46353 12.1729 6.30421 12.2403 6.12015 12.2403C5.93601 12.2403 5.77659 12.1729 5.6418 12.0384L0.201839 6.59829C0.067234 6.46368 -1.33514e-05 6.30437 -1.33514e-05 6.12019C2.47955e-05 5.93605 0.067234 5.77662 0.201729 5.64176Z" fill="#828282"/>
      </svg>
    </button>
    <transition name="anim">
      <div v-if="opened" class="popup">
        <div class="title">
          לחץ על הלחצן כדי להעתיק את הקישור
        </div>
        <div class="input">
          <button @click="copy" type="button" name="button">
            <svg width="16" height="21" viewBox="0 0 16 21" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M7.07993 8.2599V3.53995H0V20.1384H11.7999V8.2599H7.07993ZM8.25992 3.88211V7.07991H11.4577L8.25992 3.88211Z" fill="white"/>
              <path d="M14.9977 3.53996H11.7999V0.342163L14.9977 3.53996Z" fill="white"/>
              <path d="M3.53996 0H10.6199V4.57829L8.40157 2.35998H3.53996V0Z" fill="white"/>
              <path d="M15.3398 4.71997V16.5985H12.9799V6.93829L10.7616 4.71997H15.3398Z" fill="white"/>
            </svg>
          </button>
          <input readonly type="text" :value="url">
        </div>
        <div class="shareLinks">
          <a
            :href="`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`"
            target="_blank"
          >
            <img src="/img/icons/social-facebook-colored.svg">
          </a>
          <a
            :href="`whatsapp://send?text=${encodeURIComponent(url)}`"
            target="_blank"
          >
            <img src="/img/whatsApp.svg">
          </a>
          <a
            :href="`https://telegram.me/share/url?url=${encodeURIComponent(url)}&text=בדוק את זה!`"
            target="_blank"
          >
            <img src="/img/icons/social-telegram-colored.svg">
          </a>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
import Copied from './../modals/Copied.vue'
import ClickOutside from 'vue-click-outside'

export default {
  props: {
    link: {}
  },
  data() {
    return {
      opened: false,
    };
  },
  directives: {
    ClickOutside
  },
  methods: {
    copy() {
      navigator.clipboard.writeText(this.link);
      app.$modal.show(Copied, {}, {
        adaptive: true,
        width: 300,
        height: 'auto',
        pivotY: 0.1,
      });
    }
  },
  computed: {
    url() {
      return this.$env.URL + '/share/' + this.link;
    }
  }
}
</script>

<style lang="scss" scoped>

.share {
  position: relative;
  .text {
    color: #333333;
    font-weight: 300;
    font-size: 16px;
    border: 0;
    background: transparent;
  }
  .popup {
    top: calc(100% + 5px);
    left: 0;
    background: #FFFFFF;
    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.15);
    padding: 15px 10px;
    position: absolute;
    z-index:20;
    &::before {
      content: '';
      left: 20px;
      bottom: 100%;
      width: 0;
      height: 0;
      border-left: 10px solid transparent;
      border-right: 10px solid transparent;
      border-bottom: 10px solid #fff;
      position: absolute;
    }

    &.anim-enter {
      opacity: 0;
      transform: scale(0.9);
    }
    &.anim-enter-to {
      opacity: 1;
      transform: scale(1);
    }
    &.anim-leave {
      opacity: 1;
      transform: scale(1);
    }
    &.anim-leave-to {
      opacity: 0;
      transform: scale(0.9);
    }
    &.anim-enter-active,
    &.anim-leave-active {
      transition: transform 0.3s ease, opacity 0.3s ease;
    }

    .title {
      font-weight: 300;
      font-size: 14px;
      color: #000;
      padding-bottom: 10px;
    }

    .input {
      width: 270px;
      display: flex;
      flex-direction: row;
      input {
        flex-grow: 1;
        border: 1px solid #BDBDBD;
        border-right: 0;
        border-radius: 3px 0 0 3px;
        font-weight: 300;
        font-size: 12px;
        direction: ltr;
        padding-left: 10px;
      }
      button {
        border: 0;
        background: #EB5757;
        width: 36px;
        border-radius: 0 3px 3px 0;
      }
    }

    .shareLinks {
      display: flex;
      flex-direction: row;
      justify-content: center;
      padding-top: 8px;
      a {
        img {
          width:40px;
          height: 40px;
          margin: 0 8px;
        }
      }
    }
  }
}

</style>
