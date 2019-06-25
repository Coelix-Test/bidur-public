<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SingleLikableImage extends Model
{
    protected $table = 'singleLikableImage';
    protected $guarded = ['id'];
}
