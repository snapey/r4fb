@extends('layouts.app',[$title='Manage Shippers | '])

@section('content')

<div class="container mx-auto text-sm text-gray-700" x-data="{ effectivePermissions: false }">
    <div class="flex items-center justify-between w-full">
        <h1 class="text-xl font-bold text-teal-800">SHIPPERS</h1>
        @can('Shippers.add')
            <a href="{{ route('admin.shippers.create') }}"><button class="w-48 positive-button">+ Add new Shipper</button></a>
        @endcan
    </div>
    
    @livewire('shippers.shipper-table')

</div>
@endsection