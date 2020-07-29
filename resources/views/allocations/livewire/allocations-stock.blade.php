<div x-data="{picker: false}">
    <div class="flex flex-row items-baseline justify-between mx-4 border-t-2 border-gray-400">
        <h2 class="pt-2 my-3 text-xl font-bold ">Proposed Items</h2>
        <span class="text-xs">Total: <span class="text-base font-bold">£{{ $allocation_total }}</span></span>
        <div class="pb-2">
            <button x-on:click="picker=true"
                class="px-4 py-1 text-xs text-gray-800 align-bottom bg-gray-100 border border-gray-500 rounded hover:bg-gray-300">+ Add Items</button>
        </div>
    </div>
    <div class="px-4 py-2 mx-4 bg-white border border-gray-300 rounded">
        <table class="w-full p-2 text-sm">
            <thead>
                <tr>
                    <th class="w-1/12 pb-2 text-xs"></th>
                    <th class="w-6/12 pb-2 text-xs"></th>
                    <th class="w-1/12 pb-2 text-xs text-left">uom</th>
                    <th class="w-1/12 pb-2 text-xs text-right">qty</th>
                    <th class="w-1/12 pb-2 text-xs text-right">each</th>
                    <th class="w-1/12 pb-2 text-xs text-right">total</th>
                    <th class="w-8 pb-2 text-xs"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($stocks as $stock)
                    @include('allocations.stocks-row',['stock' => $stock, 'row' => $loop->index, 'allocation_status' => $allocation_status ])
                @endforeach
            </tbody>
        </table>
    </div>

    @include('allocations._itemsPicker')
</div>
