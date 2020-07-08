@extends('layouts.app',[$title='Add or edit Users | '])

@section('head')
@endsection

@section('content')
<div class="flex items-center text-sm text-gray-700">
    <div class="w-full mx-4 lg:w-5/6 lg:mx-auto">

        @if (session('status'))
        <div class="px-3 py-4 mb-4 text-sm text-green-700 bg-green-100 border border-t-8 border-green-600 rounded"
            role="alert">
            {{ session('status') }}
        </div>
        @endif

        <div class="mb-12 bg-white border border-2 rounded shadow-md">

            <div class="flex items-center justify-between px-6 py-6 mb-0 bg-gray-200">
                @if($user->exists)
                    <h1 class="text-lg font-bold text-gray-800">Edit User: {{ $user->name }}</h1>

                    @can('Users.delete')
                        <form class="" method="POST" action="{{ route('admin.users.destroy', $user->id)}}"
                            onsubmit="return confirm('Are you sure you want to delete this User?');">
                            @csrf @method('delete')
                            <button
                                class="w-48 py-2 -mt-2 text-sm font-bold text-white bg-gray-500 rounded shadow hover:bg-red-800"
                                type="submit">- Delete User</button>
                        </form>
                    @endcan
                    
                @else
                    <h1 class="text-lg font-bold text-gray-800">Create New User</h1>
                @endif

            </div>

            <div class="flex w-full p-6">
            @if($user->exists)
                <form class="flex flex-col w-full" method="POST" action="{{ route('admin.users.update',$user) }}">
                    @method('put')
            @else
                <form class="flex flex-col w-full" method="POST" action="{{ route('admin.users.store') }}">
            @endif
                    @csrf
                    <div class="flex w-full">
                        {{-- form input element --}}
                        <div class="flex flex-wrap content-start w-1/3 mb-6 text-base">
                            <label for="name" class="block mb-2 text-sm font-bold">User Name:</label>

                            <input id="name" type="text" required name="name" value="{{ old('name', $user->name) }}"
                                class="text-base font-mono shadow appearance-none border rounded w-full py-2 px-3  leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror">
                            @error('name')
                            <p class="mt-4 text-xs italic text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- form input element --}}
                        <div class="flex flex-wrap content-start w-2/3 mb-6 ml-4 text-base">
                            <label for="email" class="block mb-2 text-sm font-bold">Email:</label>

                            <input id="email" type="text" required name="email"
                                value="{{ old('email', $user->email) }}"
                                class="text-base font-mono shadow appearance-none border rounded w-full py-2 px-3  leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror">
                            @error('email')
                            <p class="mt-4 text-xs italic text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex w-full">

                        {{-- form input element --}}
                        <div class="flex flex-wrap content-start w-1/3 mb-6">
                            <label for="password"
                                class="block mb-2 text-sm font-bold">Password:</label>

                            <input id="password" type="text" name="password" value="{{ old('password') }}"
                                class="text-base font-mono shadow appearance-none border rounded w-full py-2 px-3  leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror">
                            @error('password')
                            <p class="mt-4 text-xs italic text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- form input element --}}
                        <div class="flex flex-wrap content-start w-1/3 pt-3 mt-5 mb-6 ml-4 border rounded shadow">
                            <label for="passwordless"
                                class="block pl-4 mb-2 text-sm font-bold">Login without password?</label>

                            <input id="passwordless" type="checkbox" name="passwordless" value="1"
                                class="ml-4 focus:outline-none focus:shadow-outline @error('passwordless') border-red-500 @enderror"
                                @if($user->passwordless) checked @endif
                            >
                            @error('passwordless')
                            <p class="mt-4 text-xs italic text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- form input element --}}
                        <div class="flex flex-wrap content-start w-1/3 pl-4 mb-6">
                            <label for="mobile" class="block mb-2 text-sm font-bold">Mobile: <span class="text-xs font-normal">(for notifications)</span></label>
                        
                            <input id="mobile" type="text" name="mobile" value="{{ old('mobile', $user->mobile) }}"
                                class="text-base font-mono shadow appearance-none border rounded w-full py-2 px-3  leading-tight focus:outline-none focus:shadow-outline @error('mobile') border-red-500 @enderror">
                            @error('mobile')
                            <p class="mt-4 text-xs italic text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                    @include('admin.user._roles')
                    @include('admin.user._permissions')

                    <button class="my-4 positive-button" type="submit">Save</button>
                <form>
            </div>
        </div>
    </div>
</div>
@endsection