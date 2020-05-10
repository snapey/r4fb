@extends('layouts.app',[$title='Manage Contacts | '])

@section('content')

<div class="container mx-auto text-sm text-gray-700" x-data="{ effectivePermissions: false }">
    <div class="flex items-center justify-between w-full">
        <h1 class="px-4 text-2xl font-bold">Contacts</h1>
        @can('contacts.add')
            <a href="{{ route('admin.contacts.create') }}"><button class="w-48 positive-button">+ Add new Contact</button></a>
        @endcan
    </div>
    
    @livewire('contacts.contact-table')

</div>
@endsection