@extends('layouts.template')

@section('title', 'Zwemles!')

@section('main')

<section>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-8 col-xl-6">
          <div class="row">
            <div class="col text-center">
              <h1>Zwemles aanpassen</h1>
            </div>
          </div>
          <form action="/admin/zwemles/update" method="post">
          @csrf
          @method('put')

          <div class="row align-items-center">
            <div class="col mt-4">
            <label for="teacher" class="col-form-label">Leraar:</label></br>
            <select name="teacher" class="form-control">
              @foreach ($teachers as $teacher)
                  @if($teacher->teacher == 1)
                    @if ($teacher->id == $zwemles->user_id)
                      <option selected value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                    @else
                      <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                    @endif
                  @endif
              @endforeach
            </select>
            </div>
          </div>
          <div class="row align-items-center mt-4">
            <div class="col">
            <label for="weekday" class="col-form-label">Dag:</label></br>
              <select name="weekday" class="form-control">
                @foreach ($days as $day)
                  @if ($day == $zwemles->weekday)
                    <option selected value="{{ $day }}">{{ $day }}</option>
                  @else
                    <option value="{{ $day }}">{{ $day }}</option>
                  @endif
                @endforeach
              </select>
            </div>
          </div>

          <div class="row align-items-center mt-4">
            <div class="col">
            <label for="rate_id" class="col-form-label">Rate:</label></br>
              <select name="rate_id" class="form-control">
                @foreach ($rates as $rate)
                  @if ($rate->id == $zwemles->rate_id)
                    <option selected value="{{ $rate->id }}">{{ $rate->name }} -- {{ $rate->price }}</option>
                  @else
                    <option value="{{ $rate->id }}">{{ $rate->name }} -- {{ $rate->price }}</option>
                  @endif
                @endforeach
              </select>
            </div>
          </div>

          <div class="row align-items-center mt-4">
            <div class="col">
              <div class="form-group">
                <label for="startH" class="col-form-label">Start uur:   {{ $zwemles->start_time }} </label></br>
                <input type="time" id="startH" name="startH">
              </div>
            </div>
          </div>

          <div class="row align-items-center mt-4">
            <div class="col">
            <div class="form-group">
              <label for="EndH" class="col-form-label">Eind uur:   {{ $zwemles->end_time }} </label></br>
              <input type="time" id="EndH" name="EndH">
            </div>
            </div>
          </div>
          <input hidden type="text" value="{{ $zwemles->id }}" name="zwemlesId" >

          <div class="row align-items-center mt-4">
            <div class="col">
              <div class="form-check">
              @if ($zwemles->status == 1)
                <input name="status" class="form-check-input" type="checkbox" value="1" id="flexCheckChecked" checked>
              @else
                <input name="status" class="form-check-input" type="checkbox" value="1" id="flexCheckChecked">
              @endif
                  <label class="form-check-label" for="flexCheckChecked">
                  Active
                </label>
              </div>
            </div>
          </div>

          <div class="row justify-content-start mt-4">
            <div class="col">
              <button type="submit" class="btn btn-success mt-4">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endsection
