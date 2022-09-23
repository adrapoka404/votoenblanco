<x-app-layout>
    <div class="py-8 px-5">
            <x-info />
            {!! Form::open(['route' => 'admin.configuraciones.store', 'atocomplete'=>'off', 'files' => true]) !!}
            @foreach ($configs as $config)
            <div class=" flex col-span-6 sm:col-span-4 mt-3">
                <div class="flex-1">
            <label for="" class="capitalize">{{$config->name}}</label>
        </div>
            <div class="flex-1">
            @if($config->tag == 'iframe_revista')
                {!! Form::textarea($config->tag , $config->value, ["class"=>""]) !!}
            @else
                {!! Form::text($config->tag , $config->value, ["class"=>""]) !!}
            @endif
        </div>
            </div>
            @endforeach
            <div class="flex items-center justify-center mt-4">
                <x-jet-danger-button>
                    <a href="{{ route('dashboard') }}">{{ __('Tablero') }}</a>
                </x-jet-danger-button>
                <x-jet-button class="ml-4">
                    {{ __('Editar') }}
                </x-jet-button>
            </div>
            {!! Form::close() !!}
            <x-jet-validation-errors />
    </div>
</x-app-layout>
