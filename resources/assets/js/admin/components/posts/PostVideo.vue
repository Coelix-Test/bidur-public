<template>
    <div class="wrapper">

        <video-input :value="value" @update:value="updateValue"></video-input>
        <input type="text" name="description" class="theme-input-text"
            placeholder="Add description"
            @input="$emit('update:description', $event.target.value)"/>

        <div class="delete-self" @click="$emit('deleteSection', index)"></div>
        <move-section @move="$emit('move', $event)"/>
    </div>
</template>

<script>
import VideoInput from './../common/VideoInput.vue';
import MoveSection from './../common/MoveSection';
export default {
    data: function(){
        return {

        }
    },
    components: {
        VideoInput,
        MoveSection,
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
        updateValue(value){
            console.log(value);
            this.$emit('update:value', value);
        }
    }
}
</script>

<style lang="scss" scoped>
    @import "~@/vars.scss";
    .wrapper{
        position: relative;
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
