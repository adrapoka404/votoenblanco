<x-guest-layout>
    <x-liston>{{ __('entrevistas') }}</x-liston>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-3 gap-4">

        @foreach ($categories as $i => $category)
        @if (fmod($i, 2) == 0)
        <div class="col-span-3">
            <div class=" grid grid-cols-2">
                <div class="mx-auto">
                    <a href="{{ route('notas.categorias', $category->slug) }}">
                        <img class=" w-86 h-52 object-cover object-center mb-4 " src="{{ asset('storage/'.$category->imagen) }}"
                            alt="{{$category->nombre}}" />
                    </a>
                </div>
                <div class="text-left mt-10">
                    <div class="ml-5 my-auto">
                        <div class="text-red-800 font-semibold">Descripción</div>
                        <div>
                            {{$category->description}}
                        </div>
                        <div>
                            <div class="text-red-800 font-semibold">Formato de video</div>
                            <div>
                                {{$category->description_video}}
                            </div>
                        </div>
                        <div>
                            <a href="{{ route('notas.categorias', $category->slug) }}"
                                class="bg-red-800 px-10 text-white rounded-lg font-semibold">Ver más</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class=" col-span-3">
            <div class=" grid grid-cols-2">
                <div class="text-left mt-10">
                    <div class="ml-5 my-auto">
                        <div class="text-red-800 font-semibold">Descripción</div>
                        <div>
                            {{$category->description}}
                        </div>
                        <div>
                            <div class="text-red-800 font-semibold">Formato de video</div>
                            <div>
                                {{$category->description_video}}
                            </div>
                        </div>
                        <div>
                            <a href="{{ route('notas.categorias', $category->slug) }}"
                                class="bg-red-800 px-10 text-white rounded-lg font-semibold">Ver más</a>
                        </div>
                    </div>
                </div>
                <div class="mx-auto">
                    <a href="{{ route('notas.categorias', $category->slug) }}">
                        <img class=" w-86 h-52 object-cover object-center mb-4 " src="{{ asset('storage/'.$category->imagen) }}"
                            alt="{{$category->nombre}}" />
                    </a>
                </div>
            </div>

        </div>
        @endif
        @endforeach
    </div>
</x-guest-layout>
