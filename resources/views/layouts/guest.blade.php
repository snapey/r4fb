@include('layouts._head')

<body class="h-screen font-sans antialiased leading-none bg-gray-100">
    @include('layouts._navbar')

    @yield('content')
    
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    @livewireScripts

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
    
</body>
</html>
