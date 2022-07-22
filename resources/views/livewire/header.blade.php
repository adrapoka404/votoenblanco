<div class="mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-2">
        <div class="mt-3">
            <x-jet-application-logo />
            <div class="w-full right-0 text-center ">
                <x-redes-header />
            </div>
        </div>
        <div class="items-center my-auto flex">

            <div class=" text-right mx-auto">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Admin</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Cuenta</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Registro</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </div>
    <nav class="hidden  text-red-800 text-center my-5 font-medium">
        <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('#')">
            {{ __('Local') }}
        </x-jet-nav-link>
        <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('#')">
            {{ __('Nacional') }}
        </x-jet-nav-link>
        <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('#')">
            {{ __('Mundo') }}
        </x-jet-nav-link>
        <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('#')">
            {{ __('Deportes') }}
        </x-jet-nav-link>
        <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('#')">
            {{ __('Entretenimiento') }}
        </x-jet-nav-link>
        <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('#')">
            {{ __('Estilo devida') }}
        </x-jet-nav-link>

    </nav>

</div>
<div class="grid grid-cols-5 uppercase text-2xl text-white items-center bg-red-800 my-2 py-2">
    <button id="dropdownDefault" data-dropdown-toggle="dropdown" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Dropdown button <svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>
<!-- Dropdown menu -->
<div id="dropdown" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
      <li>
        <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
      </li>
      <li>
        <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
      </li>
      <li>
        <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
      </li>
      <li>
        <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sign out</a>
      </li>
    </ul>
</div>  
    <div class="text-center md:border-r-2 border-white"> <a href="#">Reportajes</a> </div>
    <div class="text-center md:border-r-2 border-white"> <a href="#">entrevistas</a> </div>
    <div class="text-center md:border-r-2 border-white"> <a href="#">nuestras letras</a> </div>
    <div class="text-center md:border-r-2 border-white"> <a href="#">noticias</a> </div>
    <div class="text-center">
        <div class="items-center cursor-pointer" id='buscadortxt'>
            <img src="{{ asset('img/lupita.png') }}" alt="" class=" w-6 my-auto inline">
            <label for="buscadortxt" class="cursor-pointer" id="nosearch">Buscar</label>
            <input type="text" class=" font-semibold rounded-full hidden text-red-800" placeholder="Nombre nota"
                id="search">
        </div>
    </div>
    <div class=" fixed bg-gray w-full max-h-max z-50 hidden " id="chismesito">
        <div class="bg-gray text-black font-bold text-center h-80 mx-auto  pt-56 ">
            <div class=" text-right h-10 text-black  pt-56" id="nochisme">no lo quiero ver</div>

            Aqui algo dinamico como la revista
        </div>
    </div>
</div>
<div class="grid gridcols-2 md:grid-cols-2 uppercase text-2xl text-white items-center bg-black my-2">
    <div class="uppercase text-white text-center font-sans text-lg mx-2 h-full">
        <style>
            .tradingview-widget-copyright {
                display: none;
            }
        </style>
        <!-- TradingView Widget BEGIN -->
        <div class="tradingview-widget-container">
            <div class="tradingview-widget-container__widget"></div>
            <div class="tradingview-widget-copyright"><a href="https://es.tradingview.com" rel="noopener"
                    target="_blank"><span class="blue-text">Cotizaciones</span></a> por TradingView</div>
            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-tickers.js" async>
                {
                    "symbols": [{
                            "proName": "FOREXCOM:NSXUSD",
                            "title": "US 100"
                        },
                        {
                            "proName": "FX_IDC:EURUSD",
                            "title": "EUR/USD"
                        },
                        {
                            "proName": "BITSTAMP:BTCUSD",
                            "title": "Bitcoin"
                        }
                    ],
                    "colorTheme": "dark",
                    "isTransparent": true,
                    "showSymbolLogo": true,
                    "locale": "es"
                }
            </script>
        </div>
        <!-- TradingView Widget END -->
    </div>
    <div class="uppercase text-white text-center font-sans text-lg mx-2 border-l-wine">
        <style>
            #cont_4d1c4f42bfc77fbdf132342d955b8286 {
                border: 0px !important;
            }

            .nomP,
            .slink {
                display: none !important;
            }

            .wlink .fondo tr td .temps span.tempMin {
                color: white !important;
            }
        </style>
        <div id="cont_4d1c4f42bfc77fbdf132342d955b8286">
            <script type="text/javascript" async src="https://www.meteored.mx/wid_loader/4d1c4f42bfc77fbdf132342d955b8286"></script>
        </div>

    </div>
</div>
@section('jquery')
    <script>
        $(document).ready(function() {
            console.log('jelou madre foca');
            $("#buscadortxt").on('click', function() {
                $("#search").show();
                $("#search").focus();
                $("#nosearch").hide();
            })
/*
            $("#nochisme").on('click', function(){
                $("#chismesito").hide();
            })

            setTimeout(function() { 
                $("#chismesito").show();
            }, 5000);
*/
            $( "#search" ).autocomplete({ });

            $("#search").on('keyup', function(){
                palabra = $(this).val();
                if(palabra.length > 3 ){
                    console.log('Me conecto por ajax al servidoro a buscar todo lo que contenga la palabra' + palabra )
                }else   
                console.log('aun no hago nada');
            })
            
        })
    </script>
@endsection
