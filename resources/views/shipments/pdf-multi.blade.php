<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet">
</head>

<body class="">

    @foreach($shipment->allocations as $allocation)

        <div class="w-full text-center">
            <img src="{{ asset('images/R4FBLogo.png') }}" class="w-64 mx-auto" />
        </div>
        
        <table class="w-full text-xl font-bold text-teal-900 border-0">
            <tr>
                <td class="py-2 border-0 border-white ">Rotary4Foodbanks</td>
                <td class="py-2 text-right border-0 border-white">Delivery Note</td>
            </tr>
            <tr>
                <td class="py-2 border-0 border-white ">Shipment {{ $shipment->id }}-{{ $allocation->pivot->sub ?? 0 }}</td>
                <td class="py-2 text-right border-0 border-white">{{ $shipment->created_at->format('d/m/Y')}}</td>
            </tr>
        </table>
        
        <p>Allocation: {{ $allocation->id }} / {{ $allocation->foodbank->name }}</p>


        @include('shipments.pdf._fromto')
        @include('shipments.pdf._items')

        <div style="page-break-after:always"></div>
    @endforeach

    <div class="w-full text-center">
        <img src="{{ asset('images/R4FBLogo.png') }}" class="w-64 mx-auto" />
    </div>

    @if($shipment->notes->count() >0)
        <h1 class="text-2xl">Notes</h1>
        <div class="mb-8 border">
            @foreach($shipment->notes->where('external') as $note)
            <p class="text-sm">{{ $note->memo }}</p>
            @endforeach
        </div>
    @endif
    
    <h1 class="mt-8 text-2xl">Receipt Confirmation for Shipment {{ $shipment->id }}</h1>

    @foreach($shipment->allocations as $allocation)
        <p>Shipment: {{ $shipment->id }}-{{ $allocation->pivot->sub }} / Allocation: {{ $allocation->id }} / {{ $allocation->foodbank->name }}</p>
    @endforeach

    @include('shipments.pdf._signature')

</body>
</html>