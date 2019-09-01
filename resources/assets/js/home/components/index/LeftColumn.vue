<template>
  <div class="left-column posts-column" v-if="isNotEmptyOnDesktop">
    <article v-if="!!firstPost" v-in-viewport.once class="first" >
      <router-link :to="'/post/' + firstPost.id">
        <div class="overlay"></div>
        <img :src="firstPost.img" alt="">
        <type-writer class="h2" :text="firstPost.title"></type-writer>
        <p>
          <span class="author">{{ firstPost.author }}</span>
          <span class="post-date">{{ new Date(firstPost.time * 1000) | formatDate }}</span>
        </p>
      </router-link>
    </article>
    <surveys v-if="$env.MOBILE" is_first />
    <article v-if="!!secondPost" v-in-viewport.once class="second">
      <router-link :to="'/post/' + secondPost.id">
        <div class="overlay"></div>
        <img :src="secondPost.img">
        <type-writer class="h2" :text="secondPost.title"></type-writer>
        <p>
          <span class="author">{{ secondPost.author }}</span>
          <span class="post-date">{{ new Date(secondPost.time * 1000) | formatDate }}</span>
        </p>
      </router-link>
    </article>
  </div>
</template>

<script>
import TypeWriter from './../common/TypeWriter.vue';
import Surveys from './Surveys';

export default {
  components: {
    TypeWriter,
    Surveys,
  },
  computed: {
    firstPost() {
      return this.$store.getters['main-page/selectedPosts'][0];
    },
    secondPost() {
      return this.$store.getters['main-page/selectedPosts'][1];
    },
    isNotEmptyOnDesktop(){
      if(this.$env.MOBILE)
        return true;
      else{
        return (this.firstPost || this.secondPost);
      }
    }
  }
}
</script>

<style lang="scss" scoped>
.first{
  margin-top: 15px;
}
.left-column {
  flex-basis:50%;
  padding-right:8px;
}
.posts-column {
  width:100%;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}
.posts-column article {
  width:100%;
  position: relative;
  margin-bottom: 16px;
  height:500px;
  overflow: hidden;
  opacity: 0;
  transition: transform 1s ease, opacity 1s ease;
  transform: translateX(-100px);
}
.posts-column article.in-viewport {
  transform: translateX(0);
  opacity: 1;
}
.posts-column article:nth-child(1) a {
  box-sizing: border-box;
  border: 6px solid transparent;
  position: relative;
  z-index:5;
}
.posts-column article:nth-child(1):after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  background: linear-gradient(278.13deg, #87682C 1%, #FCD77E 100%);
  z-index: -1;
  animation: animatedgradient 3s ease alternate infinite;
  background-size: 300% 300%;
}
.posts-column article a {
  justify-content: flex-end;
  width:100%;
  height:100%;
  display: flex;
  flex-direction: column;
  color:#fff;
  padding:0 24px 16px;
  color:#fff;
  transition: .2s;
  text-decoration: none;
  overflow:hidden;
}

.posts-column article img {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  width:100%;
  height: 100%;
  pointer-events: none;
  z-index:-2;
  object-fit: cover;
  object-position: top;
  transition:.3s;
}
.posts-column article .overlay {
  position: absolute;
  z-index: -1;
  top: 0;
  right: 0;
  left: 0;
  bottom: 0;
  width: 100%;
  height: 100%;
  pointer-events: none;
  opacity: .5;
  transition: .3s;
  /* background: linear-gradient(180deg, #7EFFB7 0%, #0089FF 100%); */
}
.posts-column article:nth-child(2) .overlay  {
  background: linear-gradient(60deg, #f79533, #f37055, #ef4e7b, #a166ab, #5073b8, #1098ad, #07b39b, #6fba82);
  animation: animatedgradient 3s ease alternate infinite;
  background-size: 300% 300%;
  opacity: 0.2;
}
.posts-column article:hover img {
  transform:scale(1.1);
}
.posts-column article:nth-child(1):hover a {
  border-width:12px;
}
.posts-column article:hover .overlay {
  background: rgba(0,0,0,1);
}
.posts-column article .h2 {
  font-family: 'Assistant', sans-serif;
  font-weight: 700;
  font-size: 36px;
  line-height: 36px;
}
.posts-column article p {
  /* display: flex;
  flex-direction: row; */
  font-size: 20px;
  font-weight: 400;
  margin-bottom: 0;
}
.posts-column article p .post-date {
  border-right:1px solid #fff;
  padding-right: 6px;
  margin-right: 6px;
}

/* .posts-column article:first-child::before {
  pointer-events: none;
  content: "";
  position: absolute;
  top: -110%;
  left: -210%;
  width: 200%;
  height: 200%;
  opacity: 0;
  transform: rotate(30deg);
  background: rgba(255, 255, 255, 0.13);
  background: linear-gradient(
    to right,
    rgba(255, 255, 255, 0.13) 0%,
    rgba(255, 255, 255, 0.13) 77%,
    rgba(255, 255, 255, 0.5) 92%,
    rgba(255, 255, 255, 0.0) 100%
  );
} */
/* .posts-column article:first-child::before {
  opacity: 1;
  top: -30%;
  left: -30%;
  transition-property: left, top, opacity;
  transition-duration: 0.7s, 0.7s, 0.15s;
  transition-timing-function: ease;
  z-index:20;
} */
.posts-column article:first-child::before {
  pointer-events: none;
  animation: shine 5s ease-in-out  infinite;
  animation-fill-mode: forwards;
  content: "";
  position: absolute;
  top: -110%;
  left: -210%;
  width: 200%;
  height: 200%;
  opacity: 0;
  transform: rotate(30deg);
  background: rgba(255, 255, 255, 0.13);
  background: linear-gradient(
    to right,
    rgba(255, 255, 255, 0.13) 0%,
    rgba(255, 255, 255, 0.13) 77%,
    rgba(255, 255, 255, 0.5) 92%,
    rgba(255, 255, 255, 0.0) 100%
  );
  z-index:6;
}
@keyframes shine{
  10% {
    opacity: 1;
    top: -30%;
    left: -30%;
    transition-property: left, top, opacity;
    transition-duration: 0.7s, 0.7s, 0.15s;
    transition-timing-function: ease;

  }
  100% {
    opacity: 0;
    top: -30%;
    left: -30%;
    transition-property: left, top, opacity;

  }
}
@media (max-width:768px) {
  .posts-column {
    padding-right: 0;
  }
  .left-column {
    order:1;
    padding-left: 8px;
    padding-right: 8px;
  }
  .posts-column article {
    height:350px;
  }
  .posts-column article.second {
    margin-top: 8px;
  }
  .posts-column article:nth-child(3) .overlay  {
    background: linear-gradient(60deg, #f79533, #f37055, #ef4e7b, #a166ab, #5073b8, #1098ad, #07b39b, #6fba82);
    animation: animatedgradient 3s ease alternate infinite;
    background-size: 300% 300%;
    opacity: 0.2;
  }
  /* .posts-column article:nth-child(1) {
    height:250px;
  } */
}
@media (max-width:550px) {
  .posts-column article p {
    font-size: 16px;
    line-height: 16px;
  }
  .posts-column article {
    margin-bottom: 8px;
  }
  .posts-column article:nth-child(2) {
    margin-bottom: 0;
    margin-top: 8px;
  }
  .posts-column article .h2 {
    font-size: 20px;
    line-height: 20px;
  }
}
@keyframes animatedgradient {
	0% {
		background-position: 0% 50%;
	}
	50% {
		background-position: 100% 50%;
	}
	100% {
		background-position: 0% 50%;
	}
}
</style>
