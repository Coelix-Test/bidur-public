<template>
  <main>
    <div class="">
      <button
        type="button"
        v-for="item in hashtags"
        @click="getSliders(item)"
        :disabled="hashtag && item.id == hashtag.id"
      >{{ item.name }}</button>
    </div>

    <template v-if="data.length">
      <h2>Sliders {{ hashtag.name }}</h2>
      <div class="items">
        <div v-for="item in data" class="item">
          <img :src="item.image">
          <button
            type="button"
            @click="remove(item)"
          >remove</button>
        </div>
      </div>
    </template>

    <div class="new">
      <image-input
        @update:value="updateImage"
      />
      <button
        @click="create"
      >add</button>
    </div>
  </main>
</template>

<script>
import ImageInput from './../components/common/ImageInput.vue';

export default {
  data() {
    return {
      data: [],
      hashtags: [],
      hashtag: null,
      image: null,
    };
  },
  components: {
    ImageInput,
  },
  methods: {
    updateImage(file) {
      this.image = file;
    },
    sync() {
      return axios.post('/api/getAllHashtags').then(res => {
        this.hashtags = res.data;
      });
    },
    updateSliders() {
      return axios
        .get('/api/insta-slider/hashtag/' + this.hashtag.id)
        .then(res => {
          this.data = res.data;
        });
    },
    getSliders(item) {
      this.hashtag = item;
      return this.updateSliders();
    },
    remove(item) {
      return axios.delete('/api/insta-slider/' + item.id).then(res => {
        this.updateSliders();
        return res;
      });
    },
    create() {
      let data = new FormData();
      data.append('file', this.image);
      data.append('hashtag_id', this.hashtag.id);

      return axios.post('/api/insta-slider', data).then(res => {
        this.updateSliders();
        return res;
      });
    }
  },
  created() {
    this.sync();
  }
}
</script>

<style lang="scss" scoped>

main {

  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;

  .items {
    display: flex;
    flex-direction: row;
    align-items: flex-start;
    justify-content: space-between;
    flex-wrap: wrap;

    width: 500px;
    max-width: 100%;

    .item {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      max-width: 150px;
      padding: 20px;

      img {
        width: 100%;
      }
    }
  }

  .new {
    padding: 50px 0;

    display: flex;
    flex-direction: column;
    align-items: stretch;
    justify-content: center;

    width: 500px;
    max-width: 100%;
  }
}

</style>
