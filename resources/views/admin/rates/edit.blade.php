@extends('layouts.template')

@section('title', 'Tarief aanpassen')

@section('main')
    <h1>Tarief aanpassen: {{ $rate->name }}</h1>
    @include('shared.alert')
    <form action="/admin/rates/{{ $rate->id }}" method="post">
        @method('put')
        @csrf
        <div class="form-group">
            <label for="name">Tarief</label>
            <input type="text" name="name" id="name"
                   class="form-control @error('name') is-invalid @enderror"
                   placeholder="Voer een naam in"
                   minlength="3"
                   required
                   value="{{ old('name', $rate->name) }}">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="price">Prijs</label>
            <input type="text" name="price" id="price"
                   class="form-control @error('price') is-invalid @enderror"
                   placeholder="Voer de prijs in"
                   minlength="2"
                   required
                   value="{{ old('price', $rate->price) }}">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Aanpassen</button>
    </form>
@endsection
