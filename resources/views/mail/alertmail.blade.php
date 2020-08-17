@component('mail::message')
# {{ $event->described }}

{{ $event->entityName }}

@component('mail::button', ['url' => $event->showRoute])
Review the item
@endcomponent

_You received this email because you subscribed to alerts from your user account on R4FB operating platform.  Go there
to change your subscription preferences._

Thanks,<br>
{{ config('app.name') }}
@endcomponent
