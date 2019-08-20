<template>
    <div class="container">
        <div class="row">
            <form class="col-9 edit-post-content" @submit.prevent="submitPostData">

                <check-box @input="changePostStatus" v-if="$route.params.id" :value="this.publish">
                  פרסם
                </check-box>

                <edit-post-header
                    :title="title"
                    :author="author"
                    :celebrities="celebrities"
                    :date="date"
                    :time.sync="time"
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
                            @move="move(index, $event)"
                            @deleteSection="deleteSection">
                        </post-title>
                    </template>
                    <template v-else-if="section.type === 'text'">
                        <post-text
                            :value.sync="section.value"
                            :index="index"
                            @move="move(index, $event)"
                            @deleteSection="deleteSection">
                        </post-text>
                    </template>
                    <template v-else-if="section.type === 'image'">
                        <post-image
                            :value.sync="section.value"
                            :description.sync="section.description"
                            :index="index"
                            @move="move(index, $event)"
                            @deleteSection="deleteSection">
                        </post-image>
                    </template>
                    <template v-else-if="section.type === 'imageWithText'">
                        <post-image-text
                            class="shadow-section"
                            v-bind.sync="section"
                            :index="index"
                            @move="move(index, $event)"
                            @deleteSection="deleteSection">
                        </post-image-text>
                    </template>
                    <template v-else-if="section.type === 'video'">
                        <post-video-link
                            v-bind.sync="section"
                            :index="index"
                            @move="move(index, $event)"
                            @deleteSection="deleteSection">
                        </post-video-link>
                    </template>
                    <template v-else-if="section.type === 'survey'">
                        <post-survey
                            class="survey-section shadow-section"
                            v-bind.sync="section"
                            :index="index"
                            @move="move(index, $event)"
                            @deleteSection="deleteSection">
                        </post-survey>
                    </template>
                    <template v-else-if="section.type === 'assessment'">
                        <post-assessment
                            class="assessment-section shadow-section"
                            v-bind.sync="section"
                            :index="index"
                            @move="move(index, $event)"
                            @deleteSection="deleteSection">
                        </post-assessment>
                    </template>
                    <template v-else-if="section.type === 'selection'">
                        <post-selection
                            class="selection-section shadow-section"
                            v-bind.sync="section"
                            :index="index"
                            @move="move(index, $event)"
                            @deleteSection="deleteSection">
                        </post-selection>
                    </template>
                </div>

                <div class="add-section-buttons-line">
                    <!-- <div class="add-section" @click="addSection('title')">
                        <img src="/img/icons/edit-post-title.svg" alt="">
                        <span>כותרת</span>
                    </div> -->
                    <div class="add-section" @click="addSection('text')">
                        <img src="/img/icons/edit-post-text.svg" alt="">
                        <span>טקסט</span>
                    </div>
                    <div class="add-section" @click="addSection('image')">
                        <img src="/img/icons/edit-post-image.svg" alt="">
                        <span>תמונה</span>
                    </div>
                    <div class="add-section add-image-text" @click="addSection('imageWithText')">
                        <img src="/img/icons/edit-post-image-text.svg" alt="">
                        <span>תמונה + טקסט</span>
                    </div>
                    <div class="add-section" @click="addSection('video')">
                        <img src="/img/icons/edit-post-video.svg" alt="">
                        <span>וידאו</span>
                    </div>
                    <div class="add-section" @click="addSection('survey')">
                        <img src="/img/icons/edit-post-survey.svg" alt="">
                        <span>שאלון</span>
                    </div>
                    <div class="add-section add-image-text" @click="addSection('assessment')">
                        <img src="/img/icons/edit-post-assessment.svg" alt="">
                        <span>שאלון אהבתי</span>
                    </div>
                    <div class="add-section add-image-text" @click="addSection('selection')">
                        <img src="/img/icons/edit-post-selection.svg" alt="">
                        <span>העדפה</span>
                    </div>
                </div>
                <button type="submit" class="theme-btn theme-btn-red submit-post">לשמור</button>
            </form>
            <div class="col-3" dir="ltr" style="direction: ltr;text-align: left;font-size: 16px;display: none;">
                <template v-if="celebrities !== undefined">
                    title: {{title}} <br>
                    author: {{author}} <br>
                    date: {{date}} <br>
                    celebrities: {{celebrities}} <br>
                    sections: {{sections}}
                </template>
            </div>
            <div class="col-3">
                <!-- <side-news></side-news> -->
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
// import PostVideo from './../components/posts/PostVideo.vue';
import PostVideoLink from './../components/posts/PostVideoLink.vue';
import PostSurvey from './../components/posts/PostSurvey.vue';
import PostAssessment from './../components/posts/PostAssessment.vue';
import PostSelection from './../components/posts/PostSelection.vue';
import CheckBox from './../components/common/CheckBox.vue';
import SideNews from './../../home/components/SideNews.vue';

