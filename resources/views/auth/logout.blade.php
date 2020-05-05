@extends('layouts.guest',[$title='Logout | '])

@section('content')
<div class="container mx-auto mt-8">
    <div class="flex flex-wrap justify-center">
        <div class="w-full max-w-md">

            <h1 class="text-2xl text-gray-700 text-center">You have been successfully logged out</h1>

            <p class='mt-8 text-xl text-indigo-800 text-center underline'><a href="{{ route('login') }}">Login?</a></p>

            <script type="text/javascript">
                history.pushState(null, null, `{{ route('logout') }}`);
                window.addEventListener('popstate', function () {
                    history.pushState(null, null, `{{ route('logout') }}`);
                });
            </script>

        </div>
    </div>
</div>
@endsection