<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENKI | @yield('title', 'Login')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> {{-- se estiver usando mix --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #FCFAF9;
            font-family: 'Segoe UI', sans-serif;
        }
        .card {
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
        .card-header {
            background-color: #48E5C2 !important;
            color: #333333;
        }
        a {
            color: #48E5C2;
        }
    </style>
</head>
<body>

    @yield('content')

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>