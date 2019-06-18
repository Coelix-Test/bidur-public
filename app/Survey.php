<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $table = 'surveys';

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function variants(){
        return $this->hasMany(SurveyAnswerVariant::class);
    }
}
