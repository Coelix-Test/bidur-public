<template>
    <div class="edit-post-celebrities-wrapper">


        <searchable-input
            v-for="celebrity in celebrities"
            :key="celebrity.index"
            :index="celebrity.index"
            :placeholder="'Add celebrity'"
            :options="allCelebrities"
            @select="selectCelebrity"
            @deleteSelf="deleteCelebrity">
        </searchable-input>

        <button class="theme-btn theme-ico-btn add-celebrity" type="button" name="button" @click="addCelebrity()">
            <svg viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.2115 0C6.73356 0 6.34611 0.387446 6.34611 0.865385V6.34607H0.865385C0.387446 6.34607 2.08929e-08 6.73351 0 7.21145C-2.08893e-08 7.68939 0.387447 8.07684 0.865386 8.07684H6.34611V14.1346C6.34611 14.6126 6.73356 15 7.2115 15C7.68944 15 8.07688 14.6126 8.07688 14.1346V8.07684H13.5577C14.0356 8.07684 14.4231 7.68939 14.4231 7.21145C14.4231 6.73352 14.0356 6.34607 13.5577 6.34607H8.07688V0.865385C8.07688 0.387446 7.68944 0 7.2115 0Z" fill="white"/>
            </svg>
            Celebrity
        </button>
    </div>
</template>

<script>
import SearchableInput from './../common/SearchableInput.vue';

export default {
    data: function(){
        return {
            allCelebrities: []
        }
    },
    components: {
        SearchableInput
    },
    props: {
        celebrities: {
            type: Array,
            default: function(){
                return [
                    {id: '', name: '', index: 0}
                ];
            }
        }
    },
    methods: {
        getCelebrities: function(){
            axios.post('/getAllHashtags')
                .then(response => {
                    response.data.forEach((item, i) => {
                        delete item.img;
                    });
                    this.allCelebrities = response.data;
                });
        },
        addCelebrity(){
            let index = 0;
            if(this.celebrities.length){
                index = this.celebrities[this.celebrities.length - 1].index + 1;
            }
            let newCelebrities = this.celebrities;
            newCelebrities.push(
                {id: '', name: '', index: index}
            );
            console.log(this.celebrities);
            this.$emit('updateCelebrities', newCelebrities);
        },
        selectCelebrity(celebrity, index){
            let newCelebrities = this.celebrities.map(item => {
                if(item.index === index){
                    item.id = celebrity.id;
                    item.name = celebrity.name;
                }
                return item;
            });
            //console.log(newCelebrities);
            this.$emit('updateCelebrities', newCelebrities);
        },
        deleteCelebrity(index){

            let newCelebrities = this.celebrities.filter(item => item.index !== index);
            console.log('alex', newCelebrities);
            this.$emit('updateCelebrities', newCelebrities);
        }
    },
    created() {
        this.getCelebrities();
    }
}
</script>

<style lang="scss" scoped>
.edit-post-celebrities-wrapper{
    display: -webkit-flex;
    display: -ms-flex;
    display: flex;
    -webkit-flex-wrap: wrap;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
}
.add-celebrity{
    color: #fff;
    background: linear-gradient(270deg, #FF8383 0%, #4200FF 100%);
    svg{
        fill: #fff;
    }
}
</style>
