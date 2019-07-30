<template>
  <div class="like-survey">
    <img :src="data.imgUrl">
    <div class="img-caption">{{data.description}}</div>
    <div class="body" ref="body">
      <div class="title">
        {{ data.description }}
      </div>
      <div class="buttons" >
        <button @click="dislike" ref="dislike" type="button" class="dislike">
          <span v-if="showPercents" class="percent" dir="ltr">{{Math.floor(likeHeight.num)}}%</span>
          <div class="yellow-star">
            <svg xmlns="http://www.w3.org/2000/svg" width="178" height="169" viewBox="0 0 178 169" fill="none">
              <path d="M89.2769 0L118.883 52.5271L177.988 64.4527L137.181 108.842L144.104 168.739L89.2769 143.646L34.4501 168.739L41.3726 108.842L0.565292 64.4527L59.6704 52.5271L89.2769 0Z" fill="url(#paint0_linear)"/>
              <defs>
                <linearGradient id="paint0_linear" x1="-10.8636" y1="-2.51701e-05" x2="104.602" y2="233.072" gradientUnits="userSpaceOnUse">
                  <stop offset="0.177083" stop-color="#F9DD4A"/>
                  <stop offset="0.265625" stop-color="#F97B4A"/>
                  <stop offset="0.515625" stop-color="#C6278D"/>
                  <stop offset="0.703125" stop-color="#7151CB"/>
                  <stop offset="0.864583" stop-color="#4200FF"/>
                </linearGradient>
              </defs>
            </svg>
          </div>
          <div class="gray-star" :style="{ height: dislikeHeight.text }">
            <svg xmlns="http://www.w3.org/2000/svg" width="178" height="169" viewBox="0 0 178 169" fill="none">
              <path d="M89.2769 0L118.883 52.5271L177.988 64.4527L137.181 108.842L144.104 168.739L89.2769 143.646L34.4501 168.739L41.3726 108.842L0.565292 64.4527L59.6704 52.5271L89.2769 0Z" fill="url(#paint0_linear)"/>
              <defs>
                <linearGradient id="paint0_linear" x1="-10.8636" y1="-2.51701e-05" x2="104.602" y2="233.072" gradientUnits="userSpaceOnUse">
                <stop offset="0.177083" stop-color="#F9DD4A"/>
                <stop offset="0.265625" stop-color="#F97B4A"/>
                <stop offset="0.515625" stop-color="#C6278D"/>
                <stop offset="0.703125" stop-color="#7151CB"/>
                <stop offset="0.864583" stop-color="#4200FF"/>
              </linearGradient>
              </defs>
            </svg>
          </div>

          <svg v-if="showIcons" class="icon" width="52" height="50" viewBox="0 0 52 50" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M8.47382 33.895H1.6948C0.762844 33.895 0 33.136 0 32.2003V1.69455C0 0.759242 0.759499 4.67107e-05 1.6948 4.67107e-05H8.47382C9.40913 4.67107e-05 10.1686 0.759344 10.1686 1.69455V32.2003C10.1686 33.136 9.40568 33.895 8.47382 33.895Z" fill="white" fill-opacity="1"/>
            <path d="M47.6798 33.895C47.4068 33.9412 34.6272 33.895 34.6272 33.895L36.4122 38.7649C37.6439 42.1283 36.8464 47.2639 33.4289 49.0897C32.3162 49.6843 30.7615 49.9828 29.5081 49.6673C28.7892 49.4864 28.1575 49.0105 27.7809 48.3729C27.3479 47.6396 27.3926 46.7835 27.2384 45.9704C26.8473 43.908 25.8728 41.947 24.3636 40.4752C21.7324 37.9089 13.5586 30.5056 13.5586 30.5056V3.38931H41.8046C45.616 3.38708 48.1138 7.64335 46.234 10.968C48.4747 12.4031 49.2411 15.426 47.9288 17.747C50.1696 19.1821 50.9359 22.205 49.6236 24.526C53.4899 27.0022 52.1973 33.1309 47.6798 33.895Z" fill="white" fill-opacity="1"/>
          </svg>
        </button>
        <button @click="like" ref="like" type="button" class="like">
          <span v-if="showPercents" class="percent" dir="ltr">{{Math.floor(dislikeHeight.num)}}%</span>
          <div class="yellow-star">
            <svg xmlns="http://www.w3.org/2000/svg" width="178" height="169" viewBox="0 0 178 169" fill="none">
              <path d="M89.2769 0L118.883 52.5271L177.988 64.4527L137.181 108.842L144.104 168.739L89.2769 143.646L34.4501 168.739L41.3726 108.842L0.565292 64.4527L59.6704 52.5271L89.2769 0Z" fill="url(#paint0_linear)"/>
              <defs>
                <linearGradient id="paint0_linear" x1="-10.8636" y1="-2.51701e-05" x2="104.602" y2="233.072" gradientUnits="userSpaceOnUse">
                <stop offset="0.177083" stop-color="#F9DD4A"/>
                <stop offset="0.265625" stop-color="#F97B4A"/>
                <stop offset="0.515625" stop-color="#C6278D"/>
                <stop offset="0.703125" stop-color="#7151CB"/>
                <stop offset="0.864583" stop-color="#4200FF"/>
              </linearGradient>
              </defs>
            </svg>
          </div>
          <div class="gray-star" :style="{ height: likeHeight.text }">
            <svg xmlns="http://www.w3.org/2000/svg" width="178" height="169" viewBox="0 0 178 169" fill="none">
              <path d="M89.2769 0L118.883 52.5271L177.988 64.4527L137.181 108.842L144.104 168.739L89.2769 143.646L34.4501 168.739L41.3726 108.842L0.565292 64.4527L59.6704 52.5271L89.2769 0Z" fill="url(#paint0_linear)"/>
              <defs>
                <linearGradient id="paint0_linear" x1="-10.8636" y1="-2.51701e-05" x2="104.602" y2="233.072" gradientUnits="userSpaceOnUse">
                <stop offset="0.177083" stop-color="#F9DD4A"/>
                <stop offset="0.265625" stop-color="#F97B4A"/>
                <stop offset="0.515625" stop-color="#C6278D"/>
                <stop offset="0.703125" stop-color="#7151CB"/>
                <stop offset="0.864583" stop-color="#4200FF"/>
              </linearGradient>
              </defs>
            </svg>
          </div>
          <svg v-if="showIcons" class="icon" width="52" height="50" viewBox="0 0 52 50" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M8.47382 15.8999H1.6948C0.762844 15.8999 0 16.6589 0 17.5946V48.1004C0 49.0357 0.759499 49.7949 1.6948 49.7949H8.47382C9.40913 49.7949 10.1686 49.0356 10.1686 48.1004V17.5946C10.1686 16.6589 9.40568 15.8999 8.47382 15.8999Z" fill="white" fill-opacity="1"/>
            <path d="M47.6798 15.8999C47.4068 15.8537 34.6272 15.8999 34.6272 15.8999L36.4122 11.0301C37.6439 7.66662 36.8464 2.53101 33.4289 0.705208C32.3162 0.110668 30.7615 -0.18792 29.5081 0.1276C28.7892 0.308476 28.1575 0.784392 27.7809 1.42202C27.3479 2.15536 27.3926 3.01138 27.2384 3.82452C26.8473 5.88695 25.8728 7.8479 24.3636 9.31975C21.7324 11.886 13.5586 19.2894 13.5586 19.2894V46.4056H41.8046C45.616 46.4078 48.1138 42.1516 46.234 38.827C48.4747 37.3918 49.2411 34.3689 47.9288 32.0479C50.1696 30.6128 50.9359 27.5899 49.6236 25.2689C53.4899 22.7927 52.1973 16.664 47.6798 15.8999Z" fill="white" fill-opacity="1"/>
          </svg>
        </button>
      </div>



    </div>
  </div>
