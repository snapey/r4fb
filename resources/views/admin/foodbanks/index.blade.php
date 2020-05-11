@extends('layouts.app',[$title='Foodbanks Index | '])

@section('content')

<div class="container mx-auto text-sm text-gray-700" x-data="{ effectivePermissions: false }">
    <div class="flex items-center justify-between w-full">
        <h1 class="text-xl font-bold text-teal-800">FOOD BANKS</h1>
        @can('Foodbanks.add')
            <a href="{{ route('admin.users.create') }}"><button class="w-48 positive-button">+ Add new food bank</button></a>
        @endcan
    </div>
    
    @livewire('foodbanks.foodbank-table')

</div>
@endsection