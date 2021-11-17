<?php

namespace App\Http\Controllers;

use Mail;
use App\Mail\ContactMail;
use App\Meal;
use App\Rate;
use App\SwimmingParty;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use stdClass;

class ReservationController extends Controller
{
    // Show the reservation form
    public function show()
    {
        $meals = Meal::where('status', '=', 1)->get();
        $rates = Rate::get();
        return view('reservation', compact('meals', 'rates'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email|unique:users'
        ]);

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
        if($naamFeest = $request->input("naamFeest")){;}
        else{$notification = array(
            'alert-type' => 'warning'
        );
            return back()->with($notification);}
        if($email = $request->input("email")){;}
        else{$notification = array(
            'message' => 'de e-mail moet ingevuld worden',
            'alert-type' => 'warning'
        );
            return back()->with($notification);}

        function randomPassword() {
            $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            $pass = array(); //remember to declare $pass as an array
            $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
            for ($i = 0; $i < 8; $i++) {
                $n = rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
            }
            return implode($pass);
        }

        $user = new User();
        $user->name = $request->input("Name");
        $user->email = $request->input("email");
        $password = randomPassword();
        $user->password = Hash::make($password);
        $user->save();

        $sendMail = new stdClass();
        $sendMail->property = 'name'; $sendMail->name = $name;
        $sendMail->property = 'message'; $sendMail->message = "Onderaan vindt u uw inloggegevens <br> E-mail: " . $email . "<br>Wachtwoord: " . $password;
        $sendMail->property = 'email'; $sendMail->email = $email;

        $zwemfeest = new SwimmingParty();
        $zwemfeest->user_id = $user->id;
        $zwemfeest->rate_id = $rate;
        $zwemfeest->date = $date;
        $zwemfeest->meal_id = $meal;
        $zwemfeest->start_time = $startH;
        $zwemfeest->end_time = $endH;
        $zwemfeest->amount = $amount;
        $zwemfeest->status = 0;
        $zwemfeest->name = $naamFeest;
        $zwemfeest->email = $email;
        $zwemfeest->save();

        $newEmail = new ContactMail($sendMail);
        Mail::to($sendMail)
            ->send($newEmail);
        $notification = array(
        'message' => 'De e-mail is verstuurd',
        'alert-type' => 'success'
        );

        return back()->with($notification);
    }

    // Send email
    public function sendEmail(Request $request)
    {
        // Validate form

        // Send email

        // Redirect to the contact-us link
        return redirect('reservation');
    }
}
