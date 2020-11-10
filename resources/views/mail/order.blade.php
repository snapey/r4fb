@component('mail::message')
{{ $provider->body }}

@if($provider->pdf)
----
[You can download the order as PDF here]({{ $provider->pdf }})
@endif

@if($provider->excelurl)
----
[You can download the order as Excel here]({{ $provider->excelurl }})
@endif

@if($provider->csvurl)
----
[You can download the order as CSV here]({{ $provider->csvurl }})
@endif

----
_message sent from R4FB operating platform by {{ $provider->user->name ?? '----'}} <{{ $provider->user->email }}>_
@endcomponent
