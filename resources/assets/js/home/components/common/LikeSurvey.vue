<template>
  <div class="like-survey">
    <img :src="data.imgUrl">
    <div class="body" ref="body">
      <div class="title">
        {{ data.description }}
      </div>
      <div class="buttons">
        <button @click="dislike" type="button" class="dislike">
          <div class="yellow-star">
            <svg viewBox="0 0 151 143" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M75.7766 0L100.781 44.3616L150.698 54.4334L116.234 91.9222L122.08 142.509L75.7766 121.316L29.4728 142.509L35.3192 91.9222L0.855469 54.4334L50.7726 44.3616L75.7766 0Z" fill="#F2C94C"/>
            </svg>
          </div>
          <div class="gray-star" :style="{ height: dislikeHeight }">
            <svg viewBox="0 0 151 143" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M75.7766 0L100.781 44.3616L150.698 54.4334L116.234 91.9222L122.08 142.509L75.7766 121.316L29.4728 142.509L35.3192 91.9222L0.855469 54.4334L50.7726 44.3616L75.7766 0Z" fill="#E0E0E0"/>
            </svg>
          </div>

          <svg class="icon" width="52" height="50" viewBox="0 0 52 50" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M8.47382 33.895H1.6948C0.762844 33.895 0 33.136 0 32.2003V1.69455C0 0.759242 0.759499 4.67107e-05 1.6948 4.67107e-05H8.47382C9.40913 4.67107e-05 10.1686 0.759344 10.1686 1.69455V32.2003C10.1686 33.136 9.40568 33.895 8.47382 33.895Z" fill="white"/>
            <path d="M47.6798 33.895C47.4068 33.9412 34.6272 33.895 34.6272 33.895L36.4122 38.7649C37.6439 42.1283 36.8464 47.2639 33.4289 49.0897C32.3162 49.6843 30.7615 49.9828 29.5081 49.6673C28.7892 49.4864 28.1575 49.0105 27.7809 48.3729C27.3479 47.6396 27.3926 46.7835 27.2384 45.9704C26.8473 43.908 25.8728 41.947 24.3636 40.4752C21.7324 37.9089 13.5586 30.5056 13.5586 30.5056V3.38931H41.8046C45.616 3.38708 48.1138 7.64335 46.234 10.968C48.4747 12.4031 49.2411 15.426 47.9288 17.747C50.1696 19.1821 50.9359 22.205 49.6236 24.526C53.4899 27.0022 52.1973 33.1309 47.6798 33.895Z" fill="white"/>
          </svg>
        </button>
        <button @click="like" type="button" class="like">
          <div class="yellow-star">
            <svg viewBox="0 0 151 143" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M75.7766 0L100.781 44.3616L150.698 54.4334L116.234 91.9222L122.08 142.509L75.7766 121.316L29.4728 142.509L35.3192 91.9222L0.855469 54.4334L50.7726 44.3616L75.7766 0Z" fill="#F2C94C"/>
            </svg>
          </div>
          <div class="gray-star" :style="{ height: likeHeight }">
            <svg viewBox="0 0 151 143" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M75.7766 0L100.781 44.3616L150.698 54.4334L116.234 91.9222L122.08 142.509L75.7766 121.316L29.4728 142.509L35.3192 91.9222L0.855469 54.4334L50.7726 44.3616L75.7766 0Z" fill="#E0E0E0"/>
            </svg>
          </div>
          <svg class="icon" width="52" height="50" viewBox="0 0 52 50" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M8.47382 15.8999H1.6948C0.762844 15.8999 0 16.6589 0 17.5946V48.1004C0 49.0357 0.759499 49.7949 1.6948 49.7949H8.47382C9.40913 49.7949 10.1686 49.0356 10.1686 48.1004V17.5946C10.1686 16.6589 9.40568 15.8999 8.47382 15.8999Z" fill="white"/>
            <path d="M47.6798 15.8999C47.4068 15.8537 34.6272 15.8999 34.6272 15.8999L36.4122 11.0301C37.6439 7.66662 36.8464 2.53101 33.4289 0.705208C32.3162 0.110668 30.7615 -0.18792 29.5081 0.1276C28.7892 0.308476 28.1575 0.784392 27.7809 1.42202C27.3479 2.15536 27.3926 3.01138 27.2384 3.82452C26.8473 5.88695 25.8728 7.8479 24.3636 9.31975C21.7324 11.886 13.5586 19.2894 13.5586 19.2894V46.4056H41.8046C45.616 46.4078 48.1138 42.1516 46.234 38.827C48.4747 37.3918 49.2411 34.3689 47.9288 32.0479C50.1696 30.6128 50.9359 27.5899 49.6236 25.2689C53.4899 22.7927 52.1973 16.664 47.6798 15.8999Z" fill="white"/>
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
    };
  },
  methods: {
    like() {
      console.log(12312312);
      if(this.clicked) return;
      this.disliked = this.data.dislikes;
      this.liked = this.data.likes;
      this.liked++;
      this.clicked = true;
      makeItRain(70, this.$refs.body);
      axios
        .post('/likeSinglePhoto', { serviceId: this.data.id })
          .then(res => {
            console.log(res);
          });
    },
    dislike() {
      if(this.clicked) return;
      this.disliked = this.data.dislikes;
      this.liked = this.data.likes;
      this.disliked++;
      this.clicked = true;
      makeItRain(70, this.$refs.body);
      axios
        .post('/dislikeSinglePhoto', { serviceId: this.data.id })
          .then(res => {
            console.log(res);
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
      return k + '%';
    },
    dislikeHeight() {
      let sum = (this.disliked + this.liked);
      if(sum > 0) {
        var k = (this.liked / sum) * 100;
      } else {
        var k = 100;
      }

      // console.log(k);
      return k + '%';
    },
  }
}
</script>

<style lang="scss" scoped>

.like-survey {

  img {
    object-fit: cover;
    width: 100%;
    height: 630px;
  }
  .body {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-bottom: 45px;
    padding-top: 20px;
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
  }
}

</style>
