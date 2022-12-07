<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="w-full container p-6 sm:px-20 bg-white border-b border-gray-200">
        <x-info />
        <div>
            <a href="{{ route('admin.estadisticas.index') }}"
            class="cursor-pointer bg-black px-3 py-1 rounded-full text-white mx-auto"
            >{{__('Volver a estadisticas')}}</a>
        </div>
        <div>
            @foreach ($masleidas as $ml)
                <div>{{$ml->views}}</div>
                <div>{{$ml->title}}</div>
                <a href="{{route('admin.estadisticas.historicoledas', $ml->id)}}"
                    class="cursor-pointer bg-black px-3 py-1 rounded-full text-white mx-auto"
                    >{{__('Historico')}}</a>
            @endforeach
            <div>{{$masleidas->links()}}</div>
            <div>
                <a href="{{ route('admin.estadisticas.index') }}"
                class="cursor-pointer bg-black px-3 py-1 rounded-full text-white mx-auto"
                >{{__('Volver a estadisticas')}}</a>
            </div>
        </div>
    </div>

</x-app-layout>

