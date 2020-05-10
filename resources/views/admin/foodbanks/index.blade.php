@extends('layouts.app',[$title='Manage Users | '])

@section('content')

<div class="container mx-auto text-sm text-gray-700" x-data="{ effectivePermissions: false }">
    <div class="flex items-center justify-between w-full">
        <h1 class="px-4 text-2xl font-bold">Food Banks</h1>
        @can('foodbanks.add')
            <a href="{{ route('admin.users.create') }}"><button class="w-48 positive-button">+ Add new Food bank</button></a>
        @endcan
    </div>
    
    @livewire('foodbanks.foodbank-table')

</div>
@endsection