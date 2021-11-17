@extends('layouts.template')

@section('title', 'Maaltijden')

@section('main')
    <h1>Maaltijden beheren</h1>
    @include('shared.alert')
    <p>
        <a class="btn btn-nueva btn-success" data-toggle="modal" data-target="#addModal">
            <i class="fas fa-plus-circle mr-1"></i>
            Voeg een maaltijd toe
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
                    <th>Maaltijd</th>
                    <th>Prijs</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($meals as $meal)
                    <tr>
                        <td>{{ $meal->name }}</td>
                        <td>{{ $meal->price }}</td>

                        @if($meal->status == 1)
                            <td class="bg-success list-unstyled text-center justify-content-center col-2">Beschikbaar</td>
                        @else
                            <td class="bg-danger list-unstyled text-center justify-content-center col-2">Op</td>
                            @endif

                        <td>
                            <div class="container">
                                <div class="row">
                                    {{--Formulier voor het aanpassen v/e maaltijd--}}
                                    <form action="/admin/meal/{{ $meal->id }}" method="post" class="pr-1">
                                        @method('put')
                                        @csrf
                                        <div class="btn-group btn-group-sm">
                                            <a href="/admin/meals/{{ $meal->id }}/edit" class="btn btn-outline-success"
                                               data-toggle="tooltip"
                                               title="Wijzig {{ $meal->name }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </div>
                                    </form>
                                    {{--Formulier voor het verwijderen v/e maaltijd--}}
                                    <form action="/admin/meals/{{ $meal->id }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <div class="btn-group btn-group-sm">
                                            <button type="button" class="btn btn-outline-danger deleteMeal"
                                                    data-toggle="tooltip"
                                                    data-meal="{{ $meal->name }}"
                                                    title="Verwijder {{ $meal->name }}">
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

    {{--Modal voor het toevoegen v/e maaltijd--}}
    <div class="modal fade" id="addModal" tabindex="-1" role="document" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Voeg een maaltijd toe</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/admin/meals/" method="post">
                        @method('post')
                        @csrf
                        <div class="form-group">
                            <label for="name">Maaltijd</label>
                            <input type="text" name="name" id="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   placeholder="Voer de maaltijd in"
                                   minlength="3"
                                   required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Prijs</label>
                            <input type="text" name="price" id="price"
                                   class="form-control @error('price') is-invalid @enderror"
                                   placeholder="Voer de prijs in"
                                   minlength="1">
                            @error('prijs')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="status" id="status" value="1">
                            <label for="status">Beschikbaar?</label>
                        </div>
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
                        <source src="/assets/video/Maaltijden_aanmaken.mkv" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script_after')
    <script>
        $(function () {
            $('.deleteMeal').click(function () {
                let meal = $(this).data('meal')
                let msg = `Verwijder ${meal}?`;
                if(confirm(msg)) {
                    $(this).closest('form').submit();
                }
            })
        });

    </script>
@endsection
