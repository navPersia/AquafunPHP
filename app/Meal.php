<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    public function swimmingparties() {
        return $this->hasMany('App\SwimmingParty'); // Een soort maaltijd kan op 0 of meedere zweemfesstjes
    }
}
