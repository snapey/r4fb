<table class="w-full mt-4 text-sm">
    <thead>
        <tr class="">
            <th class="px-2 py-1 text-left border-white ">Code</th>
            <th class="px-2 py-1 text-left border-white ">Description</th>
            <th class="px-2 py-1 text-left border-white ">UOM</th>
            <th class="py-1 text-center border-white ">Qty</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($allocation->stocks as $line)
        <tr class="">
            <td class="px-2 py-2 bg-gray-100 border-2 border-white ">{{ $line->item->code }}</td>
            <td class="px-2 py-2 bg-gray-100 border-2 border-white ">{{ $line->item->description }}</td>
            <td class="px-2 py-2 bg-gray-100 border-2 border-white ">{{ $line->item->uom }}</td>
            <td class="py-2 text-center bg-gray-100 border-2 border-white">{{ $line->qty }}</td>
        </tr>
        @endforeach
    </tbody>
</table>