<?php

namespace App;

use App\Http\Controllers\SurveyAnswerVariantsController;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $guarded = ['id'];
    protected $table = 'posts';


    public function getAllTitles(){
        return $this->hasMany(PostTitle::class, 'postId', 'id');
    }

    public function getAllContents(){
        return $this->hasMany(PostContent::class, 'postId', 'id');
    }

    public function getAllImages(){
        return $this->hasMany(PostImage::class, 'postId', 'id');
    }

    public function getAllVideos(){
        return $this->hasMany(PostVideo::class, 'postId', 'id');
    }

    public function getAllSurveys(){
        return $this->hasMany(Survey::class, 'postId', 'id');
    }

    public function getAllHashtags(){
        return $this->hasMany(HashtagPosts::class, 'postId', 'id');
    }

    public function getAllImagesWithTexts(){
        return $this->hasMany(PostImageAndText::class, 'postId', 'id');
    }

    public function getRating(){
        return $this->hasMany(Rating::class, 'postId', 'id');
    }

    public function getLikableImage(){
        return $this->hasMany(SingleLikableImage::class, 'postId', 'id');
    }

    public function getCompare(){
        return $this->hasMany(SelectOne::class, 'postId', 'id');
    }

    public function getEmoji(){
        return $this->hasMany(Emoji::class, 'postId', 'id');
    }
}
