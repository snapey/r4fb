@extends('layouts.app',[$title='Manage Roles | '])

@section('content')

    <div class="container mx-auto text-gray-700 text-sm">
        <div class="flex justify-between w-full items-center">
            <h1 class="px-4 text-2xl font-bold">Roles</h1>
            <a href="{{ route('admin.roles.create') }}"><button class="positive-button w-48">+ Add new Role</button></a>
        </div>
        <table class="mt-4 table-fixed bg-white border shadow-lg w-full">
            <thead>
                <tr class="border-b">
                    <th class="p-4 w-3/12 text-left">Name</th>
                    <th class="p-4 w-9/12 text-left">Permissions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                <tr class="{{ $loop->index %2==0 ? 'bg-indigo-100' :'' }}">
                    <td class="px-1 py-2"><a class="hover:underline hover:text-blue-800 hover:bg-yellow-200 px-4 py-1 rounded hover:shadow" 
                            href="{{ route('admin.roles.edit',$role) }}">{{ $role->name }}</a></td>
                    <td class="px-4 py-2">{{ implode(', ' , $role->permissions->pluck('name')->toArray())}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
