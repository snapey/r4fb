@extends('layouts.app',[$title='Prepare Shipment | '])

@section('content')
<style>
    [x-cloak] {
        display: none;
    }
</style>

<div class="p-4 bg-gray-200">
    <h1 class="text-xl font-bold text-teal-800 ">Prepare Shipment for Single Allocation</h1>
    <h2 class="mt-4 text-lg font-bold text-teal-800">Allocation: {{ $allocation->id }} for {{ $allocation->foodbank->name }}</h2>

    <div class="flex flex-row">
        <div class="w-6/12 pr-4">

            <h2 class="my-4 ml-2 text-xl font-bold text-teal-800">Items</h2>
            <div class="p-1 mt-2 text-sm bg-white border border-gray-300 rounded">
                <table class="w-full text-gray-800">
                    <thead>
                        <tr>
                            <td class="p-1 text-xs font-bold">Code</td>
                            <td class="p-1 text-xs font-bold">Description</td>
                            <td class="p-1 text-xs font-bold text-center">Qty</td>
                        </tr>
                    </thead>
                    @php $total=0; @endphp
                    @foreach($allocation->stocks as $line)
                        <tr>
                            <td class="p-1">{{ $line->item->code ?? 'Error' }}</td>
                            <td class="p-1">{{ $line->item->description ?? 'Error' }}</td>
                            <td class="p-1 text-center">{{ $line->qty }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

        <div class="w-6/12 pl-4">
            <div class="flex-flex-col">
                <h2 class="my-4 text-xl font-bold text-teal-800" >Create Shipment</h2>
    
                <form action="{{ route('shipment.store',$allocation) }}" method="POST">
                @csrf
                    <input type="hidden" value="{{ $allocation->id }}" name="allocation[]" />
                    <div class="flex flex-col space-y-4">
                        <div class="flex items-center justify-between">
                            <label for="supplier">From:</label>
                            <select name="from" class="w-4/6 px-2 py-1 text-sm text-gray-800 bg-white rounded" id="from" required>
                                <option value="">Select From</option>
                                    <optgroup label="Shippers">
                                        @foreach($shippers as $shipper)
                                            @foreach($shipper->addresses as $address)
                                                <option value="{{ $address->id }}">{{ $shipper->name }} - {{ $address->address1 }} - {{ $address->postcode }}</option>
                                            @endforeach
                                        @endforeach
                                </optgroup>
                            </select>
                        </div>
                            
                        <div class="flex items-center justify-between">
                            <label for="shipto">Ship To:</label>
                            <select name="shipto" class="w-4/6 px-2 py-1 text-sm text-gray-800 bg-white rounded" id="shipto" required>
                                <option value="">Select Ship To</option>
                                <optgroup label="Foodbank address">
                                    @foreach($foodbank->addresses as $address)
                                    <option value="{{ $address->id }}">{{ $foodbank->name }} - {{ $address->address1 }} - {{ $address->postcode }}</option>
                                    @endforeach
                                </optgroup>
                                <optgroup label="Shippers">
                                @foreach($shippers as $shipper)
                                    @foreach($shipper->addresses as $address)
                                    <option value="{{ $address->id }}">{{ $shipper->name }} - {{ $address->address1 }} - {{ $address->postcode }}</option>
                                    @endforeach
                                @endforeach
                                </optgroup>
                            </select>
                        </div>
        
        
                        <div class="flex items-center justify-between">
                            <x-button type="submit" class="px-8">Create Shipment</x-button>
                        </div>
                   
                    </div>
                 </div>
            </form>
        </div>
    </div>
</div>


@endsection