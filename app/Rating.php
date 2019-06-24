<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'ratings';

    protected $guarded = ['id'];

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
