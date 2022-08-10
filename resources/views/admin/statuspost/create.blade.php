<x-app-layout>
                {!! Form::open(['route' => 'admin.notas.estatus.store']) !!}
                @include('admin.statuspost.partials.form')
                <div class="flex items-center justify-center mt-4">
                    <x-jet-danger-button>
                        <a href="{{ route('admin.notas.estatus.index') }}">{{ __('Cancelar') }}</a>
                    </x-jet-danger-button>
                    <x-jet-button class="ml-4">
                        {{ __('Crear') }}
                    </x-jet-button>
                </div>
                {!! Form::close() !!}
                <x-jet-validation-errors />
</x-app-layout>
