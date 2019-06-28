<template>
    <div class="wrapper">

        <label v-if="value === ''">
            <img class="video-ico" src="/img/icons/edit-post-video2.svg" alt="">
            <div class="theme-btn theme-btn-red upload-btn">Upload</div>
            <input type="file" accept="video/*" @change="onFileChange($event.target.files[0])">
        </label>
        <video  v-else :src="src" class="image"></video>
    </div>
</template>

<script>
export default {
    data: function(){
        return {
            src: ''
        }
    },
    props: {
        value : {
            type: [String, File],
            default: function(){
                return '';
            }
        }
    },
    methods: {
        onFileChange(file){
            // let reader = new FileReader();
            // reader.addEventListener('load', () => {
            //     this.src = reader.result;
            // }, false);
            // reader.readAsDataURL(file);
            this.src = URL.createObjectURL(file);
            this.$emit('update:value', file);
        }
    }
}
</script>

<style lang="scss" scoped>
    @import "~@/vars.scss";

    .wrapper{
        position: relative;
        input[type="file"]{
            display: none;
        }
        label{
            width: 100%;
            height: 400px;
            background-color: #E0E0E0;
            display: -webkit-flex;
            display: -ms-flex;
            display: flex;
            justify-content: center;
            -ms-align-items: center;
            align-items: center;
            text-align: center;
            -webkit-flex-direction: column;
            -ms-flex-direction: column;
            flex-direction: column;
        }
        .upload-btn{
            width: 360px;
            height: 79px;
            border-radius: 10px;
            justify-content: center;
            font-size: 24px;
            margin-top: 40px;
            cursor: pointer;
        }
        .image{
            width: 100%;
            height: auto;
        }
        .video-ico{
            width: 160px;
            height: auto;
        }
    }
</style>
