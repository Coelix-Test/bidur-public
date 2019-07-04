<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DisLikesForSingleImage extends Model
{
    protected $table = 'dislikes_for_single_image';
    protected $guarded = ['id'];
}
