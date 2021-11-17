<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function school(){
        return $this->belongsTo('App\School')->withDefault(); // Een factuur behoort tot een school
    }

    public function swimmingmoments() {
        return $this->hasMany('App\SwimmingMoment'); // Een factuur kan voor 1 of meerdere zwemmoment aangerekend worden.
    }

    public function user() {
        return $this->belongsTo('App\User')->withDefault(); // Een factuur kan door slechts een beheerder worden opgesteld.
    }
}
