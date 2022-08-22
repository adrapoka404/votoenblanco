<x-guest-layout>
    <div class="w-full">
        <x-semblanza>
            <x-slot name="nombre">
                Noticias
            </x-slot>
            <x-slot name="description">

            </x-slot>
            <x-slot name="src">
{{asset('img/haciendo_ecos.png')}}
            </x-slot>
            <x-slot name="especialidad">

            </x-slot>
        </x-semblanza>
        <div class="">
            @if (count($categorias) > 0)
                @foreach ($categorias as $post)
                    <x-posts>
                        <x-slot name="src">{{ asset('storage/' . $post->image_principal) }}</x-slot>
                        <x-slot name="title">{{ $post->title }}</x-slot>
                        <x-slot name="alt">{{ $post->title }}</x-slot>
                        <x-slot name="date">{{ $post->created_at }}</x-slot>
                        <x-slot name="user">{{ $post->user->name }}</x-slot>
                        <x-slot name="userto">{{ route('notas.editores', $post->user->slug) }}</x-slot>
                        <x-slot name="sumary">{{ $post->description }}</x-slot>
                        <x-slot name="where">{{ route('notas.show', $post) }}</x-slot>

                    </x-posts>
                @endforeach
            @else
                <div class=" font-extralight text-wine text-center">
                    Actualmente no hay notas en la seccion de Noticias
                </div>
            @endif
        </div>
    </div>
</x-guest-layout>
