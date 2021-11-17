<?php

namespace App\Http\Controllers\Admin;

use App\SwimmingParty;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SwimmingPartiesController extends Controller
{
    public function index()
    {
        $swimmingParties = SwimmingParty::get();
        return view('admin.swimmingParty.index', compact('swimmingParties'));
    }
}
