@extends('layouts.template')

@section('title', 'Facturen')

@section('main')

    <h1>Facturen goedkeuren en versturen</h1>
    @include('shared.alert')



    <div class="table-responsive">
        <table class="table table-bordered table-hover table-light table-striped">
            <thead class="thead-dark">
            <tr>
                <th>Datum</th>
                <th>Klas</th>
                <th>Aantal</th>
                <th>Prijs</th>
            </tr>
            </thead>
        </table>
    </div>

@endsection
