@extends('layouts.template')

@section('title', 'Zwemfeest')

@section('main')

    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-8 col-xl-6">
                    <div class="row">
                        <div class="col text-center">
                            <h1>Zwemfeest aanpassen</h1>
                        </div>
                    </div>
                    <form action="/admin/zwemfeest/update" method="post">
                        @csrf
                        @method('put')

                        <div class="row align-items-center mt-4">
                            <div class="col">
                                <div class="form-group">
                                    <label for="name" class="col-form-label">naam klant:  </label></br>
                                    <input type="text" id="name" name="name" value="{{ $zwemfeest->name }}">
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center mt-4">
                            <div class="col">
                                <div class="form-group">
                                    <label for="email" class="col-form-label">email klant:  </label></br>
                                    <input type="text" id="email" name="email" value="{{ $zwemfeest->email }}">
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center mt-4">
                            <div class="col">
                                <label for="date" class="col-form-label">Datum:</label></br>
                                <input type="date" id="date" name="date" value="{{$zwemfeest->date}}">
                            </div>
                        </div>

                        <div class="row align-items-center mt-4">
                            <div class="col">
                                <label for="rate_id" class="col-form-label">Rate:</label></br>
                                <select name="rate_id" class="form-control">
                                    @foreach ($rates as $rate)
                                        @if ($rate->id == $zwemfeest->rate_id)
                                            <option selected value="{{ $rate->id }}">{{ $rate->name }} -- {{ $rate->price }}</option>
                                        @else
                                            <option value="{{ $rate->id }}">{{ $rate->name }} -- {{ $rate->price }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row align-items-center mt-4">
                            <div class="col">
                                <div class="form-group">
                                    <label for="startH" class="col-form-label">Start uur:    </label></br>
                                    <input type="time" id="startH" name="startH" value="{{ $zwemfeest->start_time }}">
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-center mt-4">
                            <div class="col">
                                <div class="form-group">
                                    <label for="EndH" class="col-form-label">Eind uur: </label></br>
                                    <input type="time" id="EndH" name="EndH" value="{{ $zwemfeest->end_time }}">
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center mt-4">
                            <label for="amount" class="col-form-label">hoeveelheid personen:</label>
                            <input type="number" id="amount" name="amount" value="{{$zwemfeest->amount}}">
                        </div>
                        <input hidden type="text" value="{{ $zwemfeest->id }}" name="zwemfeestId" >
                        <div class="row align-items-center">
                            <div class="col mt-4">
                                <label for="maaltijd" class="col-form-label">Maaltijd:</label></br>
                                <select name="meal" class="form-control">
                                    @foreach ($meals as $meal)
                                            @if ($meal->id == $zwemfeest->meal_id)
                                                <option selected value="{{ $meal->id }}">{{ $meal->name }}</option>
                                            @else
                                                <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                                            @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row align-items-center mt-4">
                            <div class="col">
                                <div class="form-check">
                                    @if ($zwemfeest->status == 1)
                                        <input name="status" class="form-check-input" type="checkbox" value="1" id="flexCheckChecked" checked>
                                    @else
                                        <input name="status" class="form-check-input" type="checkbox" value="1" id="flexCheckChecked">
                                    @endif
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Actief
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-start mt-4">
                            <div class="col">
                                <button type="submit" class="btn btn-success mt-4">Versturen</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
@endsection
