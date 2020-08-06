{{-- allocations ---------------------------------------------------- --}}

<div class="pl-4 mt-2 mr-4">
    <h2 class="py-2 text-xl font-bold border-t-2 border-gray-400">
        Allocations
    </h2>
    
    <table class="w-full py-2 mb-16 text-sm bg-white">

        <thead>
            <tr>
                <th class="px-4 py-1 text-left">Alloc.</th>
                <th class="px-4 py-1">Status</th>
                <th class="px-4 py-1">Total</th>
                <th class="px-4 py-1">Shipments</th>
                <th class="px-4 py-1 text-right">Updated</th>
            </tr>
        </thead>

        @foreach($allocations as $allocation)

        <tr>
            <td class="px-4 py-1"><a class="text-indigo-700 underline" href="{{ route('allocations.show',$allocation) }}">{{ $allocation->id }}</a></td>
            <td class="px-4 py-1 text-center">{{ $allocation->status }}</td>
            <td class="px-4 py-1 text-center">&pound;{{ $allocation->pounds }}</td>
            <td class="px-4 py-1">
            @foreach($allocation->shipments as $shipment)@if(!$loop->first), @endif<a class="text-indigo-600 underline" href="{{ route('shipment.show',$shipment->id) }} ">{{ $shipment->id }}</a>@endforeach
            </td>
            <td class="px-4 py-1 text-right">{{ $allocation->updated_at->format('d/m/y') }}</td>
        </tr>
        @endforeach

    </table>
</div>