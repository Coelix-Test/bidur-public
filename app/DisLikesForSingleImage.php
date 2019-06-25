<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DisLikesForSingleImage extends Model
{
    protected $table = 'dislikesForLeftAndRight';
    protected $guarded = ['id'];
}
