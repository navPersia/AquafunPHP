
@extends('layouts.template')
@section('title', 'homepage zwemfeest')
@section('main')

    <div class="table-responsive-sm">

        <div class="title-box mb-3">
            <h1>Zwemfeest beheren</h1>
        </div>

        <p><a class="btn btn-success btn-nueva" data-toggle="modal" data-target="#addModal" ><b><i class="fas fa-plus-circle mr-1"></i></b> Zwemfeest toevoegen                                    </a>
            <a class="btn btn-primary video-btn" data-toggle="modal" data-target="#videoModal">
                <i class="fa fa-question"></i>
                Info
            </a>
        </p>

        <table class="table table-bordered table-hover table-light table-striped">
            <thead class="thead-dark">
            <tr class="">
                <th class="col-1" scope="col">Number</th>
                <th class="col-2" scope="col">Naam</th>
                <th class="col-2" scope="col">Datum</th>
                <th class="col-1" scope="col">Start uur</th>
                <th class="col-1" scope="col">Eind uur</th>
                <th class="col-1" scope="col">Personen</th>
                <th class="col-2" scope="col">Maaltijd</th>
                <th class="col-2" scope="col">E-mail</th>
                <th class="col-1" scope="col">Status</th>
                <th class="col-1" scope="col">Functies</th>
            </tr>
            </thead>
            <tbody>
            <?php $counter = 0; ?>
            @foreach ($zwemfeestjes as $zwemfeest)

                <?php $counter = $counter + 1; ?>
                <tr class="">
                    <th class="col-1" scope="col">{{ $counter }}</th>
                    <td class="col-2" scope="col">
                        {{ $zwemfeest->name }}
                    </td>
                    <td class="col-2" scope="col">
                        {{ $zwemfeest->date}}
                    </td>
                    <td class="col-1" scope="col">
                        {{ $zwemfeest->start_time }}
                    </td>
                    <td class="col-1" scope="col">
                        {{ $zwemfeest->end_time }}
                    </td>


                    <td class="col-1" scope="col">
                        {{ $zwemfeest->amount}}
                    </td>
                    <td class="col-2" scope="col">
                        {{ $zwemfeest->meal->name}}
                    </td>
                    <td class="col-1" scope="col">
                        {{ $zwemfeest->email }}
                    </td>

                    @if($zwemfeest->status == 1)
                        <td scope="col" class="bg-success list-unstyled text-center justify-content-center col-1">Bevestigd</td>
                    @else
                        <td scope="col" class="bg-danger list-unstyled text-center justify-content-center col-1">Niet bevestigd</td>
                        @endif

                    <td class="col-1 d-flex" scope="col">

                        <form action="/admin/zwemfeest/" method="post" class="deleteForm">
                            @csrf
                            @method('delete')
                            <input hidden name="myid" value="{{ $zwemfeest->id }}">
                            <button
                                type="submit" class="btn btn-outline-danger m-1"
                                data-toggle="tooltip"
                                data-records="{{ $zwemfeest->records_count }}"
                                title="Delete {{ $zwemfeest->user->name }}"
                            >
                                <i class="fas fa-trash-alt"></i>

                            </button>
                        </form>

                        <form action="/admin/zwemfeest/edit" method="post">
                            @csrf
                            @method('put')
                            <input hidden type="text" name="zwemfeestId" value="{{ $zwemfeest->id }}">
                            <button type="submit" class="btn btn-outline-success m-1">
                                <i class="fas fa-edit"></i>
                            </button>
                        </form>
                        <form action="/admin/zwemfeest/sendEmail" method="post">
                            @csrf
                            @method('post')
                            <button type="submit" class="btn btn-outline-primary m-1">
                                <i class="fas fa-envelope"></i>
                                <input hidden type="text" name="date" value="{{ $zwemfeest->date }}">
                                <input hidden type="text" name="startH" value="{{ $zwemfeest->start_time }}">
                                <input hidden type="text" name="endH" value="{{ $zwemfeest->end_time }}">
                                <input hidden type="text" name="amount" value="{{ $zwemfeest->amount }}">
                                <input hidden type="text" name="meal" value="{{ $zwemfeest->meal->name }}">
                                <input hidden type="text" name="name" value="{{ $zwemfeest->name }}">
                                <input hidden type="text" name="email" value="{{ $zwemfeest->email }}">
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nieuw zwemfeest</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/admin/zwemfeest/" method="post">
                        @csrf
                        @method('post')
                        <div class="form-group">
                            <label for="naamFeest" class="col-form-label">Naam v/t feest:</label>
                            <input type="text" id="naamFeest" name="naamFeest">
                        </div>
                        <div class="form-group" >
                            <label for="rate" class="col-form-label">Rate:</label>
                            <select name="rate" id="rate" required>
                                <option value="Non">------</option>
                                @foreach ($rates as $rate)
                                    <option value="{{ $rate->id }}">{{ $rate->name }} -- {{ $rate->price }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="date">Dag:</label>
                            <input type="date" id="date" name="date" required>
                        </div>
                        <div class="form-group" >
                            <label for="meal" class="col-form-label">Maaltijd:</label>
                            <select name="meal" id="meal" required>
                                <option value="Null">------</option>
                                @foreach ($meals as $meal)
                                    <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount" class="col-form-label">hoeveelheid personen:</label>
                            <input type="number" id="amount" name="amount" required>
                        </div>
                        <div class="form-group">
                            <label for="startH" class="col-form-label">Start uur:</label>
                            <input type="time" id="startH" name="startH" required>
                        </div>
                        <div class="form-group">
                            <label for="EndH" class="col-form-label">Eind uur:</label>
                            <input type="time" id="EndH" name="EndH" required>
                        </div>
                        <div class="form-group">
                            <label for="Name" class="col-form-label">naam klant:</label>
                            <input type="text" id="Name" name="Name" required>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-form-label">email klant:</label>
                            <input type="text" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="active" name="active" value=1>
                            <label for="active"> Bevestig deze reservatie:</label><br>
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
                        <source src="/assets/video/Zwemfeest_aanmaken.mkv" type="video/mp4">
                    </video>
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

