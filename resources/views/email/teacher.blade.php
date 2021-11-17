@component('mail::message')
# Beste {{ $request->name }},
Er is een account aangemaakt voor u.<br>
Hieronder vind u uw login gegevens.<br>
Gelieve uw wachtwoord te wijzigen bij de eerste inlogsessie. <br>
Verwijder deze mail zo snel mogelijk!


<hr>
<p>
<b>Uw email address:</b> {{ $request->email }}<br>
<b>Uw wachtwoord:</b> {{ $request->password }}
</p>

Vriendelijke groeten,<br>
{{ env('APP_NAME') }}
@endcomponent
