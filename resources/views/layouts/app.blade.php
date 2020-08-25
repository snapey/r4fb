@include('layouts._head')

<body class="h-screen font-sans antialiased leading-none bg-gray-100">
    @include('layouts._navbar')

    <div class="flex">
        @include('layouts._sidebar')

        <div class="w-full h-full h-screen p-4 scrolling-auto bg-white shadow-inner">
            @yield('content')
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>

    <script src="{{ $cdn?? asset('vendor/sweetalert/sweetalert.all.js')  }}"></script>
    @if (Session::has('alert.config'))
        @if(config('sweetalert.animation.enable'))
            <link rel="stylesheet" href="{{ config('sweetalert.animatecss') }}">
        @endif
        <script>
            Swal.fire({!! Session::pull('alert.config') !!});
        </script>
    @endif
    <script>
        window.addEventListener('swal',function(e){
            Swal.fire(e.detail);
        });
    </script>
    
    @livewireScripts
    </body>
    @yield('page-js')
</html>