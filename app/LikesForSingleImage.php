<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LikesForSingleImage extends Model
{
    protected $table = 'likesForSingleImage';
    protected $guarded = ['id'];
}
