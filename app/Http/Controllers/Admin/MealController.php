<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Json;
use App\Http\Controllers\Controller;
use App\Meal;
use Illuminate\Http\Request;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meals = Meal::orderBy('name')
            ->get();
        $result = compact('meals');
        return view('admin.meals.index', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('admin/meals');
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
            'name' => 'required|min:3|unique:meals,name'
        ]);

        $meal = new Meal();
        $meal->name = $request->name;
        $meal->price = (double)$request->price;
        $meal->status = (int)$request->status;
        $meal->save();
        session()->flash('success', "De maaltijd <b>$meal->name</b> is toegevoegd");
        return redirect('admin/meals');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function show(Meal $meal)
    {
        return redirect('admin/meals');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function edit(Meal $meal)
    {
        $result = compact('meal');
        return view('admin.meals.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meal $meal)
    {
        $this->validate($request,[
            'name' => 'required|min:3|unique:meals,name,' . $meal->id
        ]);
        $meal->name = $request->name;
        $meal->price = (double)$request->price;
        $meal->status = (int)$request->status;
        $meal->save();
        session()->flash('success', "De maaltijd <b>$meal->name</b> is aangepast");
        return redirect('admin/meals');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meal $meal)
    {
        $meal->delete();
        session()->flash('success', "De maaltijd <b>$meal->name</b> is verwijderd");
        return redirect('admin/meals');
    }
}
