@extends('layouts.template')
@section('title', 'Contacteer ons')

@section('main')
    <h1>Neem contact op</h1>
    @include('shared.alert')

    @if (!session()->has('success'))
    <form action="/contact-us" method="post" novalidate>
        @csrf
        <div class="form-group">
            <label for="name">Naam</label>
            <input type="text" name="name" id="name"
                   class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}"
                   placeholder="Vul uw naam in"
                   required
                   value="{{ old('name') }}">
            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
        </div>
        <div class="form-group">
            <label for="email">E-mailadres</label>
            <input type="email" name="email" id="email"
                   class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}"
                   placeholder="Vul uw e-mail in"
                   required
                   value="{{ old('email') }}">
            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
        </div>
        <div class="form-group">
            <label for="message">Bericht</label>
            <textarea name="message" id="message" rows="5"
                      class="form-control {{ $errors->first('message') ? 'is-invalid' : '' }}"
                      placeholder="Typ uw bericht"
                      required
                      minlength="10">{{ old('message') }}</textarea>
            <div class="invalid-feedback">{{ $errors->first('message') }}</div>
        </div>
        <button type="submit" class="btn btn-success">Versturen</button>
    </form>
    @endif
@endsection

