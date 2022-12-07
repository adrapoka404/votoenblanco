<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="w-full container p-6 sm:px-20 bg-white border-b border-gray-200">
        <x-info />
        <div>
            <div>{{$title}}</div>
            @foreach ($masnlikeadas as $mnl)
                <div>({{$mnl->reactions}}) - {{$mnl->post->title}} 
                    <a href="{{route('admin.estadisticas.historico', $mnl->post_id)}}"
                    class="cursor-pointer bg-black px-3 py-1 rounded-full text-white mx-auto"
                    >{{__('Ver historico')}}</a></div>    
            @endforeach
            <div>
                <a href="{{ route('admin.estadisticas.index') }}"
                class="cursor-pointer bg-black px-3 py-1 rounded-full text-white mx-auto"
                >{{__('Volver a estadisticas')}}</a>
            </div>
        </div>
    </div>

</x-app-layout>

