@component('mail::message')
# Here is your personal summary of the alerts generated on R4FB yesterday.

@foreach($digests as $digest)
- {{ $digest->data['described'] }}    
**{{ trim($digest->data['entityName'])}}**    
[Link]({{ $digest->data['showRoute'] }})

@endforeach

_You received this email because you subscribed to alerts from your user account on R4FB operating platform. Go there
to change your subscription preferences._

Thanks,<br>
{{ config('app.name') }}
@endcomponent
