@extends('layouts.template')

@section('title', 'ZWEMMERS HOME PAGE!')

@section('main')
<div class="table-responsive">
    <div class="title-box mb-4 mt-5">
        <h1 class="text-center">Zwemmers toekenen aan zwemles</h1>
    </div>

    <hr class="mb-5">

    <a class="btn btn-primary btn-nueva mb-3" data-toggle="modal" data-target="#addModal" data-whatever="@mdo"><i class="fas fa-plus-circle mr-1"></i> Zwemmer toekenen aan zwemles</a>
    <a class="btn btn-success btn-nueva mb-3" data-toggle="modal" data-target="#addModal2" data-whatever="@mdo"><i class="fas fa-plus-circle mr-1"></i>Nieuwe zwemmer aanmaken</a>

    <table class="table table-bordered table-hover table-light table-striped table-sm">
    <thead class="thead-dark">
      <tr class="d-flex">
        <th class="col-1" scope="col">Number</th>
        <th class="col-2" scope="col">Naam</th>
        <th class="col-2" scope="col">Tele_nummer</th>
        <th class="col-2" scope="col">Adres</th>
        <th class="col-2" scope="col">Email</th>
        <th class="col-2" scope="col">Geb_datum</th>
        <th class="col-1" scope="col">Actie</th>
      </tr>
    </thead>
    <tbody>
    <?php $teler = 0; ?>
    @foreach ($userSwimmingLessons as $userSwimmingLesson)

    <?php $teler = $teler + 1; ?>
      <tr class="d-flex">
      <th class="col-1" scope="row">{{ $teler }}</th>
        <td class="col-2" title="Opmerking: {{ $userSwimmingLesson->user->remark }}">
        {{ $userSwimmingLesson->user->name }}
        </td>
        <td class="col-2">
        {{ $userSwimmingLesson->user->phone_number }}
        </td>
        <td class="col-2">
        {{ $userSwimmingLesson->user->street }} {{$userSwimmingLesson->user->house_number}} <br>
        {{ $userSwimmingLesson->user->place }} {{$userSwimmingLesson->user->postal_code}}
        </td>
        <td class="col-2">
        {{ $userSwimmingLesson->user->email }}
        </td>
        <td class="col-2">
        {{ $userSwimmingLesson->user->birth_date }}
        </td>
        <td class="col-1">
        <form action="/admin/zwemmers/" method="post" class="deleteForm">
              @csrf
              @method('delete')
              <input hidden name="userSwimmingLessonId" value="{{ $userSwimmingLesson->id }}">
              <input hidden name="userId" value="{{ $userSwimmingLesson->user->id }}">
              <button
                    type="submit" class="btn btn-outline-danger"
                    data-toggle="tooltip"
                    title="Delete {{ $userSwimmingLesson->user->name }}"
              >
                  <i class="fas fa-trash-alt"></i>

              </button>
            </form>
        </td>

      </tr>
      @endforeach
    </tbody>
  </table>
  <small id="remark" class="form-text text-danger">&#42; Hover met de muis op de naam van klant om zijn/haar opmerkingen kunnen zien.</small>

</div>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nieuwe zwemmer toekenen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/admin/zwemmers/" method="post">
        @csrf
        @method('post')
        <input hidden name="swimminglessonId" value="{{ $zwemlesId }}">
        <input hidden name="status" value="NVT">

        <div class="form-group">
            <label for="teacher" class="col-form-label">Zwemmers:</label>
            <select name="userId" id="userId">
                <option value="Non">------</option>
                @foreach ($choices as $choice)
                  @if($choice->user->teacher != 1 and $choice->user->admin != 1)
                    <option value="{{ $choice->user->id }}"
                    title="Opmerking: {{ $choice->user }}"
                    >{{ $choice->user->name }} - {{ $choice->user->email }} </option>
                  @endif
                @endforeach
            </select>
            <small id="remark" class="form-text text-muted">Hover met de muis op de naam van klant om zijn/haar opmerkingen kunnen zien.</small>
          </div>

          <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Afsluiten</button>
        <button type="submit" class="btn btn-success">Toekenen</button>
      </div>
        </form>
      </div>
    </div>
  </div>
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

          <input hidden name="swimminglessonId" value="{{ $zwemlesId }}">

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
            <label for="remark" class="col-form-label">Opmerking: </label>
            <input type="text" id="remark" name="remark">
            <small id="remark" class="form-text text-muted">Hebt u een voorkeur of wilt u iets met ons delen. Geef bij opmerkingen aan.</small>
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
@endsection
