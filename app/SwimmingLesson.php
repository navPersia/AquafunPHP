<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class SwimmingLesson extends Model
{

    public function rate() {
        return $this->belongsTo('App\Rate')->withDefault(); // Een zwemles heeft slechts een tarief.
    }

    public function user() {
        return $this->belongsTo('App\User')->withDefault(); // Een les wordt door slechts een leraar gegeven.
    }

    public function userswimminglessons() {
        return $this->hasMany('App\UserSwimmingLesson');
    }

    public function choices() {
        return $this->hasMany('App\Choice');
    }

    protected $casts = [
        'start_time' => 'datetime:Y-m-d',
        'end_time' => 'datetime:Y-m-d'
    ];



}
