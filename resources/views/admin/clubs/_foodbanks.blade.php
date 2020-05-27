{{-- foodbanks ---------------------------------------------------- --}}

<div class="pl-4 mt-2 mr-4">
    <h2 class="py-2 text-xl font-bold border-t-2 border-gray-400">
        Foodbanks
        <button wire:click="$set('showFoodbankPicker',true)"
            class="float-right px-4 py-1 text-xs text-gray-800 bg-gray-100 border border-gray-500 rounded hover:bg-gray-300">
            + Associate to Foodbank</button>
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
                @if($confirmDisassociateFoodbank == $foodbank->id)
                    <button wire:click="disassociateFoodbank({{ $foodbank->id }})" class="px-3 py-1 text-white bg-red-700 border rounded hover:bg-red-600 hover:border-gray-500">Sure ?</button>
                    <button wire:click="$set('confirmDisassociateFoodbank', false)" class="px-3 py-1 bg-orange-400 border rounded hover:bg-orange-300 hover:border-gray-500">cancel</button>
                @else
                    <button wire:click="disassociateFoodbank({{ $foodbank->id }})" class="px-3 py-1 text-gray-500 border rounded hover:text-red-700 hover:bg-gray-300 hover:border-gray-500">Disassociate</button>
                @endif
            </td>
        </tr>
        @endforeach

    </table>
</div>