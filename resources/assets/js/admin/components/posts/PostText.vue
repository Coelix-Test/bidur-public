<template>
    <div class="wrapper">
        <editor
            api-key="tl9l4lbf7vc1pkaj7rcvtgcbsyymlwho2yesntfwtw1rjsw1"
            :init="{statusbar: false, directionality: 'rtl',language: 'he_IL',language_url : '/js/tinymce/langs/he_IL.js'}"
            :initial-value="value"
            @onBlur="onBlur">
        </editor>
        <div class="delete-wrap">
            <div class="delete-self" @click="$emit('deleteSection', index)"></div>
        </div>
    </div>
</template>

<script>
import Editor from '@tinymce/tinymce-vue';

export default {
    data: function(){
        return {

        }
    },
    components: {
        Editor
    },
    props: {
        value : {
            type: String,
            default: ''
        },
        index: {
            type: Number
        }
    },
    methods: {
        onBlur(event){
            this.$emit('update:value', event.target.getContent());
        }
    }
}
</script>

<style lang="scss">
    .wrapper{
        .delete-wrap{
            position: relative;
            height: 50px;
            background: #F5F5F5;
            border: 1px solid #ccc;
            border-top: none;
        }
        .tox-tinymce{
            border-bottom: none;
        }
    }

    .delete-self{
        cursor: pointer;
        position: absolute;
        left: 20px;
        top: 10px;
        width: 30px;
        height: 30px;
        background: url('/img/icons/trash.svg') no-repeat center;
        -webkit-background-size: 20px 26px;
        background-size: 20px 26px;
    }
</style>
