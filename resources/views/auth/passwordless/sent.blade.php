@extends('layouts.guest')

@section('content')
<div class="container mx-auto">
    <div class="flex flex-wrap justify-center">
        <div class="w-full max-w-lg">

            <div class="bg-blue-100  px-4 py-8 mb-4 font-bold text-gray-700 shadow-lg">
                <p class="pt-4">An email has been sent to you with a link that can be used to automatically log you into this application.</p>
                <p class="pt-4">You may now close this browser tab</p>
                <p class="pt-4 text-indigo-800 hover:underline"><a href="{{ route('login') }}">Resend ?</a></p>
            </div>

        </div>
    </div>
</div>
@endsection