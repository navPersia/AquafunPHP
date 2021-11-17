<?php

namespace App\Http\Controllers;

use App\SwimmingLesson;
use App\UserSwimmingLesson;
use Illuminate\Http\Request;

class WatchController extends Controller
{
    public function show()
    {
        $lessons = SwimmingLesson::orderBy('weekday');
        $userLessons = UserSwimmingLesson::get();
        $result = compact('lessons', 'userLessons');
        return view('watch', $result);
    }
}
