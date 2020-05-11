@extends('layouts.app',[$title='Manage Contacts | '])

@section('content')

<div class="container mx-auto text-sm text-gray-700" x-data="{ effectivePermissions: false }">
    <div class="flex items-center justify-between w-full">
        <h1 class="text-xl font-bold text-teal-800">CONTACTS</h1>
        @can('Contacts.add')
            <a href="{{ route('admin.contacts.create') }}"><button class="w-48 positive-button">+ Add new contact</button></a>
        @endcan
    </div>
    
    @livewire('contacts.contact-table')

</div>
@endsection