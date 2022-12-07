<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="w-full container p-6 sm:px-20 bg-white border-b border-gray-200">
        <x-info />
        <div>
            @foreach ($masleidos as $ml)
                <div>{{$ml->user->name}}</div>
                <div>{{$ml->vistas}}</div>
            @endforeach
            <div>{{$masleidos->links()}}</div>
            <div>
                <a href="{{ route('admin.estadisticas.index') }}">{{__('Volver a estadisticas')}}</a>
            </div>
        </div>
    </div>

</x-app-layout>

