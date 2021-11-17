<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Rate;
use Illuminate\Http\Request;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rates = Rate::orderBy('name')->get();
        $result = compact('rates');
        return view('admin.rates.index', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('admin/rates');
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
            'name' => 'required|min:3|unique:rates,name'
        ]);

        $rate = new Rate();
        $rate->name = $request->name;
        $rate->price = (double)$request->price;
        $rate->save();
        session()->flash('success', "De tarief <b>$rate->name</b> is toegevoegd");
        return redirect('admin/rates'); //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function show(Rate $rate)
    {
        return redirect('admin/rates');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function edit(Rate $rate)
    {
        $result = compact('rate');
        return view('admin.rates.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rate $rate)
    {
        $this->validate($request,[
            'name' => 'required|min:3|unique:rates,name,' . $rate->id
        ]);
        $rate->name = $request->name;
        $rate->price = $request->price;
        $rate->save();
        session()->flash('success', 'De tarief is aangepast');
        return redirect('admin/rates');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rate $rate)
    {
        $rate->delete();
        session()->flash('success', "De tarief <b>$rate->name</b> is verwijderd");
        return redirect('admin/rates');
    }
}
