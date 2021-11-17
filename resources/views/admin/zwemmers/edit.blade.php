@extends('layouts.template')

@section('title', 'Zwemmer edit!')

@section('main')

<section>
    <div class="container">
        <!-- form user info -->
        <div class="card card-outline-secondary">
              <div class="card-header">
                <h3 class="mb-0">Zwemmer aanpasen</h3>
              </div>
              <div class="card-body">
                <form autocomplete="off" class="form" role="form" action="/admin/zwemmers/update" method="post">
                @csrf
                @method('put')

                <input hidden id="userId" name="userId" value="{{$user->id}}">

                  <div class="form-group row">
                    <label for="name" class="col-lg-3 col-form-label form-control-label">Naam:</label>
                    <div class="col-lg-9">
                      <input id="name" name="name" class="form-control" type="text" value="{{$user->name}}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="email" class="col-lg-3 col-form-label form-control-label">Email</label>
                    <div class="col-lg-9">
                      <input id="email" name="email" class="form-control" type="email" value="{{$user->email}}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="phone" class="col-lg-3 col-form-label form-control-label">Telefoon:</label>
                    <div class="col-lg-9">
                      <input id="phone" name="phone" class="form-control" type="text" value="{{$user->phone_number}}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="street" class="col-lg-3 col-form-label form-control-label">Straat:</label>
                    <div class="col-lg-9">
                      <input id="street" name="street" class="form-control" type="text" value="{{$user->street}}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="homeNumber" class="col-lg-3 col-form-label form-control-label">Huisnummer:</label>
                    <div class="col-lg-9">
                      <input id="homeNumber" name="homeNumber" class="form-control" type="text" value="{{$user->house_number}}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="mailboxNumber" class="col-lg-3 col-form-label form-control-label">Busnummer:</label>
                    <div class="col-lg-9">
                      <input id="mailboxNumber" name="mailboxNumber" class="form-control" type="text" value="{{$user->mailbox_number}}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="place" class="col-lg-3 col-form-label form-control-label">Woonplaats:</label>
                    <div class="col-lg-9">
                      <input id="place" name="place" class="form-control" type="text" value="{{$user->place}}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="postalCode" class="col-lg-3 col-form-label form-control-label">Post_code:</label>
                    <div class="col-lg-9">
                      <input id="postalCode" name="postalCode" class="form-control" type="text" value="{{$user->postal_code}}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="bDate" class="col-lg-3 col-form-label form-control-label">Geb_datum:</label>
                    <div class="col-lg-9">
                      <input type="date" id="bDate" name="bDate" class="form-control" type="text" value="{{$user->birth_date}}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="bDate" class="col-lg-3 col-form-label form-control-label">Zwemles voorkeur: </label>
                    <div class="col-lg-9">
                      <select name="swimminglessonId" id="swimminglessonId" class="form-select form-select-lg">
                      <option selected value="0"><span class="text-primary">Geen voorkeur meer</span></option>
                      @foreach ($swimmingLessons as $swimmingLesson)

                          <option value="{{$swimmingLesson->id}}">{{$swimmingLesson->user->name}} op <span class="text-danger">{{$swimmingLesson->weekday}}</span> om <span class="text-primary">{{$swimmingLesson->start_time->toTimeString()}}uur</span></option>

                          @endforeach
                      </select>
                      <div class="row">
                      @foreach ($choices as $choice)
                        @if($choice->user_id == $user->id)
                        <div class="col-6">
                          <div><span class="text-danger">{{$choice->swimming_Lesson->user->name}}</span> op {{$choice->swimming_Lesson->weekday}} om <span class="text-primary">{{$choice->swimming_Lesson->start_time->toTimeString()}}</span></div>
</div>
                          @endif
                      @endforeach
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="remark" class="col-lg-3 col-form-label form-control-label">Opmerkingen:</label>
                    <div class="col-lg-9">
                      <input id="remark" name="remark" class="form-control" type="text" value="{{$user->remark}}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label"></label>
                    <div class="col-lg-9">
                      <a href="/admin/zwemmers/lijst" class="btn btn-danger">Cancel</a>
					  <input  class="btn btn-success" type="submit" value="Save Changes">
                    </div>
                  </div>

                </form>

                <form action="/admin/zwemmers/resetpassword" method="post">
                    @csrf
                    @method('post')
                  <input hidden id="userId" name="userId" value="{{$user->id}}">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label"></label>
                        <div class="col-lg-9">
                            <button type="submit" class="btn btn-warning">Password reset</button>
                        </div>
                    </div>
                </form>

              </div>
            </div><!-- /form user info -->
    </div>
  </section>
  @endsection
