<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Json;
use App\Http\Controllers\Controller;
use App\Mail\BevestigingsMail;
use App\Mail\ContactMail;
use App\Meal;
use App\Rate;
use App\SwimmingParty;
use App\User;
use Illuminate\Http\Request;
use Mail;
use stdClass;

class SwimmingPartyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zwemfeestjes = SwimmingParty::get();
        $rates = Rate::get();
        $meals = Meal::get();
        $users = User::get();
        return view('admin.zwemfeest.index', compact('zwemfeestjes', 'rates', 'meals', 'users'));
    }

    public function store(Request $request)
    {
        if($rate = (int)$request->input('rate')){;}
        else{$notification = array(
            'message' => 'Rate moet gekozen worden',
            'alert-type' => 'warning'
        );
        return back()->with($notification);}
        if($date = $request->input('date')){;}
        else{$notification = array(
            'message' => 'Datum moet gekozen worden',
            'alert-type' => 'warning'
        );
        return back()->with($notification);}
        if($meal = $request->input('meal')){;}
        else{$notification = array(
            'message' => 'Maaltijd moet gekozen worden',
            'alert-type' => 'warning'
        );
        return back()->with($notification);}
        if($amount = $request->input('amount')){;}
        else{$notification = array(
            'message' => 'Hoeveelheid deelnemers moet gekozen worden',
            'alert-type' => 'warning'
        );
        return back()->with($notification);}
        if($startH = $request->input('startH')){;}
        else{$notification = array(
            'message' => 'Het start uur moet gekozen worden',
            'alert-type' => 'warning'
        );
        return back()->with($notification);}
        if($endH = $request->input("EndH")){;}
        else{$notification = array(
            'message' => 'Het eind uur moet gekozen worden',
            'alert-type' => 'warning'
        );
        return back()->with($notification);}
        if($name = $request->input("Name")){;}
        else{$notification = array(
            'message' => 'de naam moet ingevuld worden',
            'alert-type' => 'warning'
        );
        return back()->with($notification);}
        if($email = $request->input("email")){;}
        else{$notification = array(
            'message' => 'de e-mail moet ingevuld worden',
            'alert-type' => 'warning'
        );
        return back()->with($notification);}

        $active = (int)$request->input('active');


        $zwemfeest = new SwimmingParty();
        $zwemfeest->user_id = auth()->user()->id;
        $zwemfeest->rate_id = $rate;
        $zwemfeest->date = $date;
        $zwemfeest->meal_id = $meal;
        $zwemfeest->start_time = $startH;
        $zwemfeest->end_time = $endH;
        $zwemfeest->amount = $amount;
        $zwemfeest->status = $active;
        $zwemfeest->name = $name;
        $zwemfeest->email = $email;
        $zwemfeest->save();
        $notification = array(
            'message' => 'Zwemfeest is succesvol aangemaakt',
            'alert-type' => 'success'
        );
        return back()->with($notification);

    }


    public function edit(Request $request)
    {
        $rates = Rate::get();
        $meals = Meal::get();
        $users = User::get();

        $zwemfeestId = (int)$request->input('zwemfeestId');
        $zwemfeest = SwimmingParty::find($zwemfeestId);


        return view('admin.zwemfeest.edit', compact('zwemfeest', 'meals', 'rates', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SwimmingParty  $swimmingParty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $zwemfeestId = (int)$request->input('zwemfeestId');
        $zwemfeest = SwimmingParty::find($zwemfeestId);

        if((int)$request->input('rate')){
            $zwemfeest->rate_id = (int)$request->input('rate');
        }
        else{;}


        if($request->input('date')){
            $zwemfeest->date = $request->input('date');
        }
        else{;}

        if($request->input('meal')){
            $zwemfeest->meal_id = $request->input('meal');
        }
        else{;}

        if($request->input('amount')){
            $zwemfeest->amount = $request->input('amount');
        }
        else{;}

        if($request->input('startH')){
            $zwemfeest->start_time = $request->input('startH');
        }
        else{;}

        if($request->input("EndH")){
            $zwemfeest->end_time = $request->input('EndH');
        }
        else{;}
        if($request->input("name"))
        {
            $zwemfeest->name = $request->input("name");
        }
        if($request->input("email"))
        {
            $zwemfeest->email = $request->input("email");
        }

        $zwemfeest->status= (int)$request->status;

        $zwemfeest->save();

        return redirect('/admin/zwemfeest');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SwimmingParty  $swimmingParty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = (int)$request->input('myid');

        $zwemfeest = SwimmingParty::find($id);
        $zwemfeest->delete();

        $sendMail = new stdClass();
        $sendMail->property = 'name'; $sendMail->name = $zwemfeest->user->name;
        $sendMail->property = 'message'; $sendMail->message = "Uw zweemfeest is afgekeurd";
        $sendMail->property = 'email'; $sendMail->email = $zwemfeest->user->email;

        $newEmail = new ContactMail($sendMail);
        Mail::to($sendMail)
            ->send($newEmail);

        $notification = array(
            'message' => 'Het zwemfeest is verwijderd',
            'alert-type' => 'error'
        );
        return back()->with($notification);
    }

    public function sendEmail(Request $request)
    {
        // Send email
        $email = new BevestigingsMail($request);
//         return $email;       // uncomment this line to display the result in the browser
        \Mail::to($request)      // or Mail::to($request->email, $request->name)
        ->send($email);

        $notification = array(
            'message' => 'De bevestiging is verstuurd.',
            'alert-type' => 'success'
        );

        return redirect('/admin/zwemfeest')->with($notification);
    }
}
