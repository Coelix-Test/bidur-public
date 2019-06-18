<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';


    public function getAllTitles(){
        return $this->hasMany(PostTitle::class);
    }

    public function getAllContents(){
        return $this->hasMany(PostContent::class);
    }

    public function getAllImages(){
        return $this->hasMany(PostImage::class);
    }

    public function getAllVideos(){
        return $this->hasMany(PostVideo::class);
    }

    public function getAllSurveys(){
        return $this->hasMany(Survey::class);
    }

    public function getAllHashtags(){
        return $this->hasMany(HashtagPosts::class, 'postId');
    }

}
