@extends('layouts.app',[$title='Manage Suppliers | '])

@section('content')

<div class="container mx-auto text-sm text-gray-700" x-data="{ effectivePermissions: false }">
    <div class="flex items-center justify-between w-full">
        <h1 class="text-xl font-bold text-teal-800">SUPPLIERS</h1>
        @can('Suppliers.add')
            <a href="{{ route('admin.suppliers.create') }}"><button class="w-48 positive-button">+ Add new Supplier</button></a>
        @endcan
    </div>
    
    @livewire('suppliers.supplier-table')

</div>
@endsection