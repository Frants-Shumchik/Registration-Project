<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestsResults extends Model
{
    public function test() {
        return $this->belongsTo('App\Test');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
