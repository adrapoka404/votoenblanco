<x-guest-layout>
    <x-liston>{{ __('noticias') }}</x-liston>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-2 gap-4">
        @foreach ($categories as $category)
        <div class="">
            <div class=" grid grid-rows-2 gap-2">
                <div class="mx-auto">
                    <a href="{{ route('notas.categorias', $category->slug) }}">
                        <img class=" w-86 h-52 object-cover object-center mb-4 " src="{{ asset('storage/'.$category->imagen) }}"
                            alt="{{$category->nombre}}" />
                    </a>
                </div>
                <div class="text-center mt-10">
                    <div class="ml-5 my-auto">
                        <div>
                            <a href="{{ route('notas.categorias', $category->slug) }}"
                                class="bg-red-800 px-10 text-white rounded-lg font-semibold">Ver más</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        @endforeach
    </div>
</x-guest-layout>
