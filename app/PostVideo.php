<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostVideo extends Model
{
    protected $guarded = ['id'];
    protected $table = 'post_videos';
    public function post(){
        return $this->belongsTo(Post::class);
    }
}
