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
    @include('sweetalert::alert')
    @livewireScripts
    </body>
    @yield('page-js')
</html>