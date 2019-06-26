<template>
    <div class="container">
        <div class="row">
            <form class="col-8">
                <edit-post-header
                    :celebrities="celebrities"
                    :date="date"
                    @updateTitle="onUpdateTitle"
                    @updateAuthor="onUpdateAuthor"
                    @updateDate="onUpdateDate"
                    @updateCelebrities="onUpdateCelebrities">
                </edit-post-header>
                <button type="submit" class="theme-btn theme-btn-red submit-post">Save</button>
            </form>
            <div class="col-3" dir="ltr" style="direction: ltr;">
                <template v-if="celebrities !== undefined">
                    title: {{title}} <br>
                    author: {{author}} <br>
                    date: {{date}} <br>
                    celebrities: {{celebrities}}
                </template>
            </div>
        </div>
    </div>
</template>

<script>
import EditPostHeader from './../components/EditPostHeader.vue'

export default {
    data: function(){
        return {
            celebrities: [],
            title: '',
            author: '',
            date: new Date(),
        }
    },
    components: {
        EditPostHeader
    },
    methods: {
        onUpdateCelebrities(data){
            this.celebrities = data;
        },
        onUpdateTitle(data){
            this.title = data;
        },
        onUpdateDate(data){
            this.date = data;
        },
        onUpdateAuthor(data){
            this.author = data;
        }
    },
    created() {
        if(this.$route.params.id) {
            // TODO: get all post info by ajax
        }
    },
}
</script>

<style lang="scss" scoped>
.container{
    padding-top: 30px;
}

.submit-post{
    font-size: 24px;
    border-radius: 10px;
    padding: 0 150px;
    height: 80px;
    margin-top: 30px;
}
</style>
