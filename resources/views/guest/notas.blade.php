<x-guest-layout>
    <div class="w-full">
        <x-semblanza>
            <x-slot name="nombre">
                @if (isset($category))
                    {{ $category->nombre }}
                @endif
                @if (isset($editor))
                    {{ $editor->name }}
                @endif

                <x-slot name="description">
                    {{ __('Recomendación de sitios para turistear, comer, comprar, etc. Formato de reportaje, puede incluir entrevistas.') }}
                </x-slot>
                <x-slot name="src">
                    @if (isset($category))
                        {{ asset('public/storage/' . $category->imagen) }}
                    @endif
                    @if (isset($editor))
                        {{ asset('public/storage/' . $editor->profile_photo_url) }}
                    @endif
                </x-slot>
                <x-slot name="especialidad">
                    @if (isset($category))
                        {{ $category->nombre }}
                    @endif
                    @if (isset($editor))
                        {{ $editor->name }}
                    @endif
                </x-slot>
        </x-semblanza>
        <div class="">
            @if (count($posts) > 0)
                @foreach ($posts as $post)
                    <x-posts>
                        <x-slot name="src">{{ asset($post->imagen_principal) }}</x-slot>
                        <x-slot name="title">{{ $post->title }}</x-slot>
                        <x-slot name="alt">{{ $post->title }}</x-slot>
                        <x-slot name="date">{{ $post->created_at }}</x-slot>
                        <x-slot name="user">{{ $post->user->name }}</x-slot>
                        <x-slot name="userto">{{ route('notas.editores', $post->user->id) }}</x-slot>
                        <x-slot name="sumary">{{ $post->description }}</x-slot>
                        <x-slot name="where">{{ route('notas.show', $post->id) }}</x-slot>

                    </x-posts>
                @endforeach
            @else
                <div class=" font-extralight text-wine text-center">

                    @if (isset($category))
                        Actualmente no hay notas en la seccion de {{ $category->nombre }}
                    @endif
                    @if (isset($editor))
                        Actualmente no hay notas de {{ $editor->name }}
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-guest-layout>
