<template>
    <div class="edit-post-header-wrapper">
        <div class="inputs-row">
            <input type="text" class="main-post-title" name="title" placeholder="Add Title to the Post">
        </div>
        <div class="inputs-row w-100 d-flex">
            <div class="checkbox-group checkbox-group-hot">
                <label>
                    <input type="checkbox" name="is_hot">
                    <div class="text">םח</div>
                    <svg width="18" height="20" viewBox="0 0 18 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.88844 20C3.5555 17.2264 4.26534 15.6371 5.2898 14.1398C6.41169 12.5 6.70082 10.8768 6.70082 10.8768C6.70082 10.8768 7.58274 12.0233 7.22994 13.8164C8.78799 12.0821 9.08203 9.31876 8.84676 8.26047C12.3685 10.7216 13.8737 16.0506 11.8453 20C22.6338 13.8959 14.5288 4.76228 13.1178 3.73343C13.5881 4.76224 13.6774 6.50393 12.7272 7.34918C11.1187 1.24999 7.14178 0 7.14178 0C7.61214 3.14539 5.4368 6.58485 3.33913 9.15488C3.26544 7.90066 3.18714 7.03519 2.52759 5.83497C2.37954 8.11339 0.638302 9.97066 0.166777 12.2535C-0.471924 15.345 0.645202 17.6086 4.88844 20Z"/>
                    </svg>
                </label>
            </div>
            <!-- <edit-post-celebrities></edit-post-celebrities> -->
        </div>
        <div class="inputs-row w-100 d-flex">
            <div class="ico-input date-input d-inline-flex">
                <!-- <input type="date" name="date" placeholder="Add date"> -->
                <div class="ico">
                    <img src="/img/icons/edit-post-calendar.svg" alt="">
                </div>
                <datepicker class="theme-input-text"></datepicker>
            </div>

            <div class="ico-input author-input  d-inline-flex">
                <div class="ico">
                    <img src="/img/icons/edit-post-calendar.svg" alt="">
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
    // data: function(){
    //     return {
    //
    //     }
    // }
    components: {
        EditPostCelebrities,
        Datepicker
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
.checkbox-group{
    font-family: 'Rubik';
    font-size: 24px;
    font-weight: 700;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    label{
        display: -webkit-inline-flex;
        display: -ms-inline-flex;
        display: inline-flex;
        -ms-align-items: center;
        align-items: center;
    }
    .text{
        //vertical-align: middle;
        &:before{
            content: '';
            display: inline-block;
            width: 25px;
            height: 25px;
            border: 2px solid #E0E0E0;
            border-radius: 3px;
            margin-left: 14px;
            vertical-align: middle;
        }
    }

    svg{
        margin-right: 5px;
    }
}
.checkbox-group-hot{
    color: $red;
    svg{
        fill: $red;
    }
    input:checked+.text:before{
        background: url('/img/icons/checkbox-check-red.svg') no-repeat center;
        -webkit-background-size: 15px 12px;
        background-size: 15px 12px;
    }
}
</style>
