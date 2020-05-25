<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestQuestions extends Model
{
    public $timestamps = false;

    public function questionType() {
        return $this->hasOne('App\QuestionTypes', 'id', 'type_id');
    }

    public function answers() {
        return $this->hasMany('App\QuestionAnswers', 'question_id');
    }
}
