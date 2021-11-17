<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    public function user() {
        return $this->belongsTo('App\User')->withDefault();
    }

    public function swimming_lesson() {
        return $this->belongsTo('App\SwimmingLesson')->withDefault();
    }
}
