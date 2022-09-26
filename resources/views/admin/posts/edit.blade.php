<x-app-layout>
    <x-info />
    {!! Form::model($post, [
        'route' => ['admin.notas.update', $post],
        'method' => 'put',
        'atocomplete' => 'off',
        'files' => true,
        'class' => 'px-5 mx-5',
    ]) !!}
    @include('admin.posts.partials.form')
    <div class="flex items-center justify-center mt-4 my-3">
        <x-jet-danger-button>
            <a href="{{ route('admin.notas.index') }}">{{ __('Cancelar') }}</a>
        </x-jet-danger-button>
        <x-jet-danger-button class="hidden">
            <a href="{{ route('admin.notas.show', 0) }}" target="_blank">{{ __('Vista previa') }}</a>
        </x-jet-danger-button>
        <x-jet-button class="ml-4">
            {{ __('Editar') }}
        </x-jet-button>
    </div>
    {!! Form::close() !!}
</x-app-layout>
