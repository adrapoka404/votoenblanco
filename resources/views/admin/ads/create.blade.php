<x-app-layout>
    <x-info />
    {!! Form::open([
        'route' => 'admin.anuncios.store',
        'atocomplete' => 'off',
        'atocomplete' => 'off',
        'files' => true,
        'class' => 'px-5 mx-5',
    ]) !!}
    @include('admin.ads.partials.form')
    <div class="flex items-center justify-center mt-4 my-3">
        <x-jet-danger-button>
            <a href="{{ route('admin.anuncios.index') }}">{{ __('Cancelar') }}</a>
        </x-jet-danger-button>
        <x-jet-button class="ml-4">
            {{ __('Crear') }}
        </x-jet-button>
    </div>
    {!! Form::close() !!}
</x-app-layout>
