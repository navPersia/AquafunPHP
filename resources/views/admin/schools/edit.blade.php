@extends('layouts.template')

@section('title', 'School aanpassen')

@section('main')
    <h1>School aanpassen: {{ $school->name }}</h1>
    @include('shared.alert')
    <form action="/admin/schools/{{ $school->id }}" method="post">
        @method('put')
        @csrf
        <div class="form-group">
            <label for="name">Naam</label>
            <input type="text" name="name" id="name"
                   class="form-control @error('name') is-invalid @enderror"
                   placeholder="Voer de schoolnaam in"
                   minlength="3"
                   required
                   value="{{ old('name', $school->name) }}">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <fieldset>
            <legend>Adres</legend>
            <div class="form-group">
                <label for="street">Straat</label>
                <input type="text" name="street" id="street"
                       class="form-control @error('street') is-invalid @enderror"
                       placeholder="Voer de straatnaam in"
                       minlength="3"
                       required
                       value="{{ old('street', $school->street) }}">
                @error('street')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="house_number">Huisnummer</label>
                        <input type="text" name="house_number" id="house_number"
                               class="form-control @error('house_number') is-invalid @enderror"
                               placeholder="Voer het huisnummer in"
                               required
                               value="{{ old('house_number', $school->house_number) }}">
                        @error('house_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="postal_code">Postcode</label>
                        <input type="text" name="postal_code" id="postal_code"
                               class="form-control @error('postal_code') is-invalid @enderror"
                               placeholder="Voer de postcode in"
                               minlength="3"
                               required
                               value="{{ old('postal_code', $school->postal_code) }}">
                        @error('postal_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="place">Plaats</label>
                        <input type="text" name="place" id="place"
                               class="form-control @error('place') is-invalid @enderror"
                               placeholder="Voer vestigingsplaats in"
                               minlength="3"
                               required
                               value="{{ old('place', $school->place) }}">
                        @error('place')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Contactgegevens</legend>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="phone_number">Telefoonnummer</label>
                        <input type="text" name="phone_number" id="phone_number"
                               class="form-control @error('phone_number') is-invalid @enderror"
                               placeholder="Voer een telefoonnummer in"
                               minlength="3"
                               required
                               value="{{ old('phone_number', $school->phone_number) }}">
                        @error('phone_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="Voer de schoolmail in"
                               minlength="3"
                               required
                               value="{{ old('email', $school->email) }}">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </fieldset>
        <button type="submit" class="btn btn-success">Aanpassen</button>
    </form>
@endsection
