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
                    <div id="carouselCategory" class="carousel slide relative" data-bs-ride="carousel">
                        <div class="carousel-inner relative w-full overflow-hidden">
                            @foreach ($ads_category as $indx => $ac)
                                <div
                                    class="carousel-item @if ($indx == 0) active @endif relative float-left w-full">
                                    <img src="{{ asset('storage/' . $ac->sections->category->origin) }}" class="block w-full h-32" alt="{{ $ac->name }}" />
                                </div>
                            @endforeach
                        </div>
                        <button
                            class="carousel-control-prev absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline left-0"
                            type="button" data-bs-target="#carouselCategory" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon inline-block bg-no-repeat" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button
                            class="carousel-control-next absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline right-0"
                            type="button" data-bs-target="#carouselCategory" data-bs-slide="next">
                            <span class="carousel-control-next-icon inline-block bg-no-repeat" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
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
                        <x-slot name="userto">{{ route('notas.editores', $post->user) }}</x-slot>
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
