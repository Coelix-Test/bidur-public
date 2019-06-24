<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    protected $table = 'postImages';
    protected $guarded = ['id'];

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
