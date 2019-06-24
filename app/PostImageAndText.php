<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostImageAndText extends Model
{
    protected $table = 'imageAndText';
    protected $guarded = ['id'];

    public function getPost(){
        return $this->belongsTo(Post::class, 'postId', 'id');
    }
}
