@extends('layouts.app',[$title='Order {{ $order->id }} | '])

@section('content')
<style>
    [x-cloak] {
        display: none;
    }
</style>

<div class="pb-8 mb-8 bg-gray-200">
    <h1 class="py-4 mx-4 text-xl font-bold text-teal-800 ">Order {{ $order->id }} - {{ $order->status }}</h1>

    <div id="progress" class="flex items-center justify-between px-4 py-3 m-4 bg-teal-100 border-gray-500 rounded-full shadow">
        <div class="">
            @if($order->status == $order::START)
                <span class="font-bold text-gray-600">Draft</span><x-svg.circle-right class="h-6 px-1 text-gray-500" />
                <a href="#" class="font-bold text-indigo-600 underline"
                    onclick="event.preventDefault();
                    document.getElementById('marksent').submit();">Mark as Sent<a> <x-svg.circle-right class="h-6 px-1 text-gray-500" />
                <span class="font-bold text-gray-600">Confirmed</a><x-svg.circle-right class="h-6 px-1 text-gray-500" />
                <span class="font-bold text-gray-600">Received</a>
                <form action="{{route('orders.marksent',$order)}}" method="POST" id="marksent"> @csrf @method('PATCH')</form>
            @endif

            @if($order->status == $order::ORDERED)
                <span class="font-bold text-gray-600">Draft</span><x-svg.circle-right class="h-6 px-1 text-gray-500" />
                <span class="font-bold text-gray-600">Sent<x-svg.circle-right class="h-6 px-1 text-gray-500" />
                <span class="font-bold text-gray-600">Confirmed</a><x-svg.circle-right class="h-6 px-1 text-gray-500" />
                <span class="font-bold text-gray-600">Received</a>
            @endif
        </div>

        <div>
            <a href="{{ route('orders.pdf',$order) }}"><x-button class="px-4 rounded-lg">Download PDF</x-button></a>
        </div>
    </div>

    <div class="flex flex-row m-4 space-x-8">
        <div class="w-6/12 mt-8 xl:w-4/12 ">
            <h2 class="ml-2 text-xl font-bold text-teal-800">Supplier:</h2>
            <div class="p-4 mt-2 text-sm leading-relaxed text-gray-800 bg-white border border-gray-300 rounded">
                <p><span class="inline-block w-32 text-sm font-bold">Address: </span>{{ $order->supplier->name }}</p>
                <p><span class="inline-block w-32 "> </span>{{ $order->supplier->addresses->first()->address1 }}</p>
                <p><span class="inline-block w-32 "> </span>{{ $order->supplier->addresses->first()->address3 }}</p>
                <p><span class="inline-block w-32 "> </span>{{ $order->supplier->addresses->first()->address4 }}</p>
                <p><span class="inline-block w-32 "> </span>{{ $order->supplier->addresses->first()->address2 }}</p>
                <p><span class="inline-block w-32 "> </span>{{ $order->supplier->addresses->first()->postcode }}</p>
                <p>&nbsp;</p>
                <p><span class="inline-block w-32 text-sm font-bold">Phone:</span>{{ $order->supplier->phone }}</p>
                <p><span class="inline-block w-32 text-sm font-bold">email:</span>{{ $order->supplier->email }}</p>
            </div>
        </div>

        <div class="w-6/12 mt-8 xl:w-4/12 ">
            <h2 class="ml-2 text-xl font-bold text-teal-800">Ship To:</h2>
            <div class="p-4 mt-2 text-sm leading-relaxed text-gray-800 bg-white border border-gray-300 rounded">
                <p><span class="inline-block w-32 text-sm font-bold">Address: </span>{{ $order->shipto->addressable->name }}</p>
                <p><span class="inline-block w-32 text-sm font-bold"></span>{{ $order->shipto->address1 }}</p>
                <p><span class="inline-block w-32 text-sm font-bold"></span>{{ $order->shipto->address2 }}</p>
                <p><span class="inline-block w-32 text-sm font-bold"></span>{{ $order->shipto->address3 }}</p>
                <p><span class="inline-block w-32 text-sm font-bold"></span>{{ $order->shipto->address4 }}</p>
                <p><span class="inline-block w-32 text-sm font-bold"></span>{{ $order->shipto->postcode }}</p>
                <p>&nbsp;</p>
                <p><span class="inline-block w-32 text-sm font-bold">Phone:</span>{{ $order->shipto->phone_number }}</p>
            </div>
            
        </div>
    </div>

    <section id="orderLines" class="max-w-screen-xl mt-8">

        <div class="p-4 m-4 bg-white border border-gray-300 rounded">

            <table class="w-full">
                <thead>
                    <tr class="">
                        <th class="py-1 text-sm text-left">Code</th>
                        <th class="py-1 text-sm text-left">Description</th>
                        <th class="py-1 text-sm text-left">UOM</th>
                        <th class="py-1 text-sm text-right">Each</th>
                        <th class="py-1 text-sm text-center">Qty</th>
                        <th class="py-1 text-sm text-right">Line Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderlines as $line)
                        <tr class="">
                            <td class="py-2 ">{{ $line->code }}</td>
                            <td class="py-2 ">{{ $line->description }}</td>
                            <td class="py-2 ">{{ $line->uom }}</td>
                            <td class="py-2 text-right"><x-pp v="{{ $line->each }}" /></td>
                            <td class="px-4 py-2 text-center">{{ $line->qty }}</td>
                            <td class="py-2 text-right"><x-pp v="{{ $line->total }}" /></td>
                        </tr>
                    @endforeach
                    <tr>
                        <td class="py-1 font-bold text-right" colspan="5">Total:</td>
                        <td class="py-1 text-right border-2 border-b-0 border-l-0 border-r-0 border-gray-700"><x-pp v="{{$order->orderlines->sum('total')}}" /></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    @livewire('notes-component',['notable' => $order ])

</div>

@endsection