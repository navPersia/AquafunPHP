@extends('layouts.template')

@section('title', 'ZWEMMERS HOME PAGE!')

@section('main')
<div class="table-responsive">

  <div class="title-box mb-4 mt-5">
    <h1 class="text-center">Zwemmers toekenen aan zwemles</h1>
  </div>

  <hr class="mb-5">

  <table class="table table-bordered table-hover table-light table-striped table-sm">
    <thead class="thead-dark">
      <tr class="d-flex">
        <th class="col-1" scope="col">Number</th>
        <th class="col-3" scope="col">Leraar</th>
        <th class="col-2" scope="col">Dag</th>
        <th class="col-2" scope="col">Start uur</th>
        <th class="col-2" scope="col">Eind uur</th>
        <th class="col-1" scope="col">Status</th>
        <th class="col-1" scope="col">Toegang</th>
      </tr>
    </thead>
    <tbody>
    <?php $teler = 0; ?>
    @foreach ($zwemlesen as $zwemles)
    <?php $teler = $teler + 1; ?>
      <tr class="d-flex">
      <th class="col-1" scope="row">{{ $teler }}</th>
        <td class="col-3">
        {{ $zwemles->user->name }}
        </td>
        <td class="col-2">
        {{ $zwemles->weekday }}
        </td>
        <td class="col-2">
        {{ $zwemles->start_time->toTimeString() }}
        </td>
        <td class="col-2">
        {{ $zwemles->end_time->toTimeString() }}
        </td>
          @if($zwemles->status == 1)
            <td class="bg-success col-1">Actief</td>
          @else
            <td class="bg-danger col-1">Inactief</td>
          @endif
        <td class="bg-info col-1 text-center">
            <form name="detail-zwemles-form" action="/admin/zwemmers/detail-zwemles" method="get">
                <input hidden type="text" name="zwemlesId" value="{{ $zwemles->id }}">
                <button  class="btn" type="submit" >
                    <svg id="fi_3596080" enable-background="new 0 0 24 24" height="22" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g><path d="m15.5 12.5h-15c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h15c.276 0 .5.224.5.5s-.224.5-.5.5z"></path></g><g><path d="m11.5 16.5c-.128 0-.256-.049-.354-.146-.195-.195-.195-.512 0-.707l3.647-3.647-3.646-3.646c-.195-.195-.195-.512 0-.707s.512-.195.707 0l4 4c.195.195.195.512 0 .707l-4 4c-.098.097-.226.146-.354.146z"></path></g><g><path d="m12 23c-4.655 0-8.823-2.947-10.372-7.333-.092-.261.045-.546.305-.638.261-.09.546.045.638.305 1.408 3.987 5.197 6.666 9.429 6.666 5.514 0 10-4.486 10-10s-4.486-10-10-10c-4.232 0-8.021 2.679-9.428 6.667-.092.26-.378.395-.638.305-.26-.092-.397-.377-.305-.638 1.548-4.387 5.716-7.334 10.371-7.334 6.065 0 11 4.935 11 11s-4.935 11-11 11z"></path></g></svg>
                </button>
            </form
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <small id="remark" class="form-text text-danger">&#42; Klik op gewenste zwemles om zwemmer toe te voegen.</small>
    <a class="btn btn-primary video-btn" data-toggle="modal" data-target="#videoModal">
        <i class="fa fa-question"></i>
        Info
    </a>
</div>
{{--Modal voor Video--}}
<div class="modal fade" id="videoModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <video width="100%" controls>
                    <source src="/assets/video/Zwemmer_Toekennen.mkv" type="video/mp4">
                </video>
            </div>
        </div>
    </div>
</div>

@endsection
