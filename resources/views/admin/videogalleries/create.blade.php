<x-app-layout>
    <div class="w-full text-black">
        {!! Form::open(['route' => 'admin.videogalerias.store', 'atocomplete' => 'off']) !!}
        @include('admin.videogalleries.partials.form')
    </div>
    <div class="  text-right items-end justify-center my-4 mx-2">
        <x-jet-danger-button>
            <a href="{{ route('admin.videogalerias.index') }}">{{ __('Cancelar') }}</a>
        </x-jet-danger-button>
        <x-jet-button>
            {{ __('Crear') }}
        </x-jet-button>
    </div>
    {!! Form::close() !!}
</x-app-layout>
