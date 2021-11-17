@extends('layouts.template')
@section('title', 'AquaFun')

@section('main')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">Zwemfeest reserveren</h3>
            </div>
            <div class="card-body">
                <form action="reservation/" method="post">
                    @csrf
                    @method('post')
                    <div class="form-group">
                        <label for="naamFeest" class="col-form-label">Naam v/t feest:</label>
                        <input type="text" id="naamFeest" name="naamFeest">
                    </div>
                    <div class="form-group" >
                        <label for="rate" class="col-form-label">Tarief:</label>
                        <select name="rate" id="rate">
                            <option value="Non">------</option>
                            @foreach ($rates as $rate)
                                <option value="{{ $rate->id }}">{{ $rate->name }} -- {{ $rate->price }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="date">Datum:</label>
                        <input type="date" id="date" name="date" required>
                    </div>
                    <div class="form-group" >
                        <label for="meal" class="col-form-label">Maaltijd:</label>
                        <select name="meal" id="meal">
                            <option value="Non">------</option>
                            @foreach ($meals as $meal)
                                <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="amount" class="col-form-label">Aantal personen:</label>
                        <input type="number" id="amount" name="amount">
                    </div>
                    <div class="form-group">
                        <label for="startH" class="col-form-label">Start:</label>
                        <input type="time" id="startH" name="startH">
                    </div>
                    <div class="form-group">
                        <label for="EndH" class="col-form-label">Einde:</label>
                        <input type="time" id="EndH" name="EndH">
                    </div>
                    <div class="form-group">
                        <label for="Name" class="col-form-label">Naam klant:</label>
                        <input type="text" id="Name" name="Name">
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-form-label">E-mail klant:</label>
                        <input type="text" id="email" name="email">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Versturen</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <script type="text/javascript">
        $(function () {
            $('#datetimepicker1').datepicker({
                format: "mm/dd/yy",
                weekStart: 0,
                calendarWeeks: true,
                autoclose: true,
                todayHighlight: true,
                orientation: "auto"
            });
        });
    </script>
    <script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
@endsection
