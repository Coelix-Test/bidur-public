<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyAnswers extends Model
{
    protected $table = 'surveyAnswers';
    protected $guarded = ['id'];

    public function variant(){
        return $this->belongsTo(SurveyAnswerVariant::class);
    }

}
