@extends('layouts.template')
@section('title', 'AquaFun')

@section('main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('AquaFun') }}</div>
                <div class="card-body">
                    <p>Het proefproject AquaFun is hoofdzakelijk bedoeld voor beheerders van zwembaden, om het verwerken
                        en bewaren van hun reserveringen efficiënter te doen verlopen.</p>
                    <p> Voor particulieren dient het project om hun voorkeuren en reservaties door te geven.</p>
                    @guest()
                            <a class="btn btn-nueva btn-success btn-lg btn-block" href="/reservation">
                                Reserveren
                            </a>
                    @endguest
                </div>
                <a class="nav-link" href="/login">Log hier in als u een account van ons ontvangen heeft/admin bent.</a>
            </div>
        </div>
    </div>
</div>
@endsection

