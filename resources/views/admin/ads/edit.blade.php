<x-app-layout>
    <x-info />
    {!! Form::model($ad, [
        'route' => ['admin.anuncios.update', $ad],
        'method' => 'put',
        'atocomplete' => 'off',
        'class' => 'px-5 mx-5',
    ]) !!}
    @include('admin.ads.partials.form')
    <div class="flex items-center justify-center mt-4 my-3">
        <x-jet-danger-button>
            <a href="{{ route('admin.anuncios.index') }}">{{ __('Cancelar') }}</a>
        </x-jet-danger-button>
        <x-jet-button class="ml-4">
            {{ __('Editar') }}
        </x-jet-button>
    </div>
    {!! Form::close() !!}
</x-app-layout>
