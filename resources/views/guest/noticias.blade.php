<x-guest-layout>
    <x-liston>{{ __('noticias') }}</x-liston>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-2 gap-4">

        <div class="">
            <div class=" grid grid-rows-2 gap-2">
                <div class="mx-auto">
                    <a href="{{ route('notas.categorias', 14) }}">
                        <img class=" w-86 h-52 object-cover object-center mb-4 " src="{{ asset('img/local.png') }}"
                            alt="Image Size 720x400" />
                    </a>
                </div>
                <div class="text-center mt-10">
                    <div class="ml-5 my-auto">
                        <div>
                            <a href="{{ route('notas.categorias', 14) }}"
                                class="bg-red-800 px-10 text-white rounded-lg font-semibold">Ver más</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <div class=" grid grid-rows-2">
                <div class="mx-auto">
                    <a href="{{ route('notas.categorias', 16) }}">
                        <img class=" w-86 h-52 object-cover object-center mb-4 " src="{{ asset('img/nacional.png') }}"
                            alt="Image Size 720x400" />
                    </a>
                </div>
                <div class="text-center mt-10">
                    <div class="ml-5 my-auto">
                        
                        <div>
                            <a href="{{ route('notas.categorias', 16) }}"
                                class="bg-red-800 px-10 text-white rounded-lg font-semibold">Ver más</a>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="">
            <div class=" grid grid-rows-2 gap-2">
                <div class="mx-auto">
                    <a href="{{ route('notas.categorias', 15) }}">
                        <img class=" w-86 h-52 object-cover object-center mb-4 " src="{{ asset('img/internacional.png') }}" alt="Image Size 720x400" />
                    </a>
                </div>
                <div class="text-center mt-10">
                    <div class="ml-5 my-auto">
                        <div>
                            <a href="{{ route('notas.categorias', 15) }}"
                                class="bg-red-800 px-10 text-white rounded-lg font-semibold">Ver más</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <div class=" grid grid-rows-2 gap-2">
                <div class="mx-auto">
                    <a href="{{ route('notas.categorias', 17) }}">
                        <img class=" w-86 h-52 object-cover object-center mb-4 " src="{{ asset('img/deportes.png') }}" alt="Image Size 720x400" />
                    </a>
                </div>
                <div class="text-center mt-10">
                    <div class="ml-5 my-auto">
                        <div>
                            <a href="{{ route('notas.categorias', 17) }}"
                                class="bg-red-800 px-10 text-white rounded-lg font-semibold">Ver más</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <div class=" grid grid-rows-2 gap-2">
                <div class="mx-auto">
                    <a href="{{ route('notas.categorias', 18) }}">
                        <img class=" w-86 h-52 object-cover object-center mb-4 " src="{{ asset('img/ciencia.png') }}" alt="Image Size 720x400" />
                    </a>
                </div>
                <div class="text-center mt-10">
                    <div class="ml-5 my-auto">
                        <div>
                            <a href="{{ route('notas.categorias', 18) }}"
                                class="bg-red-800 px-10 text-white rounded-lg font-semibold">Ver más</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <div class=" grid grid-rows-2 gap-2">
                <div class="mx-auto">
                    <a href="{{ route('notas.categorias', 19) }}">
                        <img class=" w-86 h-52 object-cover object-center mb-4 " src="{{ asset('img/ecofinanzas.png') }}" alt="Image Size 720x400" />
                    </a>
                </div>
                <div class="text-center mt-10">
                    <div class="ml-5 my-auto">
                        <div>
                            <a href="{{ route('notas.categorias', 19) }}"
                                class="bg-red-800 px-10 text-white rounded-lg font-semibold">Ver más</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <div class=" grid grid-rows-2 gap-2">
                <div class="mx-auto">
                    <a href="{{ route('notas.categorias', 20) }}">
                        <img class=" w-86 h-52 object-cover object-center mb-4 " src="{{ asset('img/cultura.png') }}" alt="Image Size 720x400" />
                    </a>
                </div>
                <div class="text-center mt-10">
                    <div class="ml-5 my-auto">
                        <div>
                            <a href="{{ route('notas.categorias', 20) }}"
                                class="bg-red-800 px-10 text-white rounded-lg font-semibold">Ver más</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <div class=" grid grid-rows-2 gap-2">
                <div class="mx-auto">
                    <a href="{{ route('notas.categorias', 21) }}">
                        <img class=" w-86 h-52 object-cover object-center mb-4 " src="{{ asset('img/entretenimiento.png') }}" alt="Image Size 720x400" />
                    </a>
                </div>
                <div class="text-center mt-10">
                    <div class="ml-5 my-auto">
                        <div>
                            <a href="{{ route('notas.categorias', 21) }}"
                                class="bg-red-800 px-10 text-white rounded-lg font-semibold">Ver más</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</x-guest-layout>
