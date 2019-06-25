<template>
  <div class="container">
      <div class="row">
          <div class="col-8">
              <edit-post-header :celebrities="celebrities" @addCelebrity="onAddCelebrity(data)"></edit-post-header>
          </div>
          <div class="col-3" dir="ltr" style="direction: ltr;">
              <template v-if="celebrities !== undefined"> {{celebrities}}</template>

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
            date: '',
        }
    },
    components: {
        EditPostHeader
    },
    methods: {
        onAddCelebrity(celebrity){
            celebrities.push(celebrity);
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
