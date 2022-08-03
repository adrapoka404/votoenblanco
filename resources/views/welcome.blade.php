<x-guest-layout>
    <div class="">
        <div class="mx-auto flex  my-10 ">
            <div class=" text-center w-1/3  flex-1 pl-10">
                <div class="text-red-800 text-3xl font-bold mb-5 w-full">{{ $destacada->title }}</div>
                <div class="w-full h-80 bg-gray pb-2 bg-contain bg-fixed bg-no-repeat "
                    style="background-image: url('{{ asset('img/nota.png') }}')">

                </div>
            </div>
            <div class="w-1/3 flex-1 items-center content-center ">
                <div class=" pl-2 pr-5 text-justify">
                    <span class="py-2 my-3 ">Voto en blanco ({{ $destacada->created_at }}) ll Redacción</span>
                    <p class="sumary my-3">
                        {{ htmlspecialchars_decode($destacada->description, ENT_HTML5) }}
                    </p>
                    <a href="{{ route('notas.show', $destacada->id) }}"
                        class="bg-red-800 px-10 text-white rounded-lg font-semibold">leer más</a>
                </div>

            </div>
            <div class="w-1/3 flex-1 pl-10">
                <div class="pl-5 text-red-800 font-extralight text-3xl">Destacadas:</div>
                @foreach ($destacadas as $dest)
                    <div class="ml-8 pl-5 inline-flex w-full">
                        <a href="{{ route('notas.show', $dest->id) }}"
                            class="inline-flex font-bold text-lg -tracking-wide ">
                            <img src="{{ asset('img/bullet.png') }}" alt="" class="w-10 mr-1 inline-flex">
                            <small class="w-25 my-auto break-words">{{ $dest->title }}</small>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <livewire:videogaleria />

        <x-jet-action-section>
            <x-slot name="title">Local</x-slot>
            <x-slot name="description"></x-slot>
            <x-slot name="content">
                <div class="grid grid-cols-1 lg:grid-cols-2">
                    <div class=" w-full h-full bg-black text-white text-center"> Publicidad</div>
                    <div class="px-4 py-5 sm:p-6 bg-white grid md:grid-cols-2 items-center">
                        @foreach ($locales as $local)
                            <div class="w-64 h-64 py-5 my-5 mx-auto bg-center text-right"
                                style="background-image: url('https://picsum.photos/720/400')">
                                <div class="bg-black text-white w-full h-16 mt-44 bottom-1 opacity-75 font-extralight ">
                                    <span class="mr-5 my-auto ">
                                        {{ $local->title }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </x-slot>
        </x-jet-action-section>

        <livewire:opinion />
        <livewire:revistadigital />

        <x-jet-action-section>
            <x-slot name="title">Nacional</x-slot>
            <x-slot name="description"></x-slot>
            <x-slot name="content">
                <div class=" grid md:grid-cols-2 items-center mx-auto   ">
                    @foreach ($nacionales as $nacional)
                        <div class="w-64 h-64 py-5 my-5 mx-auto bg-center text-right"
                            style="background-image: url('https://picsum.photos/720/400')">
                            <div class="bg-black text-white w-full h-16 mt-44 bottom-1 opacity-75 font-extralight ">
                                <span class="mr-5 my-auto ">
                                    {{ $nacional->title }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </x-slot>
        </x-jet-action-section>


        <x-jet-action-section>
            <x-slot name="title">Deportes</x-slot>
            <x-slot name="description"></x-slot>
            <x-slot name="content">
                <div class=" grid md:grid-cols-2 items-center mx-auto   ">
                    @foreach ($deportes as $deporte)
                        <div class="w-64 h-64 py-5 my-5 mx-auto bg-center text-right"
                            style="background-image: url('https://picsum.photos/720/400')">
                            <div class="bg-black text-white w-full h-16 mt-44 bottom-1 opacity-75 font-extralight ">
                                <span class="mr-5 my-auto ">
                                    {{ $deporte->title }}
                                </span>
                            </div>
                        </div>
                    @endforeach

                </div>
            </x-slot>
        </x-jet-action-section>


    </div>
</x-guest-layout>
