@extends('layouts.template')
@section('title', 'AquaFun')

@section('main')
    <h1>Zwemlessen</h1>

    <div class="table-responsive">
        <table class="table table-bordered table-hover table-light table-striped">
            <thead class="thead-dark">
            <tr>
                <th>Dag</th>
                <th>Uur</th>
                <th>Zwemleraar</th>
                <th>Zwemmers</th>
            </tr>
            </thead>
            <tbody>
            @foreach($lessons as $lesson)
                <tr>
                    <td>{{ $lesson->weekday }}</td>
                    <td>{{ $lesson->start_time . ' - ' . $lesson->end_time }}</td>
                    <td>{{ $lesson->teacher->name }}</td>
                    <td>@foreach($userLessons as $userLesson){{ $lesson->userLesson->name }}@endforeach</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
