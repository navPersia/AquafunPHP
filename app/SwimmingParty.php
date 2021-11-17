<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SwimmingParty extends Model
{
    public function meal() {
        return $this->belongsTo('App\Meal')->withDefault(); // Er wordt slechts één maaltijd per zwemfeest geserveerd
    }

    public function rate() {
        return $this->belongsTo('App\Rate')->withDefault(); // Een feest heeft slechts een tarief.
    }

    public function user() {
        return $this->belongsTo('App\User')->withDefault(); // Een feest kan slechts door een klant gereserveerd worden.
    }
}
