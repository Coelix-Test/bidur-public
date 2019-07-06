<template>
  <div class="wrapper instagram shadow-section">

  </div>
</template>

<script>
import PostSelection from './../posts/PostSelection.vue';
import ImageInput from './../common/ImageInput.vue';
import ImageInput from './../common/ImageInput.vue';

export default {
  data(){
    return {
      image: '',
      link: '',
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

      axios.post('/createInsta', data, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }).then(res => {
        console.log(res);
      });
    }
  }
}
</script>

<style lang="scss" scoped>

@import "~@/vars.scss";

.instagram {
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
  }
  .form {
    padding: 50px 70px;
    input {
      width: 100%;
    }
  }
}
</style>
