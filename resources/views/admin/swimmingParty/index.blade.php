@extends('layouts.template')

@section('title', 'ZWEMFEEST GOEDKEUREN PAGE!')

@section('main')

    <div class="table-responsive-sm">

        <div class="title-box mb-3">
            <h1>Zwemfeest goedkeuren</h1>
        </div>

        @if($swimmingParties)
            <?php $teler = 0; ?>
            @foreach ($swimmingParties as $swimmingParty)
                @if($swimmingParty->status != 1)
                <table class="table table-bordered table-hover table-light table-striped">
                    <thead class="thead-dark">
                        <tr class="d-flex">
                        <th class="col-1" scope="col">Number</th>
                        <th class="col-2" scope="col">Feest eigenaar</th>
                        <th class="col-1" scope="col">Datum</th>
                        <th class="col-1" scope="col">Start uur</th>
                        <th class="col-1" scope="col">Eind uur</th>
                        <th class="col-1" scope="col">Amount</th>
                        <th class="col-2" scope="col">Rate</th>
                        <th class="col-2" scope="col">Maaltijd</th>
                        <th class="col-1" scope="col">Actie</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $teler = $teler + 1; ?>
                        <tr class="d-flex">
                            <th class="col-1" scope="col">{{ $teler }}</th>
                            <td class="col-2" scope="col">
                            {{ $swimmingParty->user->name }}
                            </td>
                            <td class="col-1" scope="col">
                            {{ $swimmingParty->date->toDateString() }}
                            </td>
                            <td class="col-1" scope="col">
                            {{ $swimmingParty->start_time->toTimeString() }}
                            </td>
                            <td class="col-1" scope="col">
                            {{ $swimmingParty->end_time->toTimeString() }}
                            </td>
                            <td class="col-1" scope="col">
                            {{ $swimmingParty->amount }}
                            </td>
                            <td class="col-2" scope="col">
                            {{ $swimmingParty->rate->name }} - {{ $swimmingParty->rate->price  }}
                            </td>
                            <td class="col-2" scope="col">
                            {{ $swimmingParty->meal->name }}
                            </td>
                            
                            <td class="bg-warning list-unstyled text-center justify-content-center col-1">Klik om toestaan</td>
                        </tr>
                    </tbody>
                </table>
                @else
                    <div class="alert alert-warning" role="alert">
                        Er is geen zwemfeest om goedkeuren!
                    </div>
                @endif
            @endforeach
        @else
        <div class="alert alert-warning" role="alert">
            Er is geen zwemfeest om goedkeuren!
        </div>
        @endif
    </div>
@endsection