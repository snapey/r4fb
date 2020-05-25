<div class="mx-4 border-t-2 border-gray-400">
    <div class="flex flex-row items-center justify-between">
        <h2 class="py-2 text-xl font-bold ">
            @if($addresses->count() > 1)
            Addresses
            @else
            Address
            @endif
        </h2>
        <button wire:click="newAddress"
            class="px-4 py-2 mr-4 text-xs text-gray-800 border border-gray-500 rounded hover:bg-gray-300">+ Add New
            Address</button>
    </div>

    <table class="w-full text-sm bg-white">
        @foreach($addresses as $address)
            <tr>
                <td class="px-4 py-1">{{ $address->address1 }}</td>
                <td class="px-4 py-1">{{ $address->address2 }}</td>
                <td class="px-4 py-1">{{ $address->address3 }}</td>
                <td class="px-4 py-1">{{ $address->address4 }}</td>
                <td class="px-4 py-1">{{ $address->postcode }}</td>
                <td class="px-4 py-1 text-right"><button wire:click="showAddress({{ $address->id }})"
                        class="px-3 py-1 text-xs text-gray-500 border rounded hover:bg-gray-300 hover:border-gray-500 hover:text-gray-800">View
                        / Edit</button></td>
            </tr>
        @endforeach
    </table>
    @if($modalShowing)
        @include('admin.addresses.modal')
    @endif
</div>