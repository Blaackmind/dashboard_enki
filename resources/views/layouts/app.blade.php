<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENKI - Biblioteca Digital</title>
    
    <!-- ENKI Colors e Bootstrap via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
    <style>
        html, body {
            height: 100%;
        }
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .enki-main-wrapper {
            flex: 1 0 auto;
            display: flex;
            flex-direction: row;
            min-height: 0;
        }
        main.flex-grow-1 {
            min-width: 0;
        }
    </style>
</head>

<body>
    @include('layouts.navbars.navbar')

    <div class="enki-main-wrapper">
        @include('layouts.navbars.sidebar')

        <main class="flex-grow-1 p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('content')
        </main>
    </div>

    @include('layouts.footer')

    @stack('js')
</body>

</html>
