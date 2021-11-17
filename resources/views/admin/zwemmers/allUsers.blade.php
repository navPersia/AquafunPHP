@extends('layouts.template')

@section('title', 'Alle zwemmers!')

@section('main')
<div class="table-responsive">
    <div class="title-box mb-4 mt-5">
        <h1 class="text-center">Bekijk alle zwemers</h1>
    </div>

    <hr class="mb-5">
    <p><a class="btn btn-success btn-nueva" data-toggle="modal" data-target="#addModal2" data-whatever="@mdo"><i class="fas fa-plus-circle mr-1"></i>Nieuwe zwemmer aanmaken</a>
        <a class="btn btn-primary video-btn" data-toggle="modal" data-target="#videoModal">
            <i class="fa fa-question"></i>
            Info
        </a>
    </p>
    <table class="table table-bordered table-hover table-light table-striped table-sm">
    <thead class="thead-dark">
      <tr class="d-flex">
        <th class="col-1" scope="col">Nummer</th>
        <th class="col-2" scope="col">Naam</th>
        <th class="col-2" scope="col">Telefoon nummer</th>
        <th class="col-2" scope="col">Adres</th>
        <th class="col-2" scope="col">Email</th>
        <th class="col-1" scope="col">Geboorte datum</th>
        <th class="col-2" scope="col">Actie</th>
      </tr>
    </thead>
    <tbody>
    <?php $teler = 0; ?>
    @foreach ($users as $user)

    <?php $teler = $teler + 1; ?>
      <tr class="d-flex">
      <th class="col-1" scope="row">{{ $teler }}</th>
        <td class="col-2" title="Opmerking: {{ $user->remark }}">
        {{ $user->name }}
        </td>
        <td class="col-2">
        {{ $user->phone_number }}
        </td>
        <td class="col-2">
        {{ $user->street }} {{$user->house_number}} <br>
        {{ $user->place }} {{$user->postal_code}}
        </td>
        <td class="col-2">
        {{ $user->email }}
        </td>
        <td class="col-1">
        {{ $user->birth_date }}
        </td>
        <td class="col-2 d-flex">
        <form action="/admin/zwemmers/" method="post" class="deleteForm">
              @csrf
              @method('delete')
              <input hidden name="userId" value="{{ $user->id }}">
              <button
                    type="submit" class="btn btn-outline-danger m-1"
                    data-toggle="tooltip"
                    title="Delete {{ $user->name }}"
              >
                  <i class="fas fa-trash-alt"></i>
              </button>
            </form>

            <form action="/admin/zwemmers/edit" method="get">
              @csrf
              @method('get')
              <input hidden type="text" name="userId" value="{{ $user->id }}">
              <button type="submit" class="btn btn-outline-success m-1">
                  <i class="fas fa-edit"></i>
              </button>
            </form>
        </td>

      </tr>
      @endforeach
    </tbody>
  </table>
  <small id="remark" class="form-text text-danger">&#42; Hover met de muis op de naam van klant om zijn/haar opmerkingen kunnen zien.</small>

</div>

<div class="modal fade" id="addModal2" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nieuwe klant aanmaken</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/admin/zwemmers/new" method="post">
        @csrf
        @method('post')

          <div class="form-group">
            <label for="firstName" class="col-form-label">Voornaam: </label>
            <input type="text" id="firstName" name="firstName" required>
          </div>

          <div class="form-group">
            <label for="lastName" class="col-form-label">Achternaam: </label>
            <input type="text" id="lastName" name="lastName" required>
          </div>

          <div class="form-group">
            <label for="email" class="col-form-label">Email: </label>
            <input type="email" id="email" name="email" required>
          </div>

          <div class="form-group">
            <label for="phone" class="col-form-label">Telefoon: </label>
            <input type="text" id="phone" name="phone">
          </div>

          <div class="form-group">
            <label for="street" class="col-form-label">Straat: </label>
            <input type="text" id="street" name="street" required>
          </div>

          <div class="form-group">
            <label for="homeNumber" class="col-form-label">Huisnummer: </label>
            <input type="text" id="homeNumber" name="homeNumber" required>
          </div>

          <div class="form-group">
            <label for="mailboxNumber" class="col-form-label">Busnummer: </label>
            <input type="text" id="mailboxNumber" name="mailboxNumber">
          </div>

          <div class="form-group">
            <label for="place" class="col-form-label">Woonplaats: </label>
            <input type="text" id="place" name="place" required>
          </div>

          <div class="form-group">
            <label for="postalCode" class="col-form-label">Post_code: </label>
            <input type="text" id="postalCode" name="postalCode" required>
          </div>

          <div class="form-group">
            <label for="bDate" class="col-form-label">Geb_datum: </label>
            <input type="date" id="bDate" name="bDate" required>
          </div>

          <div class="form-group">
          <label for="bDate" class="col-form-label">Zwemles voorkeur: </label>
            <select name="swimminglessonId" id="swimminglessonId" class="form-select">
                @foreach ($swimmingLessons as $swimmingLesson)
                <option value="{{$swimmingLesson->id}}">{{$swimmingLesson->user->name}} op <span class="text-danger">{{$swimmingLesson->weekday}}</span> om <span class="text-primary">{{$swimmingLesson->start_time->toTimeString()}}uur</span></option>
                @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="remark" class="col-form-label">Opmerking: </label>
            <input type="text" id="remark" name="remark">
            <small id="remark" class="form-text text-muted">Hebt u een voorkeur of wilt u iets met ons delen. Geef bij opmerkingen aan.</small>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Afsluiten</button>
            <button type="submit" class="btn btn-primary">Aanmaken</button>
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
                    <source src="/assets/video/Zwemmer_aanmaken.mkv" type="video/mp4">
                </video>
            </div>
        </div>
    </div>
</div>
@endsection
