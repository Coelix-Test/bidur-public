<template>
    <div class="edit-post-header-wrapper">
        <div class="inputs-row">
            <input type="text" class="main-post-title" name="title" :value="title" maxlength="150" @input="$emit('updateTitle', $event.target.value)" placeholder="כותרת" required>
        </div>
        <edit-post-celebrities
            @updateCelebrities="onUpdateCelebrities"
            :celebrities="celebrities" class="d-flex w-100 inputs-row">
        </edit-post-celebrities>
        <div class="inputs-row w-100 d-flex">
            <div class="ico-input date-input d-inline-flex align-items-center">
                <!-- <input type="date" name="date" placeholder="Add date"> -->
                <div class="ico">
                    <img src="/img/icons/edit-post-calendar.svg" alt="">
                </div>
                <datepicker class="theme-input-text" placeholder="Add date"
                    @selected="updateDate"
                    :value="date"
                    :format="formatDate">
                </datepicker>
                <timepicker
                  class="theme-input-text timepicker"
                  :value.sync="time">
                </timepicker>
            </div>

            <div class="ico-input author-input d-inline-flex align-items-center">
                <div class="ico">
                    <img src="/img/icons/edit-post-author.svg" alt="">
                </div>
                <input type="text" class="theme-input-text" name="author" maxlength="20" :value="author" @input="$emit('updateAuthor', $event.target.value)" placeholder="כותב המאמר">
            </div>
        </div>

    </div>
</template>

<script>
import EditPostCelebrities from './EditPostCelebrities.vue';
import Datepicker from 'vuejs-datepicker';
import VueTimepicker from 'vue2-timepicker';
import Timepicker from '../common/Timepicker.vue';

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
            type: Date
        },
        time: {
            type: Object
        },
        celebrities: {
            type: Array
        }
    },
    components: {
        EditPostCelebrities,
        Datepicker,
        VueTimepicker,
        Timepicker
    },
    methods: {
        onUpdateCelebrities(data) {
            this.$emit('updateCelebrities', data);
        },
        updateDate(data){
            this.$emit('updateDate', data);
        },
        formatDate(date){
            return moment(date).format('DD.MM.Y');
        }
    }
}
</script>

<style lang="scss" scoped>
@import "~@/vars.scss";

.main-post-title{
    height: 85px;
    // font-family: 'Playfair Display';
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
.timepicker::v-deep{
  margin-right: 5px;
  input{
    width: 120px;
    text-align: center;
  }
}
@media(max-width: 1530px){
  .main-post-title{
    height: 65px;
    font-size: 40px;
  }
}
</style>
