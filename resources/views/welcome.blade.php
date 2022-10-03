<x-guest-layout>
    <div class="">
        <div class="mx-auto flex  my-10 ">
            <div class=" text-center w-1/3  flex-1 pl-10">
                <div class="text-red-800 text-3xl font-bold mb-5 w-full">
                    @if (strlen($destacada->title) > 75)
                        {{ $destacada->title }}
                    @else
                        {{ substr($destacada->title, 0, 75) . '...' }}
                    @endif
                </div>
                <div class="w-full h-80 bg-gray pb-2 bg-cover bg-no-repeat "
                    style="background-image: url('{{ asset('storage/' . $destacada->image_principal) }}')">

                </div>
            </div>
            <div class="w-1/3 flex-1 items-center content-center ">
                <div class=" pl-2 pr-5 text-justify">
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
            <div class="w-1/3 flex-1 pl-10">
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
                        @foreach ($home_local as $hl)
                            <img src="{{ asset('storage/' . $hl->body) }}" alt="{{ $hl->name }}">
                        @endforeach
                    </div>
                    <div class="px-4 py-5 sm:p-6 bg-white grid md:grid-cols-2 items-center">
                        @if (!empty($locales))
                            @foreach ($locales as $local)
                                <div class="w-64 h-64 py-5 my-5 mx-auto bg-center text-right"
                                    style="background-image: url({{ asset('storage/' . $local->image_principal) }})">
                                    <div
                                        class="bg-black text-white w-full h-16 mt-44 bottom-1 opacity-75 font-extralight ">
                                        <a class="mr-5 my-auto cursor-pointer"
                                            href="{{ route('notas.show', $local->slug) }}">
                                            {{ $local->title }}
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
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
                                    <img class=" h-52 rounded-full object-cover object-center mb-4 "
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
                <div class=" grid md:grid-cols-2 items-center mx-auto   ">
                    @if (!empty($nacionales))
                        @foreach ($nacionales as $nacional)
                            <div class="w-64 h-64 py-5 my-5 mx-auto bg-center text-right"
                                style="background-image: url({{ asset('storage/' . $nacional->image_principal) }})">
                                <div class="bg-black text-white w-full h-16 mt-44 bottom-1 opacity-75 font-extralight ">
                                    <a class="mr-5 my-auto cursor-pointer "
                                        href="{{ route('notas.show', $nacional->slug) }}">
                                        {{ $nacional->title }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </x-slot>
        </x-jet-action-section>


        <x-jet-action-section>
            <x-slot name="title">Deportes</x-slot>
            <x-slot name="description"></x-slot>
            <x-slot name="content">
                <div class=" grid md:grid-cols-2 items-center mx-auto   ">
                    @if (!empty($deportes))
                        @foreach ($deportes as $deporte)
                            <div class="w-64 h-64 py-5 my-5 mx-auto bg-center text-right"
                                style="background-image: url({{ asset('storage/' . $deporte->image_principal) }})">
                                <div class="bg-black text-white w-full h-16 mt-44 bottom-1 opacity-75 font-extralight ">
                                    <a class="mr-5 my-auto cursor-pointer"
                                        href="{{ route('notas.show', $deporte->slug) }}">
                                        {{ $deporte->title }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </x-slot>
        </x-jet-action-section>


    </div>
</x-guest-layout>
