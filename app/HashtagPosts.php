<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HashtagPosts extends Model
{
    protected $table = 'hashtag_post';
    protected $guarded = ['id'];
}
