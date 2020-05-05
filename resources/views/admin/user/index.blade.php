@extends('layouts.app',[$title='Manage Users | '])

@section('content')

    <div class="container mx-auto text-gray-700 text-sm" x-data="{ effectivePermissions: false }">
        <div class="flex justify-between w-full items-center">
            <h1 class="px-4 text-2xl font-bold">Users</h1>
            @can('Users.add')
                <a href="{{ route('admin.users.create') }}"><button class="positive-button w-48">+ Add new user</button></a>
            @endcan
        </div>
        <table class="mt-4 table-fixed bg-white border shadow-lg w-full">
            <thead>
                <tr class="border-b">
                    <th class="p-4 w-2/12 text-left">Name</th>
                    <th class="p-4 w-2/12 text-left">Email</th>
                    <th class="p-4 w-2/12 text-center">No P/W</th>
                    <th class="p-4 w-2/12 text-left">Roles</th>
                    <th class="p-4 w-2/12 text-left">Extra Permissions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="{{ $loop->index %2==0 ? 'bg-indigo-100' :'' }} align-center">
                    <td class="px-1"><a class="hover:underline hover:text-blue-800 hover:bg-yellow-200 px-4 py-1 rounded hover:shadow" 
                            href="{{ route('admin.users.edit',$user) }}">{{ $user->name }}</a></td>
                    <td class="px-4 py-2">{{ $user->email }}</td>
                    <td class="px-4 py-2 text-center">{!! $user->passwordless? '&#10003;' : '' !!}</td>
                    <td class="px-4 py-2">{{ implode(', ' , $user->roles->pluck('name')->toArray())}}</td>
                    <td class="px-4 py-2">{{ implode(', ' , $user->permissions->pluck('name')->toArray())}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <p class="mt-8 px-4 italic">
            Users with 'No P/W' are using password-less login and will recieve an email in order to login.
        </p>

    </div>
@endsection
