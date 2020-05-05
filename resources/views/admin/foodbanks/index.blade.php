@extends('layouts.app',[$title='Manage Users | '])

@section('content')

<div class="container mx-auto text-gray-700 text-sm" x-data="{ effectivePermissions: false }">
    <div class="flex justify-between w-full items-center">
        <h1 class="px-4 text-2xl font-bold">Food Banks</h1>
        @can('foodbanks.add')
            <a href="{{ route('admin.users.create') }}"><button class="positive-button w-48">+ Add new Food bank</button></a>
        @endcan
    </div>
    
    @livewire('foodbank-table')

</div>
@endsection