@extends('layouts.template')

@section('title', 'Scholen')

@section('main')
    <h1>Scholen beheren</h1>
    @include('shared.alert')
    <p>
        <a class="btn btn-nueva btn-success" data-toggle="modal" data-target="#addModal">
            <i class="fas fa-plus-circle mr-1"></i>
            Voeg een school toe
        </a>
        <a class="btn btn-primary video-btn" data-toggle="modal" data-target="#videoModal">
            <i class="fa fa-question"></i>
            Info
        </a>
    </p>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-light table-striped">
            <thead class="thead-dark">
            <tr>
                <th>Schoolnaam</th>
                <th>Adres</th>
                <th>Telefoon</th>
                <th>E-mail</th>
                <th>Actie</th>
            </tr>
            </thead>
            <tbody>
            @foreach($schools as $school)
                <tr>
                    <td>{{ $school->name }}</td>
                    <td>{{ $school-> street . ' ' . $school-> house_number . ', ' . $school-> postal_code . ' ' . $school->place }}</td>
                    <td>{{ $school->phone_number }}</td>
                    <td>{{ $school->email }}</td>
                    <td>
                        <div class="container">
                            <div class="row">
                                {{--Formulier voor het aanpassen v/e school--}}
                                <form action="/admin/school/{{ $school->id }}" method="post" class="pr-1">
                                    @method('put')
                                    @csrf
                                    <div class="btn-group btn-group-sm">
                                        <a href="/admin/schools/{{ $school->id }}/edit" class="btn btn-outline-success"
                                           data-toggle="tooltip"
                                           title="Wijzig {{ $school->name }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </form>
                                {{--Formulier voor het verwijderen v/e school--}}
                                <form action="/admin/schools/{{ $school->id }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <div class="btn-group btn-group-sm">
                                    <button type="submit" class="btn btn-outline-danger deleteSchool"
                                            data-toggle="tooltip"
                                            title="Verwijder {{ $school->name }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{--Modal voor het toevoegen v/e nieuwe school--}}
    <div class="modal fade" id="addModal" tabindex="-1" role="document" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Voeg een school toe</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/admin/schools/" method="post">
                        @method('post')
                        @csrf
                        <div class="form-group">
                            <label for="name">Naam</label>
                            <input type="text" name="name" id="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   placeholder="Voer de schoolnaam in"
                                   minlength="3"
                                   required>
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
                                       required>
                                @error('street')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="house_number">Huisnummer</label>
                                <input type="text" name="house_number" id="house_number"
                                       class="form-control @error('house_number') is-invalid @enderror"
                                       placeholder="Voer het huisnummer in"
                                       required>
                                @error('house_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="postal_code">Postcode</label>
                                <input type="text" name="postal_code" id="postal_code"
                                       class="form-control @error('postal_code') is-invalid @enderror"
                                       placeholder="Voer de postcode in"
                                       minlength="3"
                                       required>
                                @error('postal_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="place">Plaats</label>
                                <input type="text" name="place" id="place"
                                       class="form-control @error('place') is-invalid @enderror"
                                       placeholder="Voer vestigingsplaats in"
                                       minlength="3"
                                       required>
                                @error('place')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Contactgegevens</legend>
                            <div class="form-group">
                                <label for="phone_number">Telefoonnummer</label>
                                <input type="text" name="phone_number" id="phone_number"
                                       class="form-control @error('phone_number') is-invalid @enderror"
                                       placeholder="Voer een telefoonnummer in"
                                       minlength="3"
                                       required>
                                @error('phone_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="email" name="email" id="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       placeholder="Voer de schoolmail in"
                                       minlength="3"
                                       required>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </fieldset>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Afsluiten</button>
                            <button type="submit" class="btn btn-success">Aanmaken</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{--Modal voor Video--}}
    <div class="modal fade" id="videoModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <video width="100%" controls>
                        <source src="/assets/video/Scholen_aanmaken.mkv" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script_after')
    <script>
        $(function () {
            $('.deleteSchool').click(function () {
                let msg = `Deze school verwijderen?`;
                if(confirm(msg)) {
                    $(this).closest('form').submit();
                }
            })
        });
    </script>
@endsection
