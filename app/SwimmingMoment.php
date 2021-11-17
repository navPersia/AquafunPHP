<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SwimmingMoment extends Model
{
    public function classroom() {
        return $this->belongsTo('App\Classroom')->withDefault(); // Een zwemmoment behoort tot slechts een klas.
    }

    public function invoice() {
        return $this->belongsTo('App\Invoice')->withDefault(); // Een zwemmoment kan op slechts een factuur.
    }
}
