@extends('layouts.template')

@section('title', 'ZWEMLES HOME PAGE!')

@section('main')
<div class="table-responsive-sm">

  <div class="title-box mb-3">
    <h1>Zwemles beheren</h1>
  </div>
    <p>
        <a class="btn btn-success btn-nueva " data-toggle="modal" data-target="#addModal" data-whatever="@mdo">
            <i class="fas fa-plus-circle mr-1"></i>
            Zwemles toevoegen
        </a>
        <a class="btn btn-primary video-btn" data-toggle="modal" data-target="#videoModal">
            <i class="fa fa-question"></i>
            Info
        </a>
    </p>


    <table class="table table-bordered table-hover table-light table-striped">
    <thead class="thead-dark">
      <tr class="d-flex">
      <th class="col-1" scope="col">Number</th>
        <th class="col-2" scope="col">Leraar</th>
        <th class="col-2" scope="col">Dag</th>
        <th class="col-2" scope="col">Start uur</th>
        <th class="col-2" scope="col">Eind uur</th>
        <th class="col-1" scope="col">Status</th>
        <th class="col-2" scope="col">Functies</th>
      </tr>
    </thead>
    <tbody>
    <?php $teler = 0; ?>
    @foreach ($zwemlesen as $zwemles)

    <?php $teler = $teler + 1; ?>
      <tr class="d-flex">
      <th class="col-1" scope="col">{{ $teler }}</th>
        <td class="col-2" scope="col">
        {{ $zwemles->user->name }}
        </td>
        <td class="col-2" scope="col">
        {{ $zwemles->weekday }}
        </td>
        <td class="col-2" scope="col">
        {{ $zwemles->start_time->toTimeString() }}
        </td>
        <td class="col-2" scope="col">
        {{ $zwemles->end_time->toTimeString() }}
        </td>
        @if($zwemles->status == 1)
            <td scope="col" class="bg-success list-unstyled text-center justify-content-center col-1">Actief</td>
          @else
            <td scope="col" class="bg-danger list-unstyled text-center justify-content-center col-1">Inactief</td>
          @endif
          <td class="col-2 d-flex" scope="col">

            <form action="/admin/zwemles/" method="post" class="deleteForm">
              @csrf
              @method('delete')
              <input hidden name="myid" value="{{ $zwemles->id }}">
              <button
                    type="submit" class="btn btn-outline-danger m-1"
                    data-toggle="tooltip"
                    data-records="{{ $zwemles->records_count }}"
                    title="Delete {{ $zwemles->user->name }}"
              >
                  <i class="fas fa-trash-alt"></i>
            </button>
            </form>

            <form action="/admin/zwemles/edit" method="post">
              @csrf
              @method('put')
              <input hidden type="text" name="zwemlesId" value="{{ $zwemles->id }}">
              <button type="submit" class="btn btn-outline-success m-1">
                  <i class="fas fa-edit"></i>
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
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/admin/zwemles/" method="post">
        @csrf
        @method('post')

          <div class="form-group">
            <label for="teacher" class="col-form-label">Leraar:</label>
            <select name="teacher" id="teacher">
                <option value="Non">------</option>
                @foreach ($teachers as $teacher)
                  @if($teacher->teacher == 1)
                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                  @endif
                @endforeach
            </select>
          </div>

          <div class="form-group" >
            <label for="rate" class="col-form-label">Rate:</label>
            <select name="rate" id="rate">
            <option value="Non">------</option>
            @foreach ($rates as $rate)
              <option value="{{ $rate->id }}">{{ $rate->name }} -- {{ $rate->price }}</option>
            @endforeach
            </select>
          </div>

          <div class="form-group" >
            <label for="day" class="col-form-label">Dag:</label>
            <select name="day" id="day">
            <option value="Non">------</option>
            @foreach ($days as $day)
              <option value="{{ $day }}">{{ $day }}</option>
            @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="startH" class="col-form-label">Start uur:</label>
            <input type="time" id="startH" name="startH">
          </div>
          <div class="form-group">
            <label for="EndH" class="col-form-label">Eind uur:</label>
            <input type="time" id="EndH" name="EndH">
          </div>
          <div class="form-group">
            <input type="checkbox" id="active" name="active" value=1>
            <label for="active"> Maak het actief:</label><br>
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
                    <source src="/assets/video/Zwemles_Aanmaken.mkv" type="video/mp4">
                </video>
            </div>
        </div>
    </div>
</div>

@endsection