export default {
    data: function(){
        return {
            celebrities: [],
            title: '',
            author: '',
            date: new Date(),
            time: {
              hour: moment(new Date()).format('HH'),
              minute: moment(new Date()).format('mm')
            },
            publish: false,
            sections: []
        }
    },
    components: {
        EditPostHeader,
        PostTitle,
        PostText,
        PostImage,
        PostImageText,
        PostVideoLink,
        PostSurvey,
        PostAssessment,
        PostSelection,
        SideNews,
        CheckBox,
    },
    methods: {
      move(index, dir) {
        console.log(index, dir);
        if(dir == 'top') {
          if(index != 0) {
            this.sections.move(index, index - 1)
          }
        }
        else if(dir == 'bottom') {
          if((this.sections.length - 1) > index) {
            this.sections.move(index, index + 1)
          }
        }
      },
      changePostStatus(){
        this.publish = !this.publish;
        if(this.publish){
          //set current date as published
          this.date = new Date();
          this.time.hour = moment(this.date).format('HH');
          this.time.minute = moment(this.date).format('mm');
        }
      },
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
                sectionData = {type: 'survey', image: '', title: '', answers: [], description: '' };
                break;
            case 'assessment':
                sectionData = {type: 'assessment', image: '', title: '', description: '' };
                break;
            case 'selection':
                sectionData = {type: 'selection', image1: '', image2: '', leftDescription: '', rightDescription: '', title: '' };
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
          this.sections.forEach((section) => {
              for (const [key, value] of Object.entries(section)) {
                  if(Array.isArray(value)){
                      value.forEach(item => {
                          postData.append('sections['+sectionIndex+']['+key+'][]', item);
                      });
                  }
                  else{
                      postData.append('sections['+sectionIndex+']['+key+']', value);
                  }
              }
              sectionIndex++;
          });

          //send ajax
          let url = '/createPost';
          let successMessage = 'Post was successfully added!';
          if(this.$route.params.id){
            url = '/api/editPostCreateAllSections';
            successMessage = 'Post was successfully edited!';
            postData.append('id', this.$route.params.id);
            postData.append('publish', this.publish ? 1 : 0);
          }
          axios({
                  method: 'post',
                  url: url,
                  data: postData,
                  config: { headers: { 'Content-Type': 'multipart/form-data' }}
              })
              .then(response => {
                  // console.log(response);
                  this.$router.push('/');
                  alert(successMessage);
              })
              .catch(error => {
                alert('שגיאה, נראה שאחת התמונות לא הועלתה');
              });
      }
    },
    created() {
        if(this.$route.params.id) {
            // TODO: get all post info by ajax
            axios.post('/api/showEditablePostContent', {id: this.$route.params.id})
              .then(response => {
                this.title = response.data.mainTitle;
                this.author = response.data.author;
                this.publish = response.data.publish;
                this.date = new Date(response.data.date*1000);
                this.time.hour = moment(this.date).format('HH');
                this.time.minute = moment(this.date).format('mm');
                if(response.data.sections){
                  let postSections = response.data.sections;
                  postSections = Object.keys(postSections).map(i => postSections[i]);
                  this.sections = postSections;
                  // console.log(postSections);
                }

                if(response.data.hashtags){
                  this.celebrities = response.data.hashtags.map(i => {
                    return {id: i.id, name: i.title};
                  });
                }
              });
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
        margin-bottom: 15px;
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
.survey-section,
.assessment-section,
.selection-section{
    width: 75%;
}

.check-box {
  align-self: flex-start;
}

@media (max-width: 1560px){
  .edit-post-content{
    padding-right: 40px;
  }
}
</style>
