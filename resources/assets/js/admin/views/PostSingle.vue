<template>
  <div class="container">
      <div class="row">
          <div class="col-8">
              <edit-post-header
                :celebrities="celebrities"
                :date="date"
                @updateTitle="onUpdateTitle"
                @updateAuthor="onUpdateAuthor"
                @updateDate="onUpdateDate"
                @onUpdateCelebreties="onUpdateCelebreties">
            </edit-post-header>
          </div>
          <div class="col-3" dir="ltr" style="direction: ltr;">
              <template v-if="celebrities !== undefined">
                  Title: {{title}} <br>
                  author: {{author}} <br>
                  date: {{date}} <br>
                  Celebrities: {{celebrities}}
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
        onUpdateCelebreties(data){
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
</style>
