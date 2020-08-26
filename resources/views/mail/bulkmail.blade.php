@component('mail::message')
{{ $provider->body }}

@if($provider->pdf)
----
[You can download a copy of the shipment note here]({{ $provider->pdf }})
@endif

----
_message sent from R4FB operating platform by {{ $provider->user->name ?? '----'}}_
@endcomponent
