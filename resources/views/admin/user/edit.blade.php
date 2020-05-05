@extends('layouts.app',[$title='Add or edit Users | '])

@section('head')
@endsection

@section('content')
<div class="flex items-center text-gray-700 text-sm">
    <div class="w-full mx-4 lg:w-2/3 lg:mx-auto">

        @if (session('status'))
        <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4"
            role="alert">
            {{ session('status') }}
        </div>
        @endif

        <div class="bg-white border border-2 rounded shadow-md mb-12">

            <div class="bg-gray-200 py-6 px-6 mb-0 flex items-center justify-between">
                @if($user->exists)
                    <h1 class="text-lg font-bold text-gray-800">Edit User: {{ $user->name }}</h1>

                    @can('Users.delete')
                        <form class="" method="POST" action="{{ route('admin.users.destroy', $user->id)}}"
                            onsubmit="return confirm('Are you sure you want to delete this User?');">
                            @csrf @method('delete')
                            <button
                                class="w-48 -mt-2 py-2 text-sm rounded shadow bg-gray-500 hover:bg-red-800 font-bold text-white"
                                type="submit">- Delete User</button>
                        </form>
                    @endcan
                    
                @else
                    <h1 class="text-lg font-bold text-gray-800">Create New User</h1>
                @endif

            </div>

            <div class="w-full p-6 flex">
            @if($user->exists)
                <form class="flex flex-col w-full" method="POST" action="{{ route('admin.users.update',$user) }}">
                    @method('put')
            @else
                <form class="flex flex-col w-full" method="POST" action="{{ route('admin.users.store') }}">
            @endif
                    @csrf
                    <div class="flex w-full">
                        {{-- form input element --}}
                        <div class="flex flex-wrap content-start mb-6 w-1/3 text-base">
                            <label for="name" class="block  text-sm font-bold mb-2">User Name:</label>

                            <input id="name" type="text" required name="name" value="{{ old('name', $user->name) }}"
                                class="text-base font-mono shadow appearance-none border rounded w-full py-2 px-3  leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror">
                            @error('name')
                            <p class="text-red-500 text-xs italic mt-4">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- form input element --}}
                        <div class="flex flex-wrap content-start mb-6 w-2/3 ml-4 text-base">
                            <label for="email" class="block  text-sm font-bold mb-2">Email:</label>

                            <input id="email" type="text" required name="email"
                                value="{{ old('email', $user->email) }}"
                                class="text-base font-mono shadow appearance-none border rounded w-full py-2 px-3  leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror">
                            @error('email')
                            <p class="text-red-500 text-xs italic mt-4">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex w-full">

                        {{-- form input element --}}
                        <div class="flex flex-wrap content-start mb-6 w-1/3">
                            <label for="password"
                                class="block  text-sm font-bold mb-2">Password:</label>

                            <input id="password" type="text" name="password" value="{{ old('password') }}"
                                class="text-base font-mono shadow appearance-none border rounded w-full py-2 px-3  leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror">
                            @error('password')
                            <p class="text-red-500 text-xs italic mt-4">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- form input element --}}
                        <div class="flex flex-wrap content-start mb-6 w-1/3 rounded shadow pt-3 ml-4 mt-5 border">
                            <label for="passwordless"
                                class="block text-sm font-bold mb-2 pl-4">Login without password?</label>

                            <input id="passwordless" type="checkbox" name="passwordless" value="1"
                                class="ml-4 focus:outline-none focus:shadow-outline @error('passwordless') border-red-500 @enderror"
                                @if($user->passwordless) checked @endif
                            >
                            @error('passwordless')
                            <p class="text-red-500 text-xs italic mt-4">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- form input element --}}
                        <div class="flex flex-wrap content-start mb-6 w-1/3 pl-4">
                            <label for="mobile" class="block  text-sm font-bold mb-2">Mobile: <span class="text-xs font-normal">(for notifications)</span></label>
                        
                            <input id="mobile" type="text" name="mobile" value="{{ old('mobile', $user->mobile) }}"
                                class="text-base font-mono shadow appearance-none border rounded w-full py-2 px-3  leading-tight focus:outline-none focus:shadow-outline @error('mobile') border-red-500 @enderror">
                            @error('mobile')
                            <p class="text-red-500 text-xs italic mt-4">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                    @include('admin.user._roles')
                    @include('admin.user._permissions')

                    <button class="positive-button" type="submit">Save</button>
                <form>
            </div>
        </div>
    </div>
</div>
@endsection