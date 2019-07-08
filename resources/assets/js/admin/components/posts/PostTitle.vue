<template>
    <div class="wrapper">
        <input type="text" :value="value" @input="$emit('update:value', $event.target.value)" placeholder="כותרת">
        <div class="delete-self" @click="$emit('deleteSection', index)"></div>
    </div>
</template>

<script>
export default {
    data: function(){
        return {

        }
    },
    props: {
        value : {
            type: String,
            default: ''
        },
        index: {
            type: Number,
            default: 0
        }
    }
}
</script>

<style lang="scss" scoped>
    .wrapper{
        position: relative;
    }
    input{
        width: 100%;
        font-size: 36px;
        font-weight: 700;
        height: 74px;
        border-radius: 3px;
        border: 1px solid #E0E0E0;
        padding: 0 17px;
        &::placeholder{
            color: #BDBDBD;
        }
    }
    .delete-self{
        cursor: pointer;
        position: absolute;
        left: 20px;
        top: 23px;
        width: 30px;
        height: 30px;
        background: url('/img/icons/trash.svg') no-repeat center;
        -webkit-background-size: 20px 26px;
        background-size: 20px 26px;
    }
</style>
