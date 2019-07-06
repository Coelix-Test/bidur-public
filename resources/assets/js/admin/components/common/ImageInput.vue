<template>
    <div class="wrapper">

        <label v-if="value === ''">
            <img src="/img/icons/edit-post-upload-image.svg" alt="">
            <div class="theme-btn theme-btn-red upload-btn">Upload</div>
            <input type="file" accept="image/*" @change="onFileChange($event.target.files[0])">
        </label>
        <img v-else :src="image" class="image" alt="">
    </div>
</template>

<script>
export default {
    data: function(){
        return {
            image: '',
        }
    },
    props: {
        value : {
            type: [ String, File ],
            default: function(){
                return '';
            }
        }
    },
    methods: {
        onFileChange(file){
            let reader = new FileReader();
            reader.addEventListener('load', () => {
                this.image = reader.result;
            }, false);
            reader.readAsDataURL(file);
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
            margin-bottom: 0;
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
            font-weight: 600;
            margin-top: 20px;
            cursor: pointer;
        }
        .image{
            width: 100%;
            height: auto;
        }
    }
</style>
