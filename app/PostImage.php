<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    protected $table = 'post_images';
    protected $guarded = ['id'];

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
