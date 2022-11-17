<x-guest-layout>
    <div class="">
        <div class="md:mx-10 lg:mx-10 text-red-800 text-3xl font-bold w-full md:w-1/2 text-center">
            @if (strlen($destacada->title) > 75)
            {{ substr($destacada->title, 0, 75) . '...' }}
            @else
            {{ $destacada->title }}
            @endif
        </div>
        <div class="md:mx-10 lg:mx-10 lg:grid lg:grid-cols-3 my-10 ">
            <div class=" text-center lg:grid w-full lg:pl-10">
                <div class="w-full h-80 bg-gray pb-2 bg-contain bg-no-repeat "
                    style="background-image: url('{{ asset('storage/' . $destacada->image_principal) }}')">

                </div>
            </div>
            <div class="w-full my-10 lg:grid content-center">
                <div class="pl-2 pr-5 text-justify">
                    <span class="py-2 my-3 ">
                        <x-link-fb /> ({{ $destacada->created_at }})
                        <x-link-redactor userto="{{ route('notas.editores', $destacada->redactor->slug) }}"
                            user="{{ $destacada->redactor->name }}" />
                    </span>
                    <p class="sumary my-3">
                        {{ htmlspecialchars_decode($destacada->description, ENT_HTML5) }}
                    </p>
                    <a href="{{ route('notas.show', $destacada->slug) }}"
                        class="bg-red-800 px-10 text-white rounded-lg font-semibold">leer más</a>
                </div>

            </div>
            <div class="w-full lg:grid lg:pl-10">
                <div class="ml-5 text-red-800 font-extralight text-3xl">Destacadas:</div>
                @foreach ($destacadas as $dest)
                    <div class="ml-5 my-3  inline-flex w-7/8">
                        <a href="{{ route('notas.show', $dest->slug) }}"
                            class="inline-flex font-bold text-lg tracking-wide ">
                            <img src="{{ asset('img/bullet.png') }}" alt="" class="w-10 h-10 mr-1 inline-flex">
                            <small class="w-25 my-auto break-words">
                                @if (strlen($dest->title) > 75)
                                    {{ substr($dest->title, 0, 75) . '...' }}
                                @else
                                    {{ $dest->title }}
                                @endif
                            </small>
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
                    <div class=" w-full h-full bg-black text-white text-center">
                        <div id="carouselPanelLocal" class="carousel slide relative" data-bs-ride="carousel">
                            <div class="carousel-inner relative w-full overflow-hidden">
                                @if (empty($home_local))
                                    <div class="bg-black">Publicidad</div>
                                @else
                                    @foreach ($home_local as $indx => $hl)
                                        <div
                                            class="carousel-item @if ($indx == 0) active @endif relative float-left w-full">
                                            <img src="{{ asset('storage/' . $hl->sections->local->origin) }}"
                                                class="block w-full" alt="{{ $hl->name }}" />
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button
                                class="carousel-control-prev absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline left-0"
                                type="button" data-bs-target="#carouselPanelLocal" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon inline-block bg-no-repeat"
                                    aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button
                                class="carousel-control-next absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline right-0"
                                type="button" data-bs-target="#carouselPanelLocal" data-bs-slide="next">
                                <span class="carousel-control-next-icon inline-block bg-no-repeat"
                                    aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <div class="px-4 py-5 sm:p-6 bg-white grid md:grid-cols-2 items-center">

                        @foreach ($locales as $local)
                            @if ($local != null)
                                <div class="w-64 h-64 py-5 my-5 mx-auto bg-center text-right bg-contain bg-no-repeat"
                                    style="background-image: url({{ asset('storage/' . $local->image_principal) }})">
                                    <div
                                        class="bg-black text-white w-full h-16 mt-44 bottom-1 opacity-75 font-extralight ">
                                        <a class="mr-5 my-auto cursor-pointer"
                                            href="{{ route('notas.show', $local->slug) }}">
                                            @if (strlen($local->title) < 50)
                                                {{ $local->title }}
                                            @else
                                                {{ substr($local->title, 0, 50) . '...' }}
                                            @endif

                                        </a>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>
            </x-slot>
        </x-jet-action-section>

        <x-jet-action-section>
            <x-slot name="title">Opinión</x-slot>
            <x-slot name="description"></x-slot>
            <x-slot name="content">
                <div class=" grid md:grid-cols-2 lg:grid-cols-3 md:grid-rows-3 lg:grid-rows-2 items-center mx-auto   ">
                    @foreach ($editors as $editor)
                        <div class="grid grid-cols-2">
                            <div>
                                <a href="{{ route('notas.editores', $editor->user->slug) }}">
                                    <img class=" h-52 rounded-full object-contain bg-no-repeat object-center mb-4 "
                                        src="{{ $editor->user->profile_photo_url }}"
                                        alt="{{ $editor->user->name }}" />
                                </a>
                            </div>
                            <div class="text-left items-center content-center   ">
                                <div class="ml-5 my-auto">
                                    <div class="text-red-800 font-bold w-full">
                                        <a href="{{ route('notas.editores', $editor->user->slug) }}">
                                            {{ $editor->user->name }}
                                        </a>
                                    </div>
                                    <small>{{ $editor->specialty }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </x-slot>
        </x-jet-action-section>
        <livewire:revistadigital />

        <x-jet-action-section>
            <x-slot name="title">Nacional</x-slot>
            <x-slot name="description"></x-slot>
            <x-slot name="content">
                <div id="carouselPanelNacional" class="carousel slide relative" data-bs-ride="carousel">
                    <div class="carousel-inner relative w-full overflow-hidden">
                        @foreach ($nacionales as $indx => $nacional)
                            @if ($nacional != null)
                                @if ($indx == 0 || $indx == 3)
                                    <div
                                        class="carousel-item @if ($indx == 0) active @endif relative float-left w-full">
                                        <div class="grid md:grid-cols-3">
                                @endif
                                <div class="w-64 h-64 py-5 my-5 mx-auto bg-center text-right bg-contain bg-no-repeat"
                                    style="background-image: url({{ asset('storage/' . $nacional->image_principal) }})">
                                    <div
                                        class="bg-black text-white w-full h-16 mt-44 bottom-1 opacity-75 font-extralight ">
                                        <a class="mr-5 my-auto cursor-pointer "
                                            href="{{ route('notas.show', $nacional->slug) }}">
                                            @if (strlen($nacional->title) < 50)
                                                {{ $nacional->title }}
                                            @else
                                                {{ substr($nacional->title, 0, 50) . '...' }}
                                            @endif
                                        </a>
                                    </div>
                                </div>
                                @if ($indx == 2 || $indx == 5)
                    </div>
                </div>
                @endif
                @endif
                @endforeach
    </div>
    <button
        class="carousel-control-prev absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline left-0"
        type="button" data-bs-target="#carouselPanelNacional" data-bs-slide="prev">
        <span class="carousel-control-prev-icon inline-block bg-no-repeat" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button
        class="carousel-control-next absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline right-0"
        type="button" data-bs-target="#carouselPanelNacional" data-bs-slide="next">
        <span class="carousel-control-next-icon inline-block bg-no-repeat" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    </div>
    </x-slot>
    </x-jet-action-section>


    <x-jet-action-section>
        <x-slot name="title">Deportes</x-slot>
        <x-slot name="description"></x-slot>
        <x-slot name="content">
            <div id="carouselPanelDeportes" class="carousel slide relative" data-bs-ride="carousel">
                <div class="carousel-inner relative w-full overflow-hidden">
                    @foreach ($deportes as $indx => $deporte)
                        @if ($deporte != null)
                            @if ($indx == 0 || $indx == 3)
                                <div
                                    class="carousel-item @if ($indx == 0) active @endif relative float-left w-full">
                                    <div class="grid md:grid-cols-3">
                            @endif
                            <div class="w-64 h-64 py-5 my-5 mx-auto bg-center text-right bg-contain bg-no-repeat"
                                style="background-image: url({{ asset('storage/' . $deporte->image_principal) }})">
                                <div
                                    class="bg-black text-white w-full h-16 mt-44 bottom-1 opacity-75 font-extralight ">
                                    <a class="mr-5 my-auto cursor-pointer"
                                        href="{{ route('notas.show', $deporte->slug) }}">
                                        @if (strlen($deporte->title) < 50)
                                            {{ $deporte->title }}
                                        @else
                                            {{ substr($deporte->title, 0, 50) . '...' }}
                                        @endif
                                    </a>
                                </div>
                            </div>
                            @if ($indx == 2 || $indx == 5)
                </div>
            </div>
            @endif
            @endif
            @endforeach
            </div>
            <button
                class="carousel-control-prev absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline left-0"
                type="button" data-bs-target="#carouselPanelDeportes" data-bs-slide="prev">
                <span class="carousel-control-prev-icon inline-block bg-no-repeat" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button
                class="carousel-control-next absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline right-0"
                type="button" data-bs-target="#carouselPanelDeportes" data-bs-slide="next">
                <span class="carousel-control-next-icon inline-block bg-no-repeat" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            </div>
        </x-slot>
    </x-jet-action-section>


    </div>
</x-guest-layout>
