<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Json;
use App\Http\Controllers\Controller;
use App\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools = School::orderBy('name')
            ->get();
        $result = compact('schools');
        \Facades\App\Helpers\Json::dump($result);
        return view('admin.schools.index', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('admin/schools');
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
            'email' => 'required|email|unique:schools'
        ]);

        $school = new School();
        $school->name = $request->name;
        $school->street = $request->street;
        $school->house_number = $request->house_number;
        $school->postal_code = $request->postal_code;
        $school->place = $request->place;
        $school->phone_number = $request->phone_number;
        $school->email = $request->email;
        $school->save();
        session()->flash('success', "De school <b>$school->name</b> is toegevoegd");
        return redirect('admin/schools');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        return redirect('admin/schools');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
        $result = compact('school');
        return view('admin.schools.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\School  $school
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, School $school)
    {
        $this->validate($request,[
            'name' => 'required|min:3|unique:schools,name,' . $school->id
        ]);
        $school->name = $request->name;
        $school->street = $request->street;
        $school->house_number = $request->house_number;
        $school->postal_code = $request->postal_code;
        $school->place = $request->place;
        $school->phone_number = $request->phone_number;
        $school->email = $request->email;
        $school->save();
        session()->flash('success', "De school <b>$school->name</b> is aangepast");
        return redirect('admin/schools');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy(School $school)
    {
        $school->delete();
        session()->flash('success', "De school <b>$school->name</b> is verwijderd");
        return redirect('admin/schools');
    }
}
