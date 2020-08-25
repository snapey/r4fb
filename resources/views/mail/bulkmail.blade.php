@component('mail::message')
{{ $provider->body }}

----
_message sent from R4FB operating platform by {{ $provider->user->name ?? '----'}}_
@endcomponent
