<template>
    <div class="container">
        <div class="row">
            <form class="col-8" @submit.prevent="submitPostData">
                <edit-post-header
                    :celebrities="celebrities"
                    :date="date"
                    @updateTitle="onUpdateTitle"
                    @updateAuthor="onUpdateAuthor"
                    @updateDate="onUpdateDate"
                    @updateCelebrities="onUpdateCelebrities">
                </edit-post-header>

                <div class="post-section" v-for="(section, index) in sections">
                    <template v-if="section.type === 'title'">
                        <post-title
                            :value.sync="section.value"
                            :index="index"
                            @deleteSection="deleteSection">
                        </post-title>
                    </template>
                    <template v-else-if="section.type === 'text'">
                        <post-text
                            :value.sync="section.value"
                            :index="index"
                            @deleteSection="deleteSection">
                        </post-text>
                    </template>
                    <template v-else-if="section.type === 'image'">
                        <post-image
                            :value.sync="section.value"
                            :description.sync="section.description"
                            :index="index"
                            @deleteSection="deleteSection">
                        </post-image>
                    </template>
                    <template v-else-if="section.type === 'imageWithText'">
                        <post-image-text
                            v-bind.sync="section"
                            :index="index"
                            @deleteSection="deleteSection">
                        </post-image-text>
                    </template>
                    <template v-else-if="section.type === 'video'">
                        <post-video
                            v-bind.sync="section"
                            :index="index"
                            @deleteSection="deleteSection">
                        </post-video>
                    </template>
                    <template v-else-if="section.type === 'survey'">
                        <post-survey
                            class="survey-section"
                            v-bind.sync="section"
                            :index="index"
                            @deleteSection="deleteSection">
                        </post-survey>
                    </template>
                </div>

                <div class="add-section-buttons-line">
                    <div class="add-section" @click="addSection('title')">
                        <img src="/img/icons/edit-post-title.svg" alt="">
                        <span>Title</span>
                    </div>
                    <div class="add-section" @click="addSection('text')">
                        <img src="/img/icons/edit-post-text.svg" alt="">
                        <span>Text</span>
                    </div>
                    <div class="add-section" @click="addSection('image')">
                        <img src="/img/icons/edit-post-image.svg" alt="">
                        <span>Image</span>
                    </div>
                    <div class="add-section add-image-text" @click="addSection('imageWithText')">
                        <img src="/img/icons/edit-post-image-text.svg" alt="">
                        <span>Image + Text</span>
                    </div>
                    <div class="add-section" @click="addSection('video')">
                        <img src="/img/icons/edit-post-video.svg" alt="">
                        <span>Video</span>
                    </div>
                    <div class="add-section" @click="addSection('survey')">
                        <img src="/img/icons/edit-post-survey.svg" alt="">
                        <span>Survey</span>
                    </div>
                    <div class="add-section add-image-text" @click="addSection('assessment')">
                        <img src="/img/icons/edit-post-assessment.svg" alt="">
                        <span>Assessment</span>
                    </div>
                    <div class="add-section add-image-text" @click="addSection('selection')">
                        <img src="/img/icons/edit-post-selection.svg" alt="">
                        <span>Selection</span>
                    </div>
                </div>
                <button type="submit" class="theme-btn theme-btn-red submit-post">Save</button>
            </form>
            <div class="col-3" dir="ltr" style="direction: ltr;text-align: left;font-size: 16px;">
                <template v-if="celebrities !== undefined">
                    title: {{title}} <br>
                    author: {{author}} <br>
                    date: {{date}} <br>
                    celebrities: {{celebrities}} <br>
                    sections: {{sections}}
                </template>
            </div>
        </div>
    </div>
</template>

<script>
import EditPostHeader from './../components/posts/EditPostHeader.vue';
import PostTitle from './../components/posts/PostTitle.vue';
import PostText from './../components/posts/PostText.vue';
import PostImage from './../components/posts/PostImage.vue';
import PostImageText from './../components/posts/PostImageText.vue';
import PostVideo from './../components/posts/PostVideo.vue';
import PostSurvey from './../components/posts/PostSurvey.vue';

export default {
    data: function(){
        return {
            celebrities: [],
            title: '',
            author: '',
            date: new Date(),
            sections: [
                {type: 'survey', image: '', title: '', answers: []}
            ]
        }
    },
    components: {
        EditPostHeader,
        PostTitle,
        PostText,
        PostImage,
        PostImageText,
        PostVideo,
        PostSurvey
    },
    methods: {
        addSection(type){
            let sectionData = {};
            switch (type) {
                case 'title':
                    sectionData = {type: 'title', value: ''};
                    break;
                case 'text':
                    sectionData = {type: 'text', value: ''};
                    break;
                case 'image':
                    sectionData = {type: 'image', value: '', description: ''};
                    break;
                case 'imageWithText':
                    sectionData = {type: 'imageWithText', image: '', title: '', text: '', imagePosition: 'left'};
                    break;
                case 'video':
                    sectionData = {type: 'video', value: '', description: ''};
                    break;
                case 'survey':
                    sectionData = {type: 'survey', image: '', title: '', answers: [] };
                    break;
            }
            this.sections.push(sectionData);
        },
        deleteSection(index){
            this.sections = this.sections.filter((section, i) => i !== index);
        },
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
        },
        submitPostData(){
            let postData = new FormData();

            //append header
            let sectionIndex = 0;
            postData.append('sections['+sectionIndex+'][type]', 'metaTitle');
            postData.append('sections['+sectionIndex+'][title]', this.title);
            postData.append('sections['+sectionIndex+'][author]', this.author);
            postData.append('sections['+sectionIndex+'][date]', this.date.getTime());
            this.celebrities.forEach(celebrity => {
                if(celebrity.id){
                    postData.append('sections['+sectionIndex+'][celebrities][]', celebrity.id);
                }
            });
            sectionIndex++;

            //append sections

            //send ajax
            let url = '/createPost';
            axios({
                    method: 'post',
                    url: url,
                    data: postData,
                    config: { headers: {'Content-Type': 'multipart/form-data' }}
                })
                .then(response => {
                    console.log(response);
                });
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
.post-section{
    margin-bottom: 20px;
}

.submit-post{
    font-size: 24px;
    border-radius: 10px;
    padding: 0 150px;
    height: 80px;
    margin-top: 30px;
}
.add-section-buttons-line{
    display: -webkit-flex;
    display: -ms-flex;
    display: flex;
    -webkit-flex-wrap: wrap;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-top: 30px;
    .add-section{
        background: #F2F2F2;
        font-size: 14px;
        color: #828282;
        text-align: center;
        padding: 8px 25px 2px 25px;
        margin-left: 16px;
        cursor: pointer;
        span{
            display: block;
        }
        img{
            height: 24px;
            width: auto;
        }
        &.add-image-text{
            padding-right: 10px;
            padding-left: 10px;
        }
    }
}
.survey-section{
    width: 75%;
}
</style>
