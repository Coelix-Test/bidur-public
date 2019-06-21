<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hashtag extends Model
{
    protected $table = 'hashtags';

    public function getAllPosts(){
        return $this->belongsToMany(Post::class);
    }
}