</template>

<script>
export default {
  props: {
    data: {},
  },
  data() {
    return {
      liked: 0,
      disliked: 0,
      clicked: false,
      showPercents : false,
      showIcons : true,
    };
  },
  methods: {
    like() {
      if(this.clicked) return;
      this.disliked = this.data.dislikes;
      this.liked = this.data.likes;
      this.liked++;
      this.clicked = true;
      this.showPercents = true;
      this.showIcons = false;
      this.$refs['like'].classList.add('is_active');
      this.$refs['dislike'].classList.add('not_active');
      makeItRain(70, this.$refs.body);
      axios
        .post('/likeSinglePhoto', { serviceId: this.data.id })
          .then(res => {
          });
    },
    dislike() {
      if(this.clicked) return;
      this.disliked = this.data.dislikes;
      this.liked = this.data.likes;
      this.disliked++;
      this.clicked = true;
      this.showPercents = true;
      this.showIcons = false;
      this.$refs['dislike'].classList.add('is_active');
      this.$refs['like'].classList.add('not_active');
      makeItRain(70, this.$refs.body);
      axios
        .post('/dislikeSinglePhoto', { serviceId: this.data.id })
          .then(res => {
            // console.log(res);
          });
    },
  },
  computed: {
    likeHeight() {
      let sum = (this.disliked + this.liked);
      if(sum > 0) {
        var k = (this.disliked / sum) * 100;
      } else {
        var k = 100;
      }

      // console.log(k);
      return {text : k + '%',num : k};
    },
    dislikeHeight() {
      let sum = (this.disliked + this.liked);
      if(sum > 0) {
        var k = (this.liked / sum) * 100;
      } else {
        var k = 100;
      }

      // console.log(k);
      return {text : k + '%',num : k};
    },
  }
}
</script>

