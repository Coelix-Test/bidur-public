<template>
  <div class="instagram">
    <h2 class="heading">Instagram Post</h2>
    <div class="plate shadow-section">
      <image-input :value.sync="image"></image-input>

      <!-- <div class="form">
        <div class="input-section">
          <div class="heading">קישור לאינסטגרם</div>
          <input v-model="link" class="theme-textarea" type="text">
        </div>
      </div> -->
      <input v-model="link" class="theme-textarea" type="hidden">


      <div class="btn-wrap">
        <button @click="save" class="theme-btn theme-btn-red big-btn">פרסם</button>
      </div>
    </div>
  </div>
</template>

<script>
import ImageInput from './../common/ImageInput.vue';
export default {
  data(){
    return {
      image: '',
      link: 'https://www.instagram.com/israel_bidur/',
    }
  },
  components: {
    ImageInput
  },
  methods: {
    save() {
      var data = new FormData();
      data.append('imageUrl', this.image);
      data.append('linkToInsta', this.link);

      axios.post('/api/createInsta', data, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }).then(res => {
        alert('נשמר!');
      });
    }
  },
  created() {
    axios
      .post('/api/getMainInsta')
        .then(res => {
          this.image = res.data.img;
        });
  }
}
</script>

<style lang="scss" scoped>

@import "~@/vars.scss";

.instagram {
  padding-top: 20px;
  width: 49%;
  display: flex;
  flex-direction: column;
  align-items: stretch;
  padding-bottom: 40px;
  .birthday-section{
    padding-bottom: 35px;
  }
  .text{
    font-size: $fzTitle;
    font-weight: 700;
    width: 80%;
    margin-right: auto;
    margin-left: auto;
    margin-top: 30px;
    margin-bottom: 30px;
  }
  .btn-wrap{
    display: flex;
    justify-content: center;
    padding-bottom: 40px;
    margin-top: 30px;
  }
  .form {
    padding: 50px 70px;
    input {
      width: 100%;
    }
  }
}
</style>
