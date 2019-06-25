<template>
    <div class="edit-post-header-wrapper">
        <div class="inputs-row">
            <input type="text" class="main-post-title" name="title" placeholder="Add Title to the Post">
        </div>
        <edit-post-celebrities @updateCelebreties="onUpdateCelebreties" @addCelebrity="onAddCelebrity" :celebrities="celebrities" class="d-flex w-100 inputs-row"></edit-post-celebrities>
        <div class="inputs-row w-100 d-flex">
            <div class="ico-input date-input d-inline-flex align-items-center">
                <!-- <input type="date" name="date" placeholder="Add date"> -->
                <div class="ico">
                    <img src="/img/icons/edit-post-calendar.svg" alt="">
                </div>
                <datepicker class="theme-input-text" placeholder="Add date"></datepicker>
            </div>

            <div class="ico-input author-input d-inline-flex align-items-center">
                <div class="ico">
                    <img src="/img/icons/edit-post-author.svg" alt="">
                </div>
                <input type="text" class="theme-input-text" name="author" placeholder="Add author">
            </div>
        </div>

    </div>
</template>

<script>
import EditPostCelebrities from './../components/EditPostCelebrities.vue';
import Datepicker from 'vuejs-datepicker';

export default {
    data: function(){
        return {
        }
    },
    props: {
        title: {
            type: String
        },
        author: {
            type: String
        },
        date: {
            type: String
        },
        celebrities: {
            type: Array
        }
    },
    components: {
        EditPostCelebrities,
        Datepicker
    },
    methods: {
        onUpdateCelebreties(data) {
            this.celebreties = data;
        },
        onAddCelebrity(data){
            console.log(data);
            this.$emit('addCelebrity', data);
        }
    }
}
</script>

<style lang="scss" scoped>
@import "~@/vars.scss";

.main-post-title{
    height: 85px;
    font-family: 'Playfair Display';
    font-size: 48px;
    font-weight: 700;
    border: 1px solid #E0E0E0;
    border-radius: 3px;
    width: 100%;
    padding: 0 17px;
    &::placeholder{
        color: #BDBDBD;
    }
}
.inputs-row{
    margin-bottom: 12px;
}
.ico-input{
    margin-left: 37px;
    .ico{
        margin-left: 14px;
    }
}

</style>
