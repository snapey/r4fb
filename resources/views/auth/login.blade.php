@extends('layouts.guest',[$title='Login | '])

@section('content')
<div class="container mx-auto mt-8">
    <div class="flex flex-wrap justify-center">
        <div class="w-full max-w-sm">

            @error('email')
            <div class="bg-red-100 text-center px-4 py-8 mb-4 border-l-8 font-bold border-red-700 text-gray-700">
                {{ $message }}
            </div>
            @enderror

            @livewire('auth.login', ['email' =>old('email')])

        </div>
    </div>
</div>
@endsection