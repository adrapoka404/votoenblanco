<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-2">
        <div class="">
            <x-jet-application-logo />
            <div class="border-2 border-gray w-64 mx-auto text-center">
                redes sociales
            </div>
        </div>
        <div class="items-center my-auto">
            <span class="w-1/3 uppercase text-red-800 font-sans text-lg mx-2">Valores dolar</span>
            <span class="w-1/3 uppercase text-red-800 font-sans text-lg mx-2">dd/mm/aaaa</span>
            <span class="w-1/3 uppercase text-red-800 font-sans text-lg mx-2">Clima</span>
        </div>
    </div>
    <nav class=" text-red-800 text-center my-5">
        <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('#')">
            {{__('Local')}}
        </x-jet-nav-link>
        <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('#')">
            {{__('Nacional')}}
        </x-jet-nav-link>
        <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('#')">
            {{__('Mundo')}}
        </x-jet-nav-link>
        <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('#')">
            {{__('Deportes')}}
        </x-jet-nav-link>
        <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('#')">
            {{__('Entretenimiento')}}
        </x-jet-nav-link>
        <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('#')">
            {{__('Estilo devida')}}
        </x-jet-nav-link>
        @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>
            
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                    @endif
                @endauth
            @endif
    </nav>
    
</div>
<div class="grid grid-cols-3 uppercase text-2xl text-white items-center bg-red-800 my-2 py-2">
    <div class="text-center">Reportes</div>
    <div class="text-center">entrevistas</div>
    <div class="text-center">nuestras letras</div>
</div>