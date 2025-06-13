<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENKI - Biblioteca Digital</title>
    
    <!-- ENKI Colors e Bootstrap via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>

<body class="bg-white text-black">
    @include('layouts.navbars.navbar')

    <div class="d-flex">
        @include('layouts.navbars.sidebar')

        <main class="flex-grow-1 p-4">
            @yield('content')
        </main>
    </div>

    @include('layouts.footer')

    @stack('js')
</body>

</html>
