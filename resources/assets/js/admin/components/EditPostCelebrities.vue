<template>
    <div class="edit-post-celebrities-wrapper">
        <div class="searchable-input">
            <input type="text" class="theme-input-text" placeholder="Add celebrity">
            <div class="search-results">
                <div>Jenifer Aniston</div>
                <div>Jenifer Aniston</div>
                <div>Jenifer Aniston</div>
                <div>Jenifer Dep</div>
                <div>Jojo Jostar</div>
            </div>
        </div>

        <button class="theme-btn theme-ico-btn add-celebrity" type="button" name="button">
            <svg viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.2115 0C6.73356 0 6.34611 0.387446 6.34611 0.865385V6.34607H0.865385C0.387446 6.34607 2.08929e-08 6.73351 0 7.21145C-2.08893e-08 7.68939 0.387447 8.07684 0.865386 8.07684H6.34611V14.1346C6.34611 14.6126 6.73356 15 7.2115 15C7.68944 15 8.07688 14.6126 8.07688 14.1346V8.07684H13.5577C14.0356 8.07684 14.4231 7.68939 14.4231 7.21145C14.4231 6.73352 14.0356 6.34607 13.5577 6.34607H8.07688V0.865385C8.07688 0.387446 7.68944 0 7.2115 0Z" fill="white"/>
            </svg>
            Celebrity
        </button>
    </div>
</template>

<script>
export default {
    data: function(){
        return {
            allCelebrities: []
        }
    },
    methods: {
        getCelebrities: function(){
            
        }
    },
    created() {
        this.getCelebrities();
    }
}
</script>

<style lang="scss" scoped>
@import "~@/vars.scss";

.searchable-input{
    position: relative;
    margin-left: 30px;
    .search-results{
        display: none;
        position: absolute;
        top: calc(100% - 2px);
        left: 0;
        width: 100%;
        border: 1px solid #E0E0E0;
        border-radius: 3px;
        z-index: 5;
        background: #fff;
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
    input:focus+.search-results{

        display: block;
    }
}

.add-celebrity{
    color: #fff;
    background: linear-gradient(270deg, #FF8383 0%, #4200FF 100%);
    svg{
        fill: #fff;
    }
}

</style>
