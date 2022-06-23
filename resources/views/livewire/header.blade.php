<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
                        <a href="{{ url('/dashboard') }}"
                            class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log
                            in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
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
<div class="grid gridcols-2 md:grid-cols-4 uppercase text-2xl text-white items-center bg-red-800 my-2 py-2">
    <div class="text-center md:border-r-2 border-white"> <a href="#">Reportajes</a> </div>
    <div class="text-center md:border-r-2 border-white"> <a href="#">entrevistas</a> </div>
    <div class="text-center md:border-r-2 border-white"> <a href="#">nuestras letras</a> </div>
    <div class="text-center"> <a href="#">noticias</a> </div>

</div>
<div class="grid gridcols-2 md:grid-cols-2 uppercase text-2xl text-white items-center bg-black my-2">
    <div class="uppercase text-white text-center font-sans text-lg mx-2 h-full">
        <style>
            .tradingview-widget-copyright{
                display: none;
            }
            </style>
        <!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container">
    <div class="tradingview-widget-container__widget"></div>
    <div class="tradingview-widget-copyright"><a href="https://es.tradingview.com" rel="noopener" target="_blank"><span class="blue-text">Cotizaciones</span></a> por TradingView</div>
    <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-tickers.js" async>
    {
    "symbols": [
      {
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
            #cont_4d1c4f42bfc77fbdf132342d955b8286{
                border: 0px !important;
            }
            .nomP, .slink{
                display: none !important;
            }
            .wlink .fondo tr td .temps span.tempMin{
                color: white !important;
            }
        </style>
        <div id="cont_4d1c4f42bfc77fbdf132342d955b8286"><script type="text/javascript" async src="https://www.meteored.mx/wid_loader/4d1c4f42bfc77fbdf132342d955b8286"></script></div>
        
    </div>
</div>
