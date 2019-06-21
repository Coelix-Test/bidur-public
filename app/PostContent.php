<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostContent extends Model
{
    protected $table = 'postContents';

    public function post(){
        return $this->belongsTo(Post::class);
    }


}
