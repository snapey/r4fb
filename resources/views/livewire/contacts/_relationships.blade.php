{{-- relationships ---------------------------------------------------- --}}

<div>
    <h2 class="py-2 text-xl font-bold">
        Relationships
    </h2>
    <table class="text-sm bg-white border-t-2 border-gray-400">

        @foreach($contact->foodbanks as $foodbank)
        <tr>
            <td class="py-2 ">Foodbank</td>
            <td class="px-4 py-2">
                <a class="text-indigo-700 underline" href="{{ route('admin.foodbanks.show',$foodbank->id)}}">{{ $foodbank->name}}</a>
            </td>
            <td class="px-4 py-2">{{ $foodbank->pivot->relationship }}</td>
        </tr>
        @endforeach

        @foreach($contact->clubs as $club)
        <tr>
            <td class="py-2 ">Rotary Club</td>
            <td class="px-4 py-2">
                <a class="text-indigo-700 underline" href="{{ route('admin.clubs.show',$club->id)}}">{{ $club->name}}</a>
            </td>
            <td class="px-4 py-2">{{ $club->pivot->relationship }}</td>
        </tr>
        @endforeach

        @foreach($contact->suppliers as $supplier)
        <tr>
            <td class="py-2 ">Supplier</td>
            <td class="px-4 py-2">
                <a class="text-indigo-700 underline" href="{{ route('admin.suppliers.show',$supplier->id)}}">{{ $supplier->name}}</a>
            </td>
            <td class="px-4 py-2">{{ $supplier->pivot->relationship }}</td>
        </tr>
        @endforeach

        @foreach($contact->shippers as $shipper)
        <tr>
            <td class="py-2 ">Shipper</td>
            <td class="px-4 py-2">
                <a class="text-indigo-700 underline"
                    href="{{ route('admin.shippers.show',$shipper->id)}}">{{ $shipper->name}}</a>
            </td>
            <td class="px-4 py-2">{{ $shipper->pivot->relationship }}</td>
        </tr>
        @endforeach

        
    </table>
</div>