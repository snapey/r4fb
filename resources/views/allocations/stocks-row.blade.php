<tr>
    <td class="py-1 font-bold">{{ $stock['item']['code'] }}</td>
    <td class="px-1 py-1">{{$stock['item']['description'] }}</td>
    <td class="py-1">{{ $stock['item']['uom'] }}</td>
    <td class="text-right"><input type="text" class="w-12 px-1 text-right border border-gray-400" name="qty"
            wire:model="stocks.{{ $row }}.qty" /></td>
    <td class="pl-2 text-right">{{ $this->presenter('each',$stock['each']) }}</td>
    <td class="pl-2 text-right">{{ $this->presenter('total',$stock['total']) }}</td>
    <td class="text-right">
        @if($confirming == $stock['id'])
            <a class="p-1" href="#" wire:click.prevent="kill()">
                <x-svg.trash class="w-4 text-red-600" /></a>
            </td>
        @else
            <a class="p-1 rounded-full hover:bg-red-400" href="#" wire:click.prevent="confirmDelete({{ $stock['id'] }})">
                <x-svg.x class="w-4 h-4 align-text-bottom" /></a>
            </td>
    @endif
</tr>
