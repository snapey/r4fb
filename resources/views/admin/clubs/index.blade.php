@extends('layouts.app',[$title='Manage Clubs | '])

@section('content')

<div class="container mx-auto text-sm text-gray-700" x-data="{ effectivePermissions: false }">
    <div class="flex items-center justify-between w-full">
        <h1 class="text-xl font-bold text-teal-800">CLUBS</h1>
        @can('Clubs.add')
            <a href="{{ route('admin.clubs.create') }}"><button class="w-48 positive-button">+ Add new club</button></a>
        @endcan
    </div>
    
    @livewire('clubs.club-table')

</div>
@endsection