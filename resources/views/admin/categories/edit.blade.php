<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {!! Form::model($category, ['route' => ['admin.categorias.update', $category], 'method'=> 'put','files' => true,'atocomplete'=>'off']) !!}
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
            </div>
        </div>
    </div>
</x-app-layout>
