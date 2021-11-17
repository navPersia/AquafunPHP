<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SwimmingLesson;
use App\User;
use App\Rate;
use App\UserSwimmingLesson;
use App\Http\Controllers\Controller;
use App\Notifications\InvoicePaid;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Mail\ContactMail;
use stdClass;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(auth()->id());

        return view('update', compact('user'));
    }

    public function update(Request $request)
    {
        $userId = (int)$request->input('userId');
        $user = User::find($userId);

        // Validate $request
        if($request->input('email') != $user->email){
            $this->validate($request,[
                'email' => 'required|email|unique:users'
            ]);
        };

        if($name = $request->input('name') && 
        $phone = $request->input('phone') && 
        $street = $request->input('street') && 
        $homeNumber = $request->input('homeNumber') && 
        $place = $request->input('place') && 
        $postalCode = $request->input('postalCode') && 
        $bDate = $request->input('bDate')
        ){
        $name = $request->input('name'); 
        $email = $request->input('email'); 
        $phone = $request->input('phone'); 
        $street = $request->input('street'); 
        $homeNumber = $request->input('homeNumber'); 
        $place = $request->input('place'); 
        $postalCode = $request->input('postalCode');
        $bDate = $request->input('bDate');
        if($mailboxNumber = $request->input('mailboxNumber')){$mailboxNumber = $request->input('mailboxNumber');}
        else{
            $mailboxNumber = "NVT";
        }
        if($remark = $request->input('remark')){$remark = $request->input('remark');}
        else{
            $remark = "NVT";
        }
    }
        else{
            $notification = array(
                'message' => 'Alle velden moeten ingevuld worden',
                'alert-type' => 'warning'
            );
            return back()->with($notification);
        }

        $user->name = $name;
        $user->phone_number = $phone;
        $user->street = $street;
        $user->house_number = $homeNumber;
        $user->mailbox_number = $mailboxNumber;
        $user->postal_code = $postalCode;
        $user->place = $place;
        $user->birth_date = $bDate;
        $user->remark = $remark;
        $user->email = $email;

        $user->save();

        $notification = array(
            'message' => 'Uw profile is aangepast',
            'alert-type' => 'success'
        );

        return redirect('/profile')->with($notification);
    }

    public function resetpassword(Request $request){
        $user = User::findOrFail(auth()->id());
        
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
        
        $password = randomPassword();
        $user->password = Hash::make($password);

        $user->save();
        $notification = array(
            'message' => 'Wachtwoord is gewijzigd en het nieuwe wachtwoord wordt doorgestuurd naar ' . $user->email,
            'alert-type' => 'success'
        );

        $sendMail = new stdClass();
        $sendMail->property = 'name'; $sendMail->name = $user->name; 
        $sendMail->property = 'message'; $sendMail->message = "Onderaan vindt u uw aanmeldgegevens <br> Username: " . $user->email . "<br>Password: " . $password;
        $sendMail->property = 'email'; $sendMail->email = $user->email;

        $newEmail = new ContactMail($sendMail);
        Mail::to($sendMail) 
        ->send($newEmail);

        return back()->with($notification);
    }

}
