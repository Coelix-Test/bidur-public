<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LikesForSingleImage extends Model
{
    protected $table = 'likes_for_single_image';
    protected $guarded = ['id'];
}
