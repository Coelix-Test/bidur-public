<template>
    <div class="wrapper">
        <editor
            api-key="tl9l4lbf7vc1pkaj7rcvtgcbsyymlwho2yesntfwtw1rjsw1"
            :init="{
                statusbar: false, 
                directionality: 'rtl',
                plugins: 'print preview fullpage powerpaste searchreplace autolink link',
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
