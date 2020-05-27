{{-- relationships ---------------------------------------------------- --}}

<div class="mx-4 mt-2">
    <h2 class="py-2 text-xl font-bold border-t-2 border-gray-400">
        Relationships <span class="pl-4 text-xs font-normal text-gray-600">Create relationships from the other record</span>
    </h2>
    <table class="text-sm bg-white ">

        @foreach($contact->foodbanks as $foodbank)
        <tr>
            <td class="px-4 py-2 ">Foodbank</td>
            <td class="px-4 py-2">
                <a class="text-indigo-700 underline" href="{{ route('admin.foodbanks.show',$foodbank->id)}}">{{ $foodbank->name}}</a>
            </td>
            <td class="px-4 py-2">{{ $foodbank->pivot->relationship }}</td>
        </tr>
        @endforeach

        @foreach($contact->clubs as $club)
        <tr>
            <td class="px-4 py-2">Rotary Club</td>
            <td class="px-4 py-2">
                <a class="text-indigo-700 underline" href="{{ route('admin.clubs.show',$club->id)}}">{{ $club->name}}</a>
            </td>
            <td class="px-4 py-2">{{ $club->pivot->relationship }}</td>
        </tr>
        @endforeach

        @foreach($contact->suppliers as $supplier)
        <tr>
            <td class="px-4 py-2">Supplier</td>
            <td class="px-4 py-2">
                <a class="text-indigo-700 underline" href="{{ route('admin.suppliers.show',$supplier->id)}}">{{ $supplier->name}}</a>
            </td>
            <td class="px-4 py-2">{{ $supplier->pivot->relationship }}</td>
        </tr>
        @endforeach

        @foreach($contact->shippers as $shipper)
        <tr>
            <td class="px-4 py-2">Shipper</td>
            <td class="px-4 py-2">
                <a class="text-indigo-700 underline"
                    href="{{ route('admin.shippers.show',$shipper->id)}}">{{ $shipper->name}}</a>
            </td>
            <td class="px-4 py-2">{{ $shipper->pivot->relationship }}</td>
        </tr>
        @endforeach

        
    </table>
</div>