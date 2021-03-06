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



<div class="grid grid-col-1 md:grid-cols-5 uppercase text-2xl text-white items-center bg-red-800 my-2 py-2">

    <div class="text-center md:border-r-2 border-white text-black">
        <a href="{{ route('web.reportajes') }}" class="text-white menuGral">Reportajes</a>
        <x-submenu>
            <x-submenu-link where="{{ route('notas.categorias', 7) }}" text="{{ __('Vagabundario') }}" />
            <x-submenu-link where="{{ route('notas.categorias', 6) }}" text="{{ __('Com??n unidad') }}" />
            <x-submenu-link where="{{ route('notas.categorias', 8) }}" text="{{ __('Sensaciones') }}" />
            <x-submenu-link where="{{ route('notas.categorias', 9) }}" text="{{ __('Haciendo Ecos') }}" />
        </x-submenu>
    </div>
    <div class="text-center md:border-r-2 border-white text-black ">
        <a href="{{ route('web.entrevistas') }}" class="text-white menuGral">entrevistas</a>
        <x-submenu>
            <x-submenu-link where="{{ route('notas.categorias', 10) }}" text="{{ __('conociendo a') }}" />
            <x-submenu-link where="{{ route('notas.categorias', 11) }}" text="{{ __('m??s humanos m??s chingones') }}" />
            <x-submenu-link where="{{ route('notas.categorias', 12) }}" text="{{ __('mujeres en acci??n') }}" />
            <x-submenu-link where="{{ route('notas.categorias', 13) }}" text="{{ __('victoriosos') }}" />
        </x-submenu>
    </div>
    <div class="text-center md:border-r-2 border-white text-black">
        <a href="{{route('editores.show', 'all')}}" class="text-white menuGral">nuestras letras</a>
        <x-submenu>
            <x-submenu-link where="{{ route('notas.editores', 1) }}" text="{{ __('Raymundo Rivera') }}" />
        </x-submenu>
    </div>
    <div class="text-center md:border-r-2 border-white text-black">
        <a href="{{ route('web.noticias') }}" class="text-white  menuGral">noticias</a>
        <x-submenu>
            <x-submenu-link where="{{ route('notas.categorias', 14) }}" text="{{ __('Local') }}" />
            <x-submenu-link where="{{ route('notas.categorias', 16) }}" text="{{ __('Nacional') }}" />
            <x-submenu-link where="{{ route('notas.categorias',15) }}" text="{{ __('Internacional') }}" />
            <x-submenu-link where="{{ route('notas.categorias',17) }}" text="{{ __('Deportes') }}" />
            <x-submenu-link where="{{ route('notas.categorias',18) }}" text="{{ __('Ciencia') }}" />
            <x-submenu-link where="{{ route('notas.categorias',19) }}" text="{{ __('Econom??a y Finanzas') }}" />
            <x-submenu-link where="{{ route('notas.categorias',20) }}" text="{{ __('Cultura') }}" />
            <x-submenu-link where="{{ route('notas.categorias',21) }}" text="{{ __('Entretenimiento') }}" />
        </x-submenu>
    </div>
    <div class="text-center">
        <div class="items-center cursor-pointer" id='buscadortxt'>
            <img src="{{ asset('img/lupita.png') }}" alt="" class=" w-6 my-auto inline">
            <label for="buscadortxt" class="cursor-pointer" id="nosearch">Buscar</label>
            <input type="text" class=" font-semibold rounded-full hidden text-red-800" placeholder="Nombre nota"
                id="search">
        </div>
    </div>

    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="relative z-10  hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="modalRevista">
        <!--
      Background backdrop, show/hide based on modal state.
  
      Entering: "ease-out duration-300"
        From: "opacity-0"
        To: "opacity-100"
      Leaving: "ease-in duration-200"
        From: "opacity-100"
        To: "opacity-0"
    -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-95 transition-opacity"></div>

        <div class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0">
                <!--
          Modal panel, show/hide based on modal state.
  
          Entering: "ease-out duration-300"
            From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            To: "opacity-100 translate-y-0 sm:scale-100"
          Leaving: "ease-in duration-200"
            From: "opacity-100 translate-y-0 sm:scale-100"
            To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        -->
                <div
                    class="relative bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 w-1/2">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class=" sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <div class="mt-2">
                                    @livewire('revistadigital')
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"
                            id="nochisme">Cerrar</button>
                        <!--button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cerrar</button-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="grid gridcols-3 md:grid-cols-3 uppercase text-2xl text-white items-center bg-black my-2">
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
    <div class="text-center font-light ">
        <div id="date" class="tracking-widest"></div>
        <div id="time" class="tracking-wide">La hora</div>
    </div>
    <div class="uppercase text-white text-center font-sans text-lg mx-2 border-l-wine items-center content-center">
        <style>
            #cont_6c9fd17992756724a13952cac98d9872 {
                border: 0px !important;
            }

            .nomP,
            .slink {
                display: none !important;
            }

            .wlink .fondo tr td .temps span.tempMin {
                color: white !important;
            }

            #ui-id-1{
                background: white;
            }

            #ui-id-1>li:hover{
                background: gray;
            }
        </style>
        <div id="cont_6c9fd17992756724a13952cac98d9872">
            <script type="text/javascript" async src="https://www.meteored.mx/wid_loader/6c9fd17992756724a13952cac98d9872"></script>
        </div>
    </div>
</div>
@section('jquery')
    <script>
        var theurl = "{{request()->path()}}";
        $(document).ready(function() {
            mueveReloj()
            date = new Date();

            $("#date").html(date.toDateString());

            $("#buscadortxt").on('click', function() {
                $("#search").show();
                $("#search").focus();
                $("#nosearch").hide();
            })

            $(".menuGral").on('mouseover', function() {
                $(".submenu").hide();
                $(this).siblings().show();
            })

            $(".submenu").on('mouseleave', function() {
                $(this).hide();
            })

            $("#nochisme").on('click', function() {
                console.log('Cerrar la revista');
                $("#modalRevista").hide();
            })

            //console.log('que es '+ request()->routeIs('employees.*'));

            //console.log(theurl);
            if (theurl == '/') {
                setTimeout(function() {
                    $("#modalRevista").show();
                }, 5000);
            }
            /*
                        $( "#search" ).autocomplete({ });

                        $("#search").on('keyup', function(){
                            palabra = $(this).val();
                            if(palabra.length > 3 ){
                                console.log('Me conecto por ajax al servidoro a buscar todo lo que contenga la palabra' + palabra )
                            }else   
                            console.log('aun no hago nada');
                        })
                        */

        })


        $("#search").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{ route('services.posts') }}",
                    type: 'GET',
                    dataType: 'JSON',
                    delay: 250,
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        console.log(data);
                        response($.map(data, function(item) {
                            return {
                                label: item.title,
                                value: item.id
                            }
                        }))
                    }
                })
            },
            select: function(event, ui) {
                window.location.href = "{{ route('notas.show', '') }}" + '/' + ui.item.value;
            }
        })

        function mueveReloj() {
            momentoActual = new Date()
            hora = momentoActual.getHours()
            minuto = momentoActual.getMinutes()
            segundo = momentoActual.getSeconds()

            horaImprimible = hora + " : " + (minuto < 10 ? '0' + minuto : minuto) + " : " + (segundo < 10 ? '0' + segundo :
                segundo)

            $("#time").html(horaImprimible)

            setTimeout("mueveReloj()", 1000)
        }
    </script>
@endsection
