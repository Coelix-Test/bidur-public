<template>
    <div class="searchable-input">
        <input type="text" class="theme-input-text" :placeholder="placeholder" v-model="query" required>
        <div class="search-results">
            <div v-for="matchingItem in filtered"
                @click="select(matchingItem)">
                {{matchingItem[label]}}
            </div>
        </div>
        <div v-if="deletable" class="delete-self" @click="$emit('deleteSelf')"></div>
    </div>
</template>

<script>
export default {
    props: {
      options: {
        type: Array
      },
      deletable: {
        type: Boolean,
        default: true
      },
      placeholder: {
        type: String,
        default: ''
      },
      label: {
        default: 'name'
      },
      val: {
        default: 'id',
      },
      value: {

      }
    },
    data() {
      //console.log(this.value);
      return {
        query: this.value ? this.value[this.label] : '',
      };
    },
    methods: {
        select(item){
            // console.log(item);
            this.query = item[this.label];
            this.$emit('input', item);
        }
    },
    computed: {
      filtered() {
        if(this.query && this.query.length) {
          return this.options.filter(n => (new RegExp(this.query, 'i')).test(n[this.label]));
        } else {
          return this.options;
        }

      }
    }
}
</script>

<style lang="scss" scoped>
@import "~@/vars.scss";

.searchable-input{
    position: relative;
    margin-left: 30px;
    margin-bottom: 15px;
    .search-results{
        //display: none;
        visibility: hidden;
        transition: visibility 0s linear .15s;
        position: absolute;
        top: calc(100% - 2px);
        left: 0;
        width: 100%;
        border: 1px solid #E0E0E0;
        border-radius: 3px;
        z-index: 5;
        background: #fff;
        max-height: 250px;
        overflow-y: scroll;
        &>div{
            height: 35px;
            color: $gray;
            padding: 0 13px;
            display: -webkit-flex;
            display: -ms-flex;
            display: flex;
            -ms-align-items: center;
            align-items: center;
            cursor: pointer;
            &:hover{
                background: $red;
                color: #fff;
            }
        }
    }
    input{
        position: relative;
        z-index: 4;
        &:focus{
            z-index: 10;
        }
    }
    input:focus+.search-results{

        // display: block;
        visibility: visible;
    }

    .delete-self{
        position: absolute;
        z-index: 4;
        left: 1px;
        top: 10px;
        width: 30px;
        height: 19px;
        background: url('/img/icons/trash.svg') no-repeat center;
        -webkit-background-size: 13px 18px;
        background-size: 13px 18px;
        cursor: pointer;
    }
}

</style>
