<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyAnswerVariant extends Model
{
    protected $table = 'surveyAnswerVariants';

    public function survey(){
        return $this->belongsTo(Survey::class);
    }

    public function answers(){
        return $this->hasMany(SurveyAnswers::class);
    }
}
