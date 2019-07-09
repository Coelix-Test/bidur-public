<template>
    <div class="wrapper imagetext-component">
        <div class="imagetext-wrap" :class="directionClass">
            <div class="col-text">
                <post-title v-if="title !== null"
                    class="title-block"
                    :index="index"
                    :value="title"
                    @update:value="updateTitle"
                    @deleteSection="deleteTitle">
                </post-title>
                <text-editor class="text-editor" :value="text" @update:value="updateText"></text-editor>
            </div>
            <div class="col-img">
                <image-input :value="image" @update:value="updateImage"></image-input>
            </div>
        </div>
        <div class="imagetext-actions">
            <div class="delete-self" @click="$emit('deleteSection', index)"></div>
            <div class="change-image-position" @click="updateImagePosition"></div>
        </div>
    </div>
</template>

<script>
import TextEditor from './../common/TextEditor.vue';
import ImageInput from './../common/ImageInput.vue';
import PostTitle from './PostTitle.vue';

export default {
    data: function(){
        return {

        };
    },
    components: {
        TextEditor,
        ImageInput,
        PostTitle
    },
    props: {
        image: {
            type: [String, File],
            default: function(){
                return '';
            }
        },
        title: {
            type: String,
            default: ''
        },
        text: {
            type: String,
            default: ''
        },
        imagePosition: {
            type: String,
            default: 'left'
        },
        index: {
            type: Number
        }
    },
    methods: {
        updateTitle(title){
            this.$emit('update:title', title);
        },
        deleteTitle(){
            this.$emit('update:title', null);
        },
        updateImage(image){
            this.$emit('update:image', image);
        },
        updateText(text){
            this.$emit('update:text', text);
        },
        updateImagePosition(){
            let newPosition = 'left';
            if(this.imagePosition === 'left'){
                newPosition = 'right';
            }
            this.$emit('update:imagePosition', newPosition);
        }
    },
    computed: {
        directionClass: function(){
            return {
                'flex-row-reverse' : this.imagePosition === 'right'
            }
        }
    }
}
</script>

<style lang="scss" scoped>
    .imagetext-wrap{
        display: -webkit-flex;
        display: -ms-flex;
        display: flex;
        padding-top: 25px;
        padding-right: 14px;
        &.flex-row-reverse{
            .col-img{
                margin-right: 0;
                margin-left: 35px;
            }
        }
    }
    .col-text{
        display: -webkit-flex;
        display: -ms-flex;
        display: flex;
        -webkit-flex-direction: column;
        -ms-flex-direction: column;
        flex-direction: column;
        flex-grow: 1;
    }
    .col-img{
        width: 40%;
        margin-right: 35px;
    }
    .title-block{
        margin-bottom: 10px;
    }
    .text-editor{
        flex-grow: 1;
        .tox-tinymce{
            height: 100%!important;
        }
    }

    .imagetext-actions{
        height: 60px;
        background-color: #F5F5F5;
        margin-top: 25px;
        display: -webkit-flex;
        display: -ms-flex;
        display: flex;
        -ms-align-items: center;
        align-items: center;
        justify-content: center;
        position: relative;
    }
    .delete-self{
        cursor: pointer;
        position: absolute;
        left: 20px;
        bottom: 15px;
        width: 30px;
        height: 30px;
        background: url('/img/icons/trash.svg') no-repeat center;
        -webkit-background-size: 20px 26px;
        background-size: 20px 26px;
    }
    .change-image-position{
        width: 110px;
        height: 38px;
        background: url('/img/icons/edit-post-change-image-position.svg') no-repeat center;
        -webkit-background-size: cover;
        background-size: cover;
        cursor: pointer;
    }
</style>
<style lang="scss">
    //not scoped scss
    .text-editor .tox-tinymce{
        height: 100%!important;
        min-height: 200px;
    }
    .col-img .wrapper{
        label{
            height: 560px;
        }
        .upload-btn{
            width: 250px;
            height: 50px;
        }
    }
</style>