<style lang="scss" scoped>

.like-survey {
  border: 4px solid;
  border-image: linear-gradient(278.13deg, #87682C 0%, #FCD77E 100%);
  border-image-slice: 1;
  img {
    object-fit: cover;
    object-position: top;
    width: 100%;
    height: 630px;
  }
  .img-caption{
    font-style: italic;
    font-weight: 400;
    font-size: 14px;
    line-height: 17px;
    color: #333;
    text-align: center;
    padding: 5px 20px 0;
  }
  .body {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-bottom: 45px;
    padding-top: 20px;
    position: relative;
    .title {
      font-weight: bold;
      font-size: 36px;
      color: #333333;
      padding-bottom: 10px;
    }
    .buttons {
      display: flex;
      flex-direction: row;
      button {
        border: 0;
        background: transparent;
        position: relative;
        margin: 0 10px;
        width: 150px;
        height: 142px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: .3s;
        &.is_active {
          transform: scale(1.2);
        }
        &.not_active {
          transform: scale(0.8);
        }
        .percent {
          position: absolute;
          top: 50%;
          left: 50%;
          color: #fff;
          z-index: 2;
          transform: translateY(-50%) translateX(-50%);
          font-weight: bold;
          font-size: 24px;
        }
        .gray-star {
          position: absolute;
          top: 0;
          overflow: hidden;
          transition: height 0.3s ease;
        }
        .yellow-star {
          position: absolute;
          top: 0;
          overflow: hidden;
        }
        .gray-star,
        .yellow-star {
          svg {
            width: 150px;
            height: 142px;
          }
        }


      }
      .like {
        .icon {

        }
      }
      .dislike {
        .icon {
          transform: translateY(10px);
        }
      }
      .icon {
        position: relative;
      }
    }
  }





}
@media(max-width:768px) {
  .like-survey {
    img {
      height:300px;
    }
    .body {
      .title {
        line-height: 24px;
        font-size: 24px;
        padding-bottom: 16px;
        text-align: center;
      }
    }
  }
}
@media(max-width:550px) {
  .like-survey {
    .body {
      .buttons {
        button {
          width:120px;
          .gray-star {
            svg {
              width: 120px;
            }
          }
          .yellow-star {
            svg {
              width: 120px;
            }
          }

        }
        .icon {
          width: 36px;
        }
      }
    }
  }
}

</style>
