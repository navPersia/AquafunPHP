<?php

namespace App\Http\Controllers\Admin;

use App\SwimmingLesson;
use App\User;
use App\Rate;
use App\Choice;
use App\UserSwimmingLesson;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\InvoicePaid;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Mail\ContactMail;
use stdClass;


class zwemmers extends Controller
{
    public function index()
    {

        $zwemlesen = SwimmingLesson::get();
        return view('admin.zwemmers.index', compact('zwemlesen'));
    }

    public function detailPage(Request $request)
    {
        $zwemlesId = (int)$request->input('zwemlesId');
        $choices = Choice::where('swimming_lesson_id', $zwemlesId)->get();
        $userSwimmingLessons = UserSwimmingLesson::where('swimming_lesson_id','=', $zwemlesId)->get();
        return view('admin.zwemmers.detail', compact('userSwimmingLessons', 'choices','zwemlesId'));
    }

     // create user profile
     public function store(Request $request)
     {
        if($user = (int)$request->input('userId')){;}
        else{
            $notification = array(
                'message' => 'De Klant moet gekozen worden',
                'alert-type' => 'warning'
            );
            return back()->with($notification);
        }
        $userId = (int)$request->input('userId');
        $swimminglessonId = (int)$request->input('swimminglessonId');
        $status = $request->input('status');

        $userSwimmingLesson = new UserSwimmingLesson();
        $userSwimmingLesson->user_id = $userId;
        $userSwimmingLesson->swimming_lesson_id = $swimminglessonId;
        $userSwimmingLesson->name = $status;

        $userSwimmingLesson->save();
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
        if((int)$request->input('userId') && (int)$request->input('userSwimmingLessonId')){
            $useriId = (int)$request->input('userId');
            $userSwimmingLessonId = (int)$request->input('userSwimmingLessonId');

            $userSwimmingLesson = UserSwimmingLesson::find($userSwimmingLessonId);
            $userSwimmingLesson->delete();

            $notification = array(
                'message' => 'Zwemmer is verwijderd',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }else{
            $useriId = (int)$request->input('userId');
            $user = User::find($useriId);
            if(UserSwimmingLesson::where('user_id','=', $useriId)->get()){
                $userSwimmingLessons = UserSwimmingLesson::where('user_id','=', $useriId)->get();
                foreach($userSwimmingLessons as $userSwimmingLessons){
                    $userSwimmingLessons->delete();
                }
                $notification = array(
                    'message' => 'Zwemmer is verwijderd. Let op er zijn ook andere records mee verwijderd!',
                    'alert-type' => 'error'
                );
            }
            $user->delete();


            return back()->with($notification);
        }


    }

    public function storeUser(Request $request)
     {
         // Validate $request
        $this->validate($request,[
            'email' => 'required|email|unique:users'
        ]);
        $zwemlesId = (int)$request->input('swimminglessonId');

        if($firstName = $request->input('firstName') &&
        $lastName = $request->input('lastName') &&
        $phone = $request->input('phone') &&
        $street = $request->input('street') &&
        $homeNumber = $request->input('homeNumber') &&
        $place = $request->input('place') &&
        $postalCode = $request->input('postalCode') &&
        $bDate = $request->input('bDate')
        ){
        $firstName = $request->input('firstName');
        $lastName = $request->input('lastName');
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

        function randomPassword() {
            $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            $pass = array(); //remember to declare $pass as an array
            $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
            for ($i = 0; $i < 8; $i++) {
                $n = rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
            }
            return implode($pass); //turn the array into a string
        }

        $user = new User();
        $user->name = $firstName . " " . $lastName;
        $user->phone_number = $phone;
        $user->street = $street;
        $user->house_number = $homeNumber;
        $user->mailbox_number = $mailboxNumber;
        $user->postal_code = $postalCode;
        $user->place = $place;
        $user->birth_date = $bDate;
        $user->remark = $remark;
        $user->email = $email;
        $password = randomPassword();
        $user->password = Hash::make($password);

        $user->save();

        $choice = new Choice();
        $choice->user_id = $user->id;
        $choice->swimming_lesson_id = $zwemlesId;
        $choice->save();
        $notification = array(
            'message' => 'User is succesvol aangemaakt',
            'alert-type' => 'success'
        );

        $sendMail = new stdClass();
        $sendMail->property = 'name'; $sendMail->name = $firstName . " " . $lastName;
        $sendMail->property = 'message'; $sendMail->message = "Onderaan vindt u uw inlog gegevens <br> Username: " . $email . "<br>Password: " . $password;
        $sendMail->property = 'email'; $sendMail->email = $email;

        $newEmail = new ContactMail($sendMail);
        Mail::to($sendMail)
        ->send($newEmail);

        return back()->with($notification);
     }

     public function allUsers(){
        $users = User::get();
        $swimmingLessons = SwimmingLesson::get();
        return view('admin.zwemmers.allUsers', compact('users', 'swimmingLessons'));
     }

     public function edit(Request $request)
    {
        $userId = (int)$request->input('userId');
        $user = User::find($userId);
        $swimmingLessons = SwimmingLesson::get();
        $choices = Choice::get();

        return view('admin.zwemmers.edit', compact('user', 'swimmingLessons', 'choices'));
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

        if($choiceId != 0){
            $choice = new Choice();
            $choice->user_id = $user->id;
            $choice->swimming_lesson_id = $choiceId;
            $choice->save();
        }

        $notification = array(
            'message' => 'Zwemmer is aangepast',
            'alert-type' => 'success'
        );

        return redirect('/admin/zwemmers/lijst')->with($notification);
    }

    public function resetpassword(Request $request){
        $userId = (int)$request->input('userId');
        $user = User::find($userId);
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
            'message' => 'Password is gereset en de nieuwe password is doorgestuurd naar ' . $user->email,
            'alert-type' => 'success'
        );

        $sendMail = new stdClass();
        $sendMail->property = 'name'; $sendMail->name = $user->name;
        $sendMail->property = 'message'; $sendMail->message = "Onderaan vindt u uw inlog gegevens <br> Username: " . $user->email . "<br>Password: " . $password;
        $sendMail->property = 'email'; $sendMail->email = $user->email;

        $newEmail = new ContactMail($sendMail);
        Mail::to($sendMail)
        ->send($newEmail);

        return back()->with($notification);
    }

}
