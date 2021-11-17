<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    public function school() {
        return $this->belongsTo('App\School')->withDefault(); // Een klas behoort tot een school
    }

    public function swimmingmoments() {
        return $this->hasMany('App\SwimmingMoment'); // Een klas heeft meerdere zwemmomenten.
    }
}
