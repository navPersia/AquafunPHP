@component('mail::message')
    # Beste {{ $request->name }},
    Bedankt voor uw interesse in een zwemfeest.
    Bij deze bevestigen we uw feest.


        Datum: {{$request->date}}
        Uur aanvang:{{$request->startH}}
        Eind uur:{{$request->endH}}
        Hoeveelheid personen: {{$request->amount}}
        Maaltijd:{{$request->meal}}




    Bedankt,
    {{ env('APP_NAME') }}
@endcomponent
