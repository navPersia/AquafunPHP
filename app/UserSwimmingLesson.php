<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSwimmingLesson extends Model
{
    public function user() {
        return $this->belongsTo('App\User')->withDefault();
    }

    public function swimminglesson() {
        return $this->belongsTo('App\SwimmingLesson')->withDefault();
    }
}
