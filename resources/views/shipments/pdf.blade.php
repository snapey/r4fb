<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet">
</head>

<body class="m-8">

    <div class="w-full text-center">
        <img src="{{ asset('images/R4FBLogo.png') }}" class="w-64 mx-auto" />
    </div>
    
    <h1 class="mt-4 font-sans text-2xl text-teal-900">Rotary4Foodbanks <span class="float-right text-2xl">Delivery Note</span></h1>

    <h2 class="my-4 text-xl font-bold text-teal-900 ">Shipment {{ $shipment->id }}-{{ $sub->sub }}<span class="float-right text-base font-normal">{{ $shipment->created_at->format('d/m/Y')}}</span></h2>

    <p class="text-xl">Allocation {{ $allocation->id }} / {{ $allocation->foodbank->name }}</p>
    
    @include('shipments.pdf._fromto')
    @include('shipments.pdf._items')

    @if($shipment->notes->count() >0)
        <h1 class="text-2xl">Notes</h1>
        <div class="mb-8 border">
            @foreach($shipment->notes->where('external') as $note)
            <p class="text-sm">{{ $note->memo }}</p>
            @endforeach
        </div>
    @endif

    <div style="page-break-before:always"></div>
    <h1 class="text-2xl">Receipt Confirmation for Shipment {{ $shipment->id }}-{{ $sub->sub }}</h1>
        
    @include('shipments.pdf._signature')

</body>
</html>