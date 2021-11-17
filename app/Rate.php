<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    public function swimmingparties() {
        return $this->hasMany('App\SwimmingParty'); // Een tarief kan voor meerdere feesten gelden.
    }

    public function swimminglessons() {
        return $this->hasMany('App\SwimmingLesson'); // Een tarief kan voor meerdere lessen gelden.
    }
}
