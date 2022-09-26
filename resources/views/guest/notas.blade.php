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
                   <div class="h-32 ">
                    @if(isset($ads_category))
                        @foreach ($ads_category as $ac)
                        <img src="{{asset('storage/'.$ac->body)}}" alt="{{$ac->name}}" class=" h-32">
                        @endforeach
                    @endif
                </div>
                </x-slot>
                <x-slot name="src">
                    @if (isset($category))
                        {{ asset('storage/'. $category->imagen) }}
                    @endif
                    @if (isset($editor))
                        {{ $editor->profile_photo_url }}
                    @endif
                </x-slot>
                <x-slot name="especialidad">
                    @if (isset($editor))
                        {{ $editor->name }}
                    @endif
                </x-slot>
        </x-semblanza>
        <div class="">
            @if (count($posts) > 0)
                @foreach ($posts as $post)
                    <x-posts>
                        <x-slot name="src">{{ asset('storage/'.$post->image_principal) }}</x-slot>
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

                    @if (isset($category))
                        Actualmente no hay notas en la seccion de {{ $category->nombre }}
                    @endif
                    @if (isset($editor))
                        Actualmente no hay notas de {{ $editor->name }}
                    @endif
                </div>
            @endif
        </div>
        {{$posts->links()}}
    </div>
</x-guest-layout>
