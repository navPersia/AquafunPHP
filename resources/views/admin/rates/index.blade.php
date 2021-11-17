@extends('layouts.template')

@section('title', 'Tarieven')

@section('main')
    <h1>Tarieven instellen</h1>
    @include('shared.alert')
    <p>
        <a class="btn btn-nueva btn-success" data-toggle="modal" data-target="#addModal">
            <i class="fas fa-plus-circle mr-1"></i>
            Voeg een tarief toe
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
                <th>Tarief</th>
                <th>Prijs (p.p)</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rates as $rate)
                <tr>
                    <td>{{ $rate->name }}</td>
                    <td>{{ $rate->price }}</td>
                    <td>
                        <div class="container">
                            <div class="row">
                                {{--Formulier voor het aanpassen v/e tarief--}}
                                <form action="/admin/rate/{{ $rate->id }}" method="post" class="pr-1">
                                    @method('put')
                                    @csrf
                                    <div class="btn-group btn-group-sm">
                                        <a href="/admin/rates/{{ $rate->id }}/edit" class="btn btn-outline-success"
                                           data-toggle="tooltip"
                                           title="Wijzig {{ $rate->name }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </form>
                                {{--Formulier voor het verwijderen v/e tarief--}}
                                <form action="/admin/rates/{{ $rate->id }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-outline-danger deleteRate"
                                                data-toggle="tooltip"
                                                data-rate="{{ $rate->name }}"
                                                title="Verwijder {{ $rate->name }}">
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

    {{--Modal voor het toevoegen v/e tarief--}}
    <div class="modal fade" id="addModal" tabindex="-1" role="document" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Voeg een tarief toe</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/admin/rates/" method="post">
                        @method('post')
                        @csrf
                        <div class="form-group">
                            <label for="name">Tarief</label>
                            <input type="text" name="name" id="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   placeholder="Voer een naam in"
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
                                   minlength="1"
                                   required>
                            <small id="priceHelp" class="form-text text-muted">Prijs per persoon</small>
                            @error('prijs')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
                        <source src="/assets/video/Tarieven_aanmaken.mkv" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script_after')
    <script>
        $(function () {
            $('.deleteRate').click(function () {
                let rate = $(this).data('rate')
                let msg = `Verwijder ${rate}?`;
                if(confirm(msg)) {
                    $(this).closest('form').submit();
                }
            })
        });
    </script>
@endsection
