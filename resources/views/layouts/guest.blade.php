@include('layouts._head')

<body class="bg-gray-100 h-screen antialiased leading-none font-sans">
    @include('layouts._navbar')

    @yield('content')
    
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    @include('sweetalert::alert')
    @livewireScripts

</body>
</html>
