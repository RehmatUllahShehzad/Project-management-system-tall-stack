@component('mail::message')
# Welcome to {{ config('app.name') }}
You are invited to join <b>{{ $team }}</b> team. <br>
@component('mail::button', ['url' => $url])
Join now
@endcomponent
If you are having any issues with account registration, please don’t hesitate to contact us. <br>
{{ config('app.name') }}
@endcomponent
