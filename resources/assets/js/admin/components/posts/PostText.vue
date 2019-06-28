<template>
    <div class="wrapper">
        <text-editor :value="value" @update:value="updateValue"></text-editor>
        <div class="delete-wrap">
            <div class="delete-self" @click="$emit('deleteSection', index)"></div>
        </div>
    </div>
</template>

<script>
import TextEditor from './../common/TextEditor.vue';

export default {
    data: function(){
        return {

        }
    },
    components: {
        TextEditor
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
        updateValue(value){
            this.$emit('update:value', value);
        }
    }
}
</script>

<style lang="scss" scoped>
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
