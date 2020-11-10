@extends('layouts.app',[$title='Items Index | '])

@section('content')

<div class="container mx-auto text-sm text-gray-700" x-data="{ effectivePermissions: false }">
    <div class="flex items-center justify-between w-full">
        <h1 class="text-xl font-bold text-teal-800">Items</h1>
        @can('Items.add')
        <a href="{{ route('admin.items.create') }}"><button class="w-48 positive-button">+ Create New Item</button></a>
        @endcan
    </div>

    @livewire('import-catalogue')
    @livewire('items.items-table')
    

</div>
@endsection