@include('layouts._head')

<body class="bg-gray-100 h-screen antialiased leading-none font-sans">
    @include('layouts._navbar')

    <div class="flex">
        @include('layouts._sidebar')

        <div class="bg-white w-full h-full h-screen p-4 scrolling-auto shadow-inner">
            @yield('content')
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    @include('sweetalert::alert')
    @livewireScripts
    </body>
</html>