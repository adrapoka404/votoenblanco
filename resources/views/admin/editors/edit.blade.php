<x-app-layout>
    {!! Form::model($editor, [
        'route' => ['admin.editors.update', $editor],
        'method' => 'put',
        'atocomplete' => 'off',
    ]) !!}
    @include('admin.editors.partials.form')
    <div class="flex items-center justify-center mt-4">
        <x-jet-danger-button>
            <a href="{{ route('admin.editors.index') }}">{{ __('Cancelar') }}</a>
        </x-jet-danger-button>
        <x-jet-button class="ml-4">
            {{ __('Editar') }}
        </x-jet-button>
    </div>
    {!! Form::close() !!}
</x-app-layout>
