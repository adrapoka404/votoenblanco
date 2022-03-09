<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Voto en  blanco</title>

        
        <!-- Fonts -->
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Bitter:ital,wght@0,400;0,700;1,700&family=Exo:wght@400;700&display=swap');
            </style>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles
        
    </head>
    <body>
        <div class="">
            <livewire:header />
            <livewire:postprincipal />
            <livewire:videogaleria />
            <livewire:local />
            <livewire:opinion />
            <livewire:revistadigital />
            <livewire:nacional />
            <livewire:deportes />
            <livewire:footer />
        </div>
    </body>
</html>
