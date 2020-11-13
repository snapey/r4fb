@extends('layouts.app',[$title='Prepare Orders | '])

@section('content')
<style>
    [x-cloak] {
        display: none;
    }
</style>

<div class="p-4 bg-gray-200">
    <h1 class="text-xl font-bold text-teal-800 ">Prepare Orders</h1>
    <div class="flex flex-row">
        <div class="w-4/12 mt-8">
            <h2 class="ml-2 text-xl font-bold text-teal-800">Allocations</h2>

            <div class="p-1 mt-2 text-sm text-gray-800 bg-white border border-gray-300 rounded">
                <table class="w-full">
                    <thead>
                        <tr>
                            <td class="p-1 text-xs font-bold">Alloc.</td>
                            <td class="p-1 text-xs font-bold">Foodbank</td>
                            <td class="p-1 text-xs font-bold text-right">Total</td>
                        </tr>
                    </thead>
                @foreach($allocations as $allocation)
                    <tr>
                        <td class="px-1 py-1">{{ $allocation->id }}</td>
                        <td class="px-1 py-1">{{ Illuminate\Support\Str::limit($allocation->foodbank->name ?? '',20) }}</td>
                        <td class="px-1 py-1 text-right"><x-pp v="{{ $allocation->total }}" /></td>
                    </tr>
                @endforeach
                    <tr>
                        <td></td>
                        <td class="font-bold text-right">Total:</td>
                        <td class="p-1 text-right border-2 border-b-0 border-l-0 border-r-0 border-gray-600"><x-pp v="{{ $allocations->sum('total') }}" /></td>
                    <tr>
                </table>
            </div>
        </div>

        <div class="w-1/12"></div>

        <div class="w-7/12 mt-8">
            <h2 class="ml-2 text-xl font-bold text-teal-800">Items</h2>
            <div class="p-1 mt-2 text-sm bg-white border border-gray-300 rounded">
                <table class="w-full text-gray-800">
                    <thead>
                        <tr>
                            <td class="p-1 text-xs font-bold">Code</td>
                            <td class="p-1 text-xs font-bold">Description</td>
                            <td class="p-1 text-xs font-bold text-center">Qty</td>
                            <td class="p-1 text-xs font-bold text-right">Each</td>
                            <td class="p-1 text-xs font-bold text-right">Total</td>
                        </tr>
                    </thead>
                    @php $total=0; @endphp
                    @foreach($lines as $line)
                        @php
                            $lineTotal = $line->sum('qty') * $line->first()->item->each;
                            $total = $total + $lineTotal;
                        @endphp
                        <tr>
                            <td class="p-1">{{ $line->first()->item->code ?? 'Error' }}</td>
                            <td class="p-1">{{ $line->first()->item->description ?? 'Error' }}</td>
                            <td class="p-1 text-center">{{ $line->sum('qty') }}</td>
                            <td class="p-1 text-right {{ $line->first()->each == $line->first()->item->each ?: 'bg-red-600 text-white' }}"><x-pp v="{{ $line->first()->item->each}}" /></td>
                            <td class="p-1 text-right"><x-pp v="{{ $lineTotal }}" /></td>
                        </tr>
                    @endforeach
                    <tr>
                        <td class="p-1 font-bold text-right" colspan="4">Total:</td>
                        <td class="p-1 text-right border-2 border-b-0 border-l-0 border-r-0 border-gray-600"><x-pp v="{{ $total }}" /></td>
                    </tr>
                </table>
            </div>

            @if($allocations->sum('total') != $total)
                <p class="px-2 py-1 mt-2 text-sm leading-normal bg-white border border-red-600 rounded shadow-lg">There is a discrepancy in the pricing.  Check the above list for highlighted prices. Ideally, you
                    should correct the price on the allocation(s) by removing and re-adding the item.</p>
            @endif

            <div class="p-2 mt-8">
                <h2 class="my-2 text-xl font-bold text-teal-800" >Create order</h2>
                <p class="text-sm italic text-indigo-700">All items on order will be shipped to the same address</p>

                <form action="{{ route('orders.create') }}" method="POST">
                    @csrf
                    <div class="flex items-center justify-between">
                        <label for="supplier">Supplier:</label>
                        <select name="supplier" class="w-4/6 px-4 py-1 mt-2 text-gray-800 bg-white rounded" id="supplier" required>
                            <option value="">Select Supplier</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <label for="shipto">Ship To:</label>
                        <select name="shipto" class="w-4/6 px-4 py-1 mt-2 text-gray-800 bg-white rounded" id="shipto" required>
                            <option value="">Select Ship To</option>
                            <optgroup label="Shippers">
                            @foreach($shippers as $shipper)
                                @foreach($shipper->addresses as $address)
                                <option value="{{ $address->id }}">{{ $shipper->name }} - {{ $address->address1 }} - {{ $address->postcode }}</option>
                                @endforeach
                            @endforeach
                            </optgroup>
                            <optgroup label="Foodbanks">
                            @foreach($allocations as $allocation)
                                @foreach($allocation->foodbank->addresses as $address)
                                <option value="{{ $address->id }}">{{ $allocation->foodbank->name }} - {{ $address->address1 }} - {{ $address->postcode }}</option>
                                @endforeach
                            @endforeach
                            </optgroup>
                        </select>
                    </div>


                        @foreach($allocations as $allocation)
                            <input type="hidden" value="{{ $allocation->id }}" name="allocations[]" />
                        @endforeach
                        <x-button type="submit" class="px-8">Create Order</x-button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>


@endsection