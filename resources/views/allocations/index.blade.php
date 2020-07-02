@extends('layouts.app',[$title='Allocations Index | '])

@section('content')

<div class="container mx-auto text-sm text-gray-700" x-data="{ effectivePermissions: false }">
    <div class="flex items-center justify-between w-full">
        <h1 class="text-xl font-bold text-teal-800">ALLOCATIONS</h1>
        @can('Allocations.add')
        <a href="{{ route('allocations.create') }}"><button class="w-48 positive-button">+ Create Allocation</button></a>
        @endcan
    </div>

    @livewire('allocations.allocations-table')

</div>
@endsection