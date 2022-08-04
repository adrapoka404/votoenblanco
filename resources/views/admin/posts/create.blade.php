<x-app-layout>
    <div class="py-12">
        <div class="w-full">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-info />
                {!! Form::open(['route' => 'admin.notas.store', 'atocomplete'=>'off', 'files' => true, 'class'=> 'px-5 mx-5']) !!}
                @include('admin.posts.partials.form')
                <div class="flex items-center justify-center mt-4 my-3">
                    <x-jet-danger-button>
                        <a href="{{ route('admin.notas.index') }}">{{ __('Cancelar') }}</a>
                    </x-jet-danger-button>
                    <x-jet-danger-button>
                        <a href="{{ route('admin.notas.show', 0) }}" target="_blank">{{ __('Vista previa') }}</a>
                    </x-jet-danger-button>
                    <x-jet-button class="ml-4">
                        {{ __('Crear') }}
                    </x-jet-button>
                </div>
                {!! Form::close() !!}
                
            </div>
        </div>
    </div>
</x-app-layout>
