<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'ratings';

    protected $fillable = ['postId', 'userId', 'rating'];

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
