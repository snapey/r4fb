@component('mail::message')
{{ $provider->body }}

@if($provider->pdf)
----
[You can download the order here]({{ $provider->pdf }})
@endif

----
_message sent from R4FB operating platform by {{ $provider->user->name ?? '----'}} <{{ $provider->user->email }}>_
@endcomponent
