@component('mail::message')
# Login for {{ $user->name }}

Use the button below to login to the application.
This link is valid for 6 hours only.

@component('mail::button', ['url' => $link])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}


{!! $link !!}

@endcomponent

