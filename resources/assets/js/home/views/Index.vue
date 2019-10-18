<template>
  <div class="home">

    <template v-if="$store.getters['main-page/loaded']">
      <top-section v-if="!$store.getters['main-page/isSunday']"/>
      <Adsense
        v-if="!$env.MOBILE"
        data-ad-client="ca-pub-6511052822397382"
        data-ad-slot="6776876742"
        data-ad-format="fluid"
        data-ad-layout-key="-fb+5w+4e-db+86"
      />
      <right-column/>
      <left-column/>
      <right-column-bot />
      <left-column-bot />
      <top-section v-if="$store.getters['main-page/isSunday']"/>
    </template>

    <recent-posts-mobile v-if="$env.MOBILE"/>
  </div>
</template>

<script>
import RightColumn from './../components/index/RightColumn';
import LeftColumn from './../components/index/LeftColumn';
import LeftColumnBot from './../components/index/LeftColumnBot';
import RightColumnBot from './../components/index/RightColumnBot';
import TopSection from './../components/index/TopSection';
import RecentPostsMobile from './../components/index/RecentPostsMobile';

export default {
  data() {
    return  {

    }
  },
  methods: {

  },
  created() {
    if(!this.$store.getters['main-page/loaded']) {
      this.$store.dispatch('main-page/updateData');
    }
  },
  components: {
    RightColumn,
    LeftColumn,
    LeftColumnBot,
    RightColumnBot,
    RecentPostsMobile,
    TopSection,
  },
}
</script>

<style lang="scss" scoped>
.home {
  max-width: 1440px;
  margin:16px auto 32px;
  padding:0 24px 24px;
  display: flex;
  flex-direction: row;
  flex-wrap:wrap;
  align-items: flex-start;
  overflow:hidden;
}
.adswrapper {
  width: 100%;
}
@media (max-width:768px) {
  .home {
    flex-direction:column;
    padding: 0 0 48px;
    margin-bottom: 0;
  }

}
@media(max-width: 555px){
  .home{
    padding-bottom: 0;
  }
}
</style>


<style>
.vue-poll .qst {
  padding:0 12px;
  font-size: 32px;
  line-height: 32px;
  padding-top: 32px;
  font-weight: 600;
  color:#fff;
  margin:0;
  text-align: center;
  background: linear-gradient(270deg, #E4A913 0%, #EED074 99.53%);
  padding-bottom: 32px;
}
.vue-poll .ans-cnt {
  margin:20px 12px;

}
.vue-poll .ans-cnt .ans-no-vote {
  position: relative;
  border-radius: 0;
  border-color: transparent;
  border-width:0;
  padding:12px 24px 12px 12px;
  text-align: right;
  box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.15);
  border-radius: 10px;
  overflow: hidden;
}
.vue-poll .votes {
  padding:0 12px;
}
/* .vue-poll .ans-cnt .ans-no-vote:before {
  content:'';
  position: absolute;
  top:0;
  right:0;
  width:10px;
  height:100%;
  background: linear-gradient(360deg, #403EC0 0%, #3BB9FE 85.58%, #00F0FF 107.76%);
} */
.vue-poll .ans-cnt .ans-no-vote:hover {
  /* background-color: #0E0E0E; */
}
.vue-poll .ans-cnt .ans-no-vote .txt {
  color:#0E0E0E;
}
.vue-poll .ans-cnt .ans-no-vote:hover .txt {
  /* color:#fff; */
}

.vue-poll .ans-cnt .ans .bg {
  right:0;
  left:unset;
  transition: 1s;
  /* clip-path: polygon(25px 0%, 100% 1%, 100% 100%, 25px 100%, 0% 50%); */
}
.vue-poll .ans-cnt .ans-voted {
  display: flex;
  flex-direction: row-reverse;
  justify-content: space-between;
  box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.15);
  padding:12px 12px;
}
.vue-poll .ans-cnt .ans {
  margin-top: 16px;
}
.vue-poll .ans-cnt .ans-voted .percent {
  margin:0;
  text-align: left;
}
.vue-poll .ans-cnt .ans .bg {
  opacity: 1;
  background: #F2F2F2;
}
.vue-poll .ans-cnt .ans .selected + .bg {
  background: linear-gradient(296.58deg, #EDB72A 6.16%, #FDD55D 99.09%);
}
/* .vue-poll .ans-cnt .ans:nth-child(1) .bg {
  background: linear-gradient(90.01deg, #F6AB62 0.91%, #B63E8E 40.51%, #3F5EFB 100%);
}
.vue-poll .ans-cnt .ans:nth-child(2) .bg {
  background: linear-gradient(270deg, #403EC0 2.58%, #3BB9FE 78.1%, #00F0FF 97.67%);
}
.vue-poll .ans-cnt .ans:nth-child(3) .bg {
  background: linear-gradient(270deg, #FFFB95 0.51%, #FF004D 99.32%);
}
.vue-poll .ans-cnt .ans:nth-child(4) .bg {
  background: linear-gradient(270deg, #403EC0 2.58%, #3BB9FE 78.1%, #00F0FF 97.67%);
} */
.vue-poll .ans-cnt .ans-voted.selected .txt:after {
  content:'\2714';
  margin-right: 10px;
}
@media (max-width:768px) {
  .vue-poll .ans-cnt .ans-voted .percent, .vue-poll .ans-cnt .ans-voted .txt {
    font-size: 16px;
  }
  .vue-poll .qst {
    font-size: 24px;
    line-height: 24px;
    padding:8px 12px;
    text-align: center;
  }
}

</style>
