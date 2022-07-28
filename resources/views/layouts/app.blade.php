<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui.min.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

</head>

<body x-data class="h-screen mx-auto antialiased flex justify-between">
    <x-jet-banner />

    <div class="min-h-screen bg-gray-100 flex">
        @livewire('navigation-menu')
        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('vendor/jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-ui/jquery-ui.min.js') }}"></script>
    @yield('jqueryui')
    <script>
       /*
       $(document).ready(function() {
            console.log('jelou madre foca');
            
        })

        var posts = ['post1', 'post2', 'post3', 'post4', 'post5', 'post6'];
            $("#related_autocomplete").autocomplete({
                source: function(request, response){

                }
            })*/
    </script>

</body>

</html>
