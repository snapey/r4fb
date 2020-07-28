@extends('layouts.app',[$title='Shipments Index | '])

@section('content')

<div class="container mx-auto text-sm text-gray-700">
    <div class="flex items-center justify-between w-full">
        <h1 class="text-xl font-bold text-teal-800">SHIPMENTS</h1>
    </div>

    @livewire('shipments.shipments-table')

</div>
@endsection