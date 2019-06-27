<template>
    <div class="wrapper">

        <label v-if="value === ''">
            <img src="/img/icons/edit-post-upload-image.svg" alt="">
            <div class="theme-btn theme-btn-red upload-btn">Upload</div>
            <input type="file" accept="image/*" @change="onFileChange($event.target.files[0])">
        </label>
        <img v-else :src="image" class="image" alt="">
        <input type="text" name="description" class="theme-input-text"
            placeholder="Add description"
            @input="$emit('update:description', $event.target.value)"/>

        <div class="delete-self" @click="$emit('deleteSection', index)"></div>
    </div>
</template>

<script>
export default {
    data: function(){
        return {
            image: ''
        }
    },
    props: {
        value : {
            type: [String, File],
            default: function(){
                return '';
            }
        },
        index: {
            type: Number
        },
        description: {
            type: String,
            default: ''
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

<style lang="scss">
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
            margin-top: 20px;
            cursor: pointer;
        }
        .image{
            width: 100%;
            height: auto;
        }
        input[name="description"]{
            font-size: 18px;
            width: 50%;
            margin-top: 15px;
            &::placeholder{
                font-style: italic;
                color: $gray;
            }
        }

        .delete-self{
            cursor: pointer;
            position: absolute;
            left: 20px;
            bottom: 10px;
            width: 30px;
            height: 30px;
            background: url('/img/icons/trash.svg') no-repeat center;
            -webkit-background-size: 20px 26px;
            background-size: 20px 26px;
        }
    }
</style>
