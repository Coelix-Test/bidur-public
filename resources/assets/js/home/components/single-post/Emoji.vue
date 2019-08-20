<template>
  <div v-if="processed" class="emoji">
    <!-- <button @click="select" class="item" id="dislike">
      <img src="/img/emoji-7.svg">
      <div class="num">{{ emojis.dislike }}</div>
    </button> -->

    <!-- <button @click="select" class="item" id="like" >
      <img src="/img/emoji-6.svg">
      <div class="num">{{ emojis.like }}</div>
    </button> -->

    <!-- <button @click="select" class="item" id="angry">
      <img src="/img/emoji-5.svg">
      <div class="num">{{ emojis.angry }}</div>
    </button> -->

    <button @click="select" class="item" id="cry">
      <img src="/img/emoji-4.svg">
      <span>מעפן</span>
      <div class="num">{{ processed.cry }}</div>
    </button>

    <button @click="select" class="item" id="wow" >
      <img src="/img/emoji-3.svg">
      <span>נחמד</span>
      <div class="num">{{ processed.wow }}</div>
    </button>

    <!-- <button @click="select" class="item" id="laugh">
      <img src="/img/emoji-2.svg">
      <div class="num">{{ emojis.laugh }}</div>
    </button> -->

    <button @click="select" class="item" id="love">
      <img src="/img/emoji-1.svg">
      <span>עפתי</span>
      <div class="num">{{ processed.love }}</div>
    </button>
  </div>
</template>

<script>
export default {
  props : {
    postId : {}
  },
  data() {
    return {
      emojis : null,
      preventClick : false,
    }
  },
  watch : {
    postId : function() {
      this.preventClick = false;
      this.sync(this.postId);

      var buttons = document.querySelectorAll('.item');
      for (let i = 0; i < buttons.length; i++) {
        buttons[i].classList.remove('is_active');
      }
    }
  },
  created() {
    this.preventClick = false;
    this.sync(this.postId);
  },
  mounted() {

  },
  methods: {
    select(item) {

      if(this.preventClick == false) {
        this.preventClick = true;
        let emote = item.target.id
        axios
          .post('/api/addReaction',{ reaction : emote , postId : this.postId })
          .then(response => {
            axios
              .post('/api/getReaction',{ postId : this.postId})
              .then(response => {
                this.emojis = response.data;
                item.target.classList.add('is_active');
              });
          });
      }

    },
    sync(postId) {
      axios
        .post('/api/getReaction', { postId: postId })
        .then(res => {
          this.emojis = res.data;
        });
    }
  },
  computed: {
    processed() {
      let emo = { ...this.emojis };
      for (let i in emo) {
        emo[i] *= 2;
      }
      return emo;
    }
  }
}
</script>

<style lang="scss" scoped>

.emoji {
  width: 700px;
  height: 120px;
  display: flex;
  flex-direction: row;
  align-items: stretch;
  justify-content: space-between;
  background: #FFFFFF;
  // box-shadow: 0px -3px 20px rgba(0, 0, 0, 0.1);
  border-radius: 3px;
  padding: 15px 40px 15px 40px;
  position: relative;
  margin-left: auto;
  margin-right: auto;
  &::before {
    content: '';
    left: 50%;
    transform: translateX(-50%);
    bottom: 100%;
    width: 0;
    height: 0;
    border-left: 15px solid transparent;
    border-right: 15px solid transparent;
    border-bottom: 15px solid #fff;
    position: absolute;
  }
  .item {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    background: transparent;
    border: 0;
    transition: .3s;
    img {
      height: 60px;
      pointer-events: none;
    }
    .num {
      font-weight: bold;
      font-size: 24px;
      line-height: 100%;
      pointer-events: none;
    }
    &.is_active {
      transform: scale(1.2);
      .num {
        // background: linear-gradient(90deg, #F6AB62 0.91%, #B63E8E 40.51%, #3F5EFB 100%);
        background: #F2C94C;
        background-clip: text;
        -webkit-text-fill-color: transparent;
      }
      span {
        font-weight: 700;
        background: #F2C94C;
        background-clip: text;
        -webkit-text-fill-color: transparent;
      }
    }
    &:hover {
      transform: scale(1.2);
    }
  }
}
@media (max-width:768px) {
  .emoji {
    width:100%;
    flex-wrap:wrap;
    height:auto;
    padding:15px 8px;
      .item {
        margin-bottom: 8px;
      }
  }
}
</style>
