<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyAnswerVariant extends Model
{
    protected $table = 'surveyAnswerVariants';

    public function getTheSurvey(){
        return $this->belongsTo(Survey::class, 'surveyId', 'id');
    }

    public function answers(){
        return $this->hasMany(SurveyAnswers::class, 'answer', 'id');
    }
}
