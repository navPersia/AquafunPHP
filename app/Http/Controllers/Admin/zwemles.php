<?php

namespace App\Http\Controllers\Admin;

use App\SwimmingLesson;
use App\User;
use App\Rate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\InvoicePaid;

class zwemles extends Controller
{
    public function index()
    {
        $zwemlesen = SwimmingLesson::get();
        $teachers = User::get();
        $rates = Rate::get();
        $days = ["Maandag", "Dinsdag", "Woensdag", "Donderdag", "Vrijdag", "Zaterdag", "Zondag"];
        // Json::dump($leraars);
        return view('admin.zwemles.index', compact('zwemlesen', 'teachers','days', 'rates'));
    }

     // create user profile
     public function store(Request $request)
     {
        if($teacher = (int)$request->input('teacher')){;}
        else{
            $notification = array(
                'message' => 'De leraar moet gekozen worden',
                'alert-type' => 'warning'
            );
            return back()->with($notification);
        }
        if($request->input('day') != "Non"){$day = $request->input('day');}
        else{$notification = array(
            'message' => 'De dag moet gekozen worden',
            'alert-type' => 'warning'
        );
        return back()->with($notification);}
        if($request->input('startH') != ""){$startH = date("Y-m-d ") . $request->input('startH');}
        else{$notification = array(
            'message' => 'De begin uur moet gekozen worden',
            'alert-type' => 'warning'
        );
        return back()->with($notification);}
        if($request->input("EndH") != ""){$EndH = date("Y-m-d ") . $request->input("EndH");}
        else{$notification = array(
            'message' => 'De eind uur moet gekozen worden',
            'alert-type' => 'warning'
        );
        return back()->with($notification);}
        if($rate = (int)$request->input('rate')){;}
        else{$notification = array(
            'message' => 'Rate moet gekozen worden',
            'alert-type' => 'warning'
        );
        return back()->with($notification);}
        $active = (int)$request->input('active');

        $zwemles = new SwimmingLesson();
        $zwemles->user_id = $teacher;
        $zwemles->weekday = $day;
        $zwemles->start_time = $startH;
        $zwemles->end_time = $EndH;
        $zwemles->status = $active;
        $zwemles->rate_id = $rate;
        $zwemles->save();
        $notification = array(
            'message' => 'Zwemles is succesvol aangemaakt',
            'alert-type' => 'success'
        );

        // return redirect('/admin/zwemles/');
        return back()->with($notification);
     }

     /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = (int)$request->input('myid');
        
        $zwemlesen = SwimmingLesson::find($id);
        $zwemlesen->delete();

        $notification = array(
            'message' => 'Zwemles is verwijderd',
            'alert-type' => 'error'
        );
        return back()->with($notification);
    }

    public function edit(Request $request)
    {
        $teachers = User::get();
        $rates = Rate::get();
        $days = ["Maandag", "Dinsdag", "Woensdag", "Donderdag", "Vrijdag", "Zaterdag", "Zondag"];

        $zwemlesId = (int)$request->input('zwemlesId');
        $zwemles = SwimmingLesson::find($zwemlesId);


        return view('admin.zwemles.edit', compact('zwemles', 'teachers','days', 'rates'));
    }

    public function update(Request $request)
    {

        $zwemlesId = (int)$request->input('zwemlesId');
        $zwemles = SwimmingLesson::find($zwemlesId);

        if($request->input('teacher')){
            $zwemles->user_id = (int)$request->input('teacher');
        }else{
            $notification = array(
                'message' => 'De process is NIET gelukt! alle velden moeten ingevuld worden',
                'alert-type' => 'error'
            );
            return redirect('/admin/zwemles/')->with($notification);
        }

        if($request->input('weekday')){
            $zwemles->weekday = $request->input('weekday');
        }else{
            $notification = array(
                'message' => 'De process is NIET gelukt! alle velden moeten ingevuld worden',
                'alert-type' => 'error'
            );
            return redirect('/admin/zwemles/')->with($notification);
        }

        if($request->input('startH')){
            $zwemles->start_time = date("Y-m-d ") . $request->input('startH');
        }else{
            $notification = array(
                'message' => 'De process is NIET gelukt! alle velden moeten ingevuld worden',
                'alert-type' => 'error'
            );
            return redirect('/admin/zwemles/')->with($notification);
        }

        if($request->input('EndH')){
            $zwemles->end_time = date("Y-m-d ") . $request->input('EndH');
        }else{
            $notification = array(
                'message' => 'De process is NIET gelukt! alle velden moeten ingevuld worden',
                'alert-type' => 'error'
            );
            return redirect('/admin/zwemles/')->with($notification);
        }

        if($request->input('rate_id')){
            $zwemles->rate_id = (int)$request->input('rate_id');
        }else{
            $notification = array(
                'message' => 'De process is NIET gelukt! alle velden moeten ingevuld worden',
                'alert-type' => 'error'
            );
            return redirect('/admin/zwemles/')->with($notification);
        }
        $zwemles->status = (int)$request->input('status');
        $zwemles->save();

        return redirect('/admin/zwemles/');
        }
}
