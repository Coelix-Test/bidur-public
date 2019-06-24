<template>
    <div class="edit-post-header-wrapper">
        <input type="text" class="main-post-title" name="title" placeholder="Add Title to the Post">
        <div class="w-100">

        </div>
        <div class="w-100">
            <div class="date-input">
                <input type="date" name="date" placeholder="Add date">
                <div class="ico">
                    <img src="/img/iconts/edit-post-calendar.svg" alt="">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import EditPostCelebrities from './../components/EditPostHeader.vue'

export default {
    // data: function(){
    //     return {
    //
    //     }
    // }
    components: {
        EditPostCelebrities
    }
}
</script>

<style lang="scss" scoped>
</style>
