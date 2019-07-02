<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SingleLikableImage extends Model
{
    protected $table = 'single_likable_image';
    protected $guarded = ['id'];

    public function getLikes(){
        return $this->hasMany(LikesForSingleImage::class, 'serviceId', 'id');
    }

    public function getDislikes(){
        return $this->hasMany(DisLikesForSingleImage::class, 'serviceId', 'id');
    }
}
