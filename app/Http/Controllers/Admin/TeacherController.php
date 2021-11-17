<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\TeacherMail;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = User::orderBy('name')
            ->where('teacher', true)
            ->get();
        $result = compact('teachers');
        return view('admin.teachers.index', $result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email|unique:users'
        ]);

        $teacher = new User();
        $teacher->name = $request->name;
        $teacher->street = $request->street;
        $teacher->house_number = $request->house_number;
        $teacher->postal_code = $request->postal_code;
        $teacher->place = $request->place;
        $teacher->phone_number = $request->phone_number;
        $teacher->email = $request->email;
        $teacher->password = Hash::make($request->password);
        $teacher->teacher = true;
        $teacher->save();

        //send email with password
        $email = new TeacherMail($request);
        //return $email;
        Mail::to($request)
            ->send($email);

        session()->flash('success', "De zwemleraar <b>$teacher->name</b> is toegevoegd. <br> Een mail is verstuurd naar <b>$teacher->email</b>");
        return redirect('admin/teachers');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function edit(User $teacher)
    {
        $result = compact('teacher');
        return view('admin.teachers.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\School  $school
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, User $teacher)
    {
        $this->validate($request,[
            'name' => 'required|min:3|unique:schools,name,' . $teacher->id
        ]);
        $teacher->name = $request->name;
        $teacher->street = $request->street;
        $teacher->house_number = $request->house_number;
        $teacher->postal_code = $request->postal_code;
        $teacher->place = $request->place;
        $teacher->phone_number = $request->phone_number;
        $teacher->email = $request->email;
        $teacher->password = Hash::make($request->password);
        $teacher->save();
        session()->flash('success', "De zwemleraar <b>$teacher->name</b> is gewijzigd");
        return redirect('admin/teachers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy(User $teacher)
    {
        $teacher->delete();
        session()->flash('success', "De zwemleraar <b>$teacher->name</b> is verwijderd");
        return redirect('admin/teachers');
    }
}
