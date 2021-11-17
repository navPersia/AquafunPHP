@component('mail::message')
# Geachte {{ $request->name }},
Bedankt voor uw bericht.<br>
Wij zullen u spoedig contacteren.

<hr>
<p>
<b>Uw naam:</b> {{ $request->name }}<br>
<b>Uw e-mail:</b> {{ $request->email }}
</p>
<p>
<b>Uw bericht:</b><br>{!! nl2br($request->message) !!}
</p>
Bedankt,<br>
{{ env('APP_NAME') }}
@endcomponent
