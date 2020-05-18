{{-- foodbanks ---------------------------------------------------- --}}

<div class="pl-4 mt-2 mr-4">
    <h2 class="py-2 text-xl font-bold border-t-2 border-gray-400">
        Foodbanks
        <button wire:click="chooseFoodbank"
            class="float-right px-4 py-2 mr-4 text-xs text-gray-800 border border-gray-500 rounded hover:bg-gray-300">
            + Associate with a Foodbank</button>
    </h2>
    <table class="text-sm bg-white ">

        @foreach($club->foodbanks as $foodbank)
        <tr>
            <td class="px-4 py-2 ">Foodbank</td>
            <td class="px-4 py-2">
                <a class="text-indigo-700 underline"
                    href="{{ route('admin.foodbanks.show',$foodbank->id)}}">{{ $foodbank->name}}</a>
            </td>
            <td class="py-1 pl-20 pr-4">
                @if($confirmDisassociateFoodbank)
                    <button wire:click="disassociateFoodbank({{ $foodbank->id }})" class="px-3 py-1 text-white bg-red-700 border rounded hover:bg-red-600 hover:border-gray-500">Sure ?</button>
                    <button wire:click="$set('confirmDisassociateFoodbank', false)" class="px-3 py-1 bg-orange-400 border rounded hover:bg-gray-600 hover:border-gray-500">cancel</button>
                @else
                    <button wire:click="disassociateFoodbank({{ $foodbank->id }})" class="px-3 py-1 text-gray-500 border rounded hover:text-red-700 hover:bg-gray-300 hover:border-gray-500">Disassociate</button>
                @endif
            </td>
        </tr>
        @endforeach

    </table>
</div>