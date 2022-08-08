<x-app-layout>
    {!! Form::model($category, [
        'route' => ['admin.categorias.update', $category],
        'method' => 'put',
        'files' => true,
        'atocomplete' => 'off',
    ]) !!}
    @include('admin.categories.partials.form')
    <div class="flex items-center justify-center mt-4">
        <x-jet-danger-button>
            <a href="{{ route('admin.categorias.index') }}">{{ __('Cancelar') }}</a>
        </x-jet-danger-button>
        <x-jet-button class="ml-4">
            {{ __('Editar') }}
        </x-jet-button>
    </div>
    {!! Form::close() !!}
    <x-jet-validation-errors />
</x-app-layout>
