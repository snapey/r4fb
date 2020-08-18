@extends('layouts.app',[$title='Shipment: ' . $shipment->id . ' ' ])

@section('content')
<style>
    [x-cloak] {
        display: none;
    }
</style>

<div class="p-4 mb-0 bg-gray-200">
    <h1 class="text-2xl font-bold text-teal-700 ">Shipment - {{ $shipment->id }} </h1>


    <div class="flex flex-row py-4">

        <div class="w-1/2 pr-4">
            <h2 class="p-2 text-xl font-bold text-teal-700">Ship From:</h2>
            <div class="flex flex-row p-4 bg-white rounded">
                <div class="w-1/3 text-sm font-bold">
                    Address:
                </div>
                <div class="w-2/3 text-sm leading-normal text-gray-700">
                    {{ $shipment->fromAddress->addressable->name }}<br />
                    {{ $shipment->fromAddress->address1 }}<br />
                    {{ $shipment->fromAddress->address2 }}<br />
                    {{ $shipment->fromAddress->address3 }}<br />
                    {{ $shipment->fromAddress->address4 }}<br />
                    {{ $shipment->fromAddress->postcode }}<br />
                </div>
            </div>
        </div>
        <div class="w-1/2 pl-4">
            <h2 class="p-2 text-xl font-bold text-teal-700">Ship To:</h2>
            <div class="flex flex-row p-4 bg-white rounded">
                <div class="w-1/3 text-sm font-bold">
                    Address:
                </div>
                <div class="w-2/3 text-sm leading-normal text-gray-700">
                    {{ $shipment->toAddress->addressable->name }}<br />
                    {{ $shipment->toAddress->address1 }}<br />
                    {{ $shipment->toAddress->address2 }}<br />
                    {{ $shipment->toAddress->address3 }}<br />
                    {{ $shipment->toAddress->address4 }}<br />
                    {{ $shipment->toAddress->postcode }}<br />
                </div>
            </div>
            <div class="px-4 py-2 text-sm leading-snug text-gray-700 bg-white">
                @foreach($shipment->toAddress->addressable->contacts as $contact)
                    <div>
                        <strong>{{ $contact->forenames }} {{ $contact->surname }}</strong> - {{ $contact->phone1 }} <em class="text-xs">{{ $contact->pivot->relationship ?? '' }}</em>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="flex flex-row items-center justify-between my-1">
        <h2 class="px-2 py-2 text-xl font-bold text-teal-700">Allocations in this Shipment</h2>
        <div>
            <a class="mx-2" href="{{ route('shipment.pdf.multi',$shipment) }}"><x-button class="px-4">Print Consolidated</x-button></a>
            <a class="mx-2" href="{{ route('shipment.pdf.multi',$shipment) }}"><x-button class="px-4">Print All</x-button></a>
        </div>
    </div>

    <div class="p-2 bg-white rounded">
        <table class="w-full">
            <thead>
                <tr>
                    <th class="py-2 text-center">Sub</th>
                    <th class="px-2 py-2 text-left">Allocation</th>
                    <th class="px-2 py-2 text-left">Foodbank</th>
                    <th class="py-2 ">Lines</th>
                    <th></th>
                </tr>
            </thead>
            @foreach($shipment->allocations as $allocation)
            <tr>
                <td class="py-2 text-center text-gray-800 border border-gray-400">{{ $allocation->pivot->sub }}</td>
                <td class="px-2 py-2 text-gray-800 border border-gray-400">{{ $allocation->id }}</td>
                <td class="px-2 py-2 text-gray-800 border border-gray-400">{{ $allocation->foodbank->name ?? '' }}</td>
                <td class="px-2 py-2 text-center text-gray-800 border border-gray-400">{{ $allocation->stocks->count() }}</td>
                <td class="px-2 py-0 text-gray-800"><a href="{{ route('shipment.pdf',[ $shipment,$allocation ]) }}"><x-button class="px-4 py-0">Print Single</x-button></a>
            </tr>
            @endforeach
        </table>
    </div>
    @livewire('shipments.shipment-status',['shipment' => $shipment ])
</div>


<div class="py-4 mt-0 bg-gray-200">
    @livewire('notes-component',['notable' => $shipment ])
</div>

@endsection
