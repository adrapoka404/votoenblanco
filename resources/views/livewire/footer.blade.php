<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-black border-t-8 border-red-800 pt-10 pb-5 my-10 text-white">
    <div class="grid grid-cols-2 ml-20">
        <div>
            <div>
                <x-actionfooter href="{{ route('dashboard') }}" :active="request()->routeIs('#')">
                    {{ __('Nosotros') }}
                </x-actionfooter>
            </div>
            <div>
                <x-actionfooter href="{{ route('dashboard') }}" :active="request()->routeIs('#')">
                    {{ __('nuestro equipo') }}
                </x-actionfooter>
            </div>
            <div>
                <x-actionfooter href="{{ route('dashboard') }}" :active="request()->routeIs('#')">
                    {{ __('aviso de privacidad') }}
                </x-actionfooter>
            </div>

            <div>Contactanos
                <div>Whats</div>
                <div>Insta</div>
                <div>FB</div>
                <div>TW</div>
                <div>TT</div>
                <div>YT</div>
            </div>
        </div>
        <div>suscribete
            cetificado
        </div>

    </div>
    <div class=" text-center">
        Metepec estado de mexico
        <br>
        COPYRIGHT todos los derecchos reservados
    </div>

</div>
