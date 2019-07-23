<template>
    <div class="wrapper">
        <input type="text" class="theme-input-text"
            placeholder="קישור"
            :value="value"
            @input="$emit('update:value', $event.target.value)"/>

        <input type="text" name="description" class="theme-input-text"
            placeholder="Add description"
            :value="description"
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
            type: String,
            default: ''
        },
        index: {
            type: Number
        },
        description: {
            type: String,
            default: ''
        }
    }
}
</script>

<style lang="scss" scoped>
    @import "~@/vars.scss";
    .wrapper{
        position: relative;
        input{
            font-size: 18px;
            width: 100%;
            margin-top: 15px;
            padding-left: 50px;
            &::placeholder{
                font-style: italic;
                color: $gray;
            }
        }
        input[name="description"]{
            font-size: 18px;
            width: 50%;
            margin-top: 15px;
            font-style: italic;
            text-indent: 5px;
            &::placeholder{
                font-style: italic;
                color: $gray;
            }
        }

        .delete-self{
            cursor: pointer;
            position: absolute;
            left: 20px;
            bottom: 5px;
            width: 30px;
            height: 30px;
            background: url('/img/icons/trash.svg') no-repeat center;
            -webkit-background-size: 20px 26px;
            background-size: 20px 26px;
        }
    }
</style>
