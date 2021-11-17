@extends('layouts.template')

@section('title', 'Maaltijd aanpassen')

@section('main')
    <h1>Maaltijd aanpassen: {{ $meal->name }}</h1>
    @include('shared.alert')
    <form action="/admin/meals/{{ $meal->id }}" method="post">
        @method('put')
        @csrf
        <div class="form-group">
            <label for="name">Maaltijd</label>
            <input type="text" name="name" id="name"
                   class="form-control @error('name') is-invalid @enderror"
                   placeholder="Voer de maaltijd in"
                   minlength="3"
                   required
                   value="{{ old('name', $meal->name) }}">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="price">Prijs</label>
            <input type="text" name="price" id="price"
                   class="form-control @error('price') is-invalid @enderror"
                   placeholder="Voer de prijs in"
                   minlength="1"
                   value="{{ old('price', $meal->price) }}">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-check">
            @if ($meal->status == 1)
                <input name="status" class="form-check-input" type="checkbox" value="1" id="flexCheckChecked" checked>
            @else
                <input name="status" class="form-check-input" type="checkbox" value="1" id="flexCheckChecked">
            @endif
            <label class="form-check-label" for="flexCheckChecked">Beschikbaar</label>
        </div>
        <button type="submit" class="btn btn-success">Aanpassen</button>
    </form>
@endsection
