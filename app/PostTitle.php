<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostTitle extends Model
{
    protected $guarded = ['id'];
    protected $table = 'postTitles';
    public function post(){
        return $this->belongsTo(Post::class);
    }
}
