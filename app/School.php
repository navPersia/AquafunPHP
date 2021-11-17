<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    public function classrooms() {
        return $this->hasMany('App\Classrom'); // Een school heeft meerdere klassen.
    }

    public function invoices() {
        return $this->hasMany('App\Invoice'); // Een school heeft meerdere facturen.
    }
}
