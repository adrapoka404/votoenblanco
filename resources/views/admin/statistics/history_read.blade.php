
<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="w-full container p-6 sm:px-20 bg-white border-b border-gray-200">
        <x-info />
        <div>
            <div>{{$post->title}}</div>
            @foreach ($history as $h)
                <div>({{$h->created_at}}) </div>    
            @endforeach
            <div>
                <a href="{{ route('admin.estadisticas.index') }}"
                class="cursor-pointer bg-black px-3 py-1 rounded-full text-white mx-auto"
                >{{__('Volver a estadisticas')}}</a>
            </div>
        </div>
    </div>

</x-app-layout>

