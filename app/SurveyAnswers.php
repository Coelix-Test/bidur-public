<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyAnswers extends Model
{
    protected $table = 'survey_answers';
    protected $guarded = ['id'];

    public function variant(){
        return $this->belongsTo(SurveyAnswerVariant::class);
    }

}
