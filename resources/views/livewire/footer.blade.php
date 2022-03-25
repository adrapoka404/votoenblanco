<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-black border-t-8 border-red-800 pt-10 pb-5 mt-10 mb-2 text-white">
    <div class="md:grid md:grid-cols-2 ml-20">
        <div>
            <div class="my-5">
                <x-actionfooter href="{{ route('dashboard') }}" :active="request()->routeIs('#')">
                    {{ __('Nosotros') }}
                </x-actionfooter>
            </div>
            <div class="my-5">
                <x-actionfooter href="{{ route('editores.show', 'all') }}" :active="request()->routeIs('#')">
                    {{ __('nuestro equipo') }}
                </x-actionfooter>
            </div>
            <div class="my-5">
                <x-actionfooter href="{{ route('dashboard') }}" :active="request()->routeIs('#')">
                    {{ __('aviso de privacidad') }}
                </x-actionfooter>
            </div>

            <div class=" mt-20 font-sans font-light tracking-widest">Contáctanos
                <a href="">
                    <div class=" bg-whats w-12 h-12 bg-contain"></div>
                </a>
                <br>
                Redes Sociales
                <br>
                <div class=" inline-flex mt-5">
                    <a href="">
                        <div class="w-12 h-12 bg-no-repeat mx-2 bg-insta bg-contain"></div>
                    </a>
                    <a href="">
                        <div class="w-12 h-12 bg-no-repeat mx-2 bg-fb bg-contain"></div>
                    </a>
                    <a href="">
                        <div class="w-12 h-12 bg-no-repeat mx-2 bg-tw bg-contain"></div>
                    </a>
                    <a href="">
                        <div class="w-12 h-12 bg-no-repeat mx-2 bg-tt bg-contain"></div>
                    </a>
                    <a href="">
                        <div class="w-12 h-12 bg-no-repeat mx-2 bg-yt bg-contain"></div>
                    </a>
                </div>
                <br>
                <a href="">Anúnciate con nosotros</a>
            </div>
        </div>
        <div class="font-sans tracking-widest items-end">
            <a href="">
                <div>Suscribete</div>
            </a>
            <div class="bg-security bg-no-repeat w-52 h-52"></div> Cetificado de seguridad
        </div>

    </div>
    <div class=" font-sans tracking-widest text-center mt-20">
        Metepec. Estado de México
        <br>
        COPYRIGHT todos los derecchos reservados
    </div>

</div>
