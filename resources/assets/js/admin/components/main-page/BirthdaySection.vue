<template>
    <div class="wrapper birthday-section">
        <image-input :value.sync="image"></image-input>
        <textarea v-model="text" name="description" class="text theme-textarea" placeholder="טקסט חופשי"></textarea>
        <div class="btn-wrap">
            <button @click="save" class="theme-btn theme-btn-red big-btn">פרסם</button>
        </div>
    </div>
</template>

<script>
import ImageInput from './../common/ImageInput.vue';
export default {
    data(){
        return {
            image: '',
            text: ''
        }
    },
    components: {
        ImageInput
    },
    methods: {
      save() {
        var data = new FormData();
        data.append('image', this.image);
        data.append('text', this.text);
        axios.post('/createHappyBirthday', data, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        }).then(res => {
          alert('נשמר!');
        });
      }
    },
    created(){
      axios
        .post('/getMainBday')
          .then(res => {
            this.text = res.data.text;
            this.image = res.data.img;
          });
    }
}
</script>

<style lang="scss" scoped>
    @import "~@/vars.scss";
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
</style>
