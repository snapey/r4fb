Here is your personal summary of the alerts generated on R4FB yesterday.

@foreach($digests as $digest)
{!! $digest->data['described'] !!}    
{!! trim($digest->data['entityName']) !!}    
{{ $digest->data['showRoute'] }}

@endforeach

You received this email because you subscribed to alerts from your user account on R4FB operating platform. Go there
to change your subscription preferences.

Thanks,<br>
{{ config('app.name') }}
