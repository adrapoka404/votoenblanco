<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Voto en blanco</title>


    <!-- Fonts -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bitter:ital,wght@0,400;0,700;1,700&family=Exo:wght@400;700&display=swap');

    </style>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
     <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles
    {!! SEO::generate() !!}
</head>
{!! SEO::generate() !!}
<body>

    <body>
        <livewire:header />
        {{ $slot }}
        <livewire:footer />
        @livewireScripts
        @yield('jquery')
    </body>

</html>
