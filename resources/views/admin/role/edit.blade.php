@extends('layouts.app',[$title='Edit or create Role | '])

@section('head')
@endsection

@section('content')
<div class="flex items-center text-gray-700">
    <div class="w-full mx-4 lg:w-2/3 lg:mx-auto">

        <div class="bg-white border border-2 rounded shadow-md mb-12">

            <div class="font-semibold bg-gray-200 py-6 px-6 mb-0">
                @if($role->exists)
                Edit role: {{ $role->name }}

                <form class="float-right mb-3" method="POST" action="{{ route('admin.roles.destroy', $role->id)}}"
                    onsubmit="return confirm('Are you sure you want to delete this role?');">
                    @csrf @method('delete')
                    <button
                        class="w-48 -mt-2 py-2 text-sm rounded shadow bg-gray-500 hover:bg-red-800 font-bold text-white"
                        type="submit">- Delete role</button>
                </form>

                @else
                Create New role
                @endif

            </div>

            <div class="w-full p-6 flex text-sm">
                @if($role->exists)
                <form class="flex flex-col w-full" method="POST" action="{{ route('admin.roles.update',$role) }}">
                    @method('put')
                    @else
                    <form class="flex flex-col w-full" method="POST" action="{{ route('admin.roles.store') }}">
                        @endif
                        @csrf
                        <div class="">
                            {{-- form input element --}}
                            <div class="flex flex-wrap content-start mb-6 w-1/3">
                                <label for="name" class="block text-sm font-bold mb-2">Role Name:</label>

                                <input id="name" type="text" required name="name" value="{{ old('name', $role->name) }}"
                                    class="text-base font-mono shadow appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror">
                                @error('name')
                                <p class="text-red-500 text-xs italic mt-4">{{ $message }}</p>
                                @enderror
                            </div>

                            <p class= text-sm font-bold" >Permissions:</p>

                            <div class="flex w-full mt-2">

                                <div class="w-1/3 bg-gray-200 rounded p-4">
                                    @if(isset($groupedPermissions[0]))
                                        @foreach($groupedPermissions[0] as $permission)
                                            <div class="w-full py-1"><label>
                                                <input type="checkbox" class="mr-2" name="permissions[]" value="{{ $permission->id }}"
                                                    {{ $role->permissions->contains('id',$permission->id)? 'checked': ''}}
                                                    >{{ $permission->name }}</label></div>
                                        @endforeach
                                    @endif
                                </div>

                                <div class="w-1/3 bg-gray-200 ml-4 rounded p-4">
                                    @if(isset($groupedPermissions[1]))
                                        @foreach($groupedPermissions[1] as $permission)
                                        <div class="w-full py-1"><label>
                                            <input type="checkbox" class="mr-2" name="permissions[]" value="{{ $permission->id }}"
                                                {{ $role->permissions->contains('id',$permission->id)? 'checked': ''}}
                                                >{{ $permission->name }}</label>
                                        </div>
                                        @endforeach
                                    @endif
                                </div>

                                <div class="w-1/3 bg-gray-200 ml-4 rounded p-4">
                                    @if(isset($groupedPermissions[2]))
                                        @foreach($groupedPermissions[2] as $permission)
                                        <div class="w-full py-1"><label>
                                            <input type="checkbox" class="mr-2" name="permissions[]" value="{{ $permission->id }}"
                                                {{ $role->permissions->contains('id',$permission->id)? 'checked': ''}}
                                                >{{ $permission->name }}</label></div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>

                        <button class="positive-button" type="submit">Save</button>

                        <form>
            </div>
        </div>
    </div>
</div>
@endsection