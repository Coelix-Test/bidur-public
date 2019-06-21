<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    protected $table = 'postImages';

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
