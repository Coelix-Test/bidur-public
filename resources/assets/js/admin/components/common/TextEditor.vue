<template>
    <div class="wrapper">
        <editor
            api-key="jbx3k23ait4px5lhnh1pptbqgidawba0f9qn3ew53ktdcj20"
            :init="{
                statusbar: false, 
                directionality: 'rtl',
                plugins: 'link',
                language: 'he_IL',
                language_url : '/js/tinymce/langs/he_IL.js'
            }"
            :initial-value="value"
            @onBlur="onBlur">
        </editor>
    </div>
</template>

<script>
import Editor from '@tinymce/tinymce-vue';

export default {
    data: function(){
        return {

        }
    },
    components: {
        Editor
    },
    props: {
        value : {
            type: String,
            default: ''
        }
    },
    methods: {
        onBlur(event){
            this.$emit('update:value', event.target.getContent());
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
