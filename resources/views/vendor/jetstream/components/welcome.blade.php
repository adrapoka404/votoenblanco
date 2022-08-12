<div class="p-6 sm:px-20 bg-white ">
    <div>
        <x-jet-application-logo class="block h-12 w-auto" />
    </div>

    <div class="mt-8 text-2xl">
        {{__('Bienvenido ') . auth()->user()->name}}!
    </div>

    <div class="mt-6 text-gray-500">
        {{__('En este tablero de control podrás crear notas, revisar post anteriores y editarlos. Además de ver las estadísticas de la página y validar o editar las notas de los redactores.')}}
    </div>
</div>

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
    @can('admin.notas.create')
    @endcan
    <div class="p-6">
        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                <a href="{{route('admin.notas.create')}}" class="flex text-center text-4xl items-center">
                    <img src="{{asset('img/crear_nota.png')}}" alt="{{__('Crear nota')}}"  class=" w-24">
                    {{__('Crear nota')}}
                </a>
            </div>
        </div>
    </div>
    
    @can('admin.notas.index')
    @endcan
    <div class="p-6 border-2 border-wine border-t-0  border-r-0 ">
        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                <a href="{{ route('admin.notas.index') }}" class="flex text-center text-4xl items-center">
                    <img src="{{asset('img/aprobar_notas.png')}}" alt="{{__('Crear nota')}}"  class=" w-24">
                    {{__('Validar y/o Editar Notas')}}
                </a>
            </div>
        </div>
    </div>
    

    <div class="p-6 border-2 border-b-0 border-l-0 border-wine ">

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                <a href="#" class="flex text-center text-4xl items-center">
                    <img src="{{asset('img/ver_estadisticas.png')}}" alt="{{__('Crear nota')}}"  class=" w-24">
                    {{__('Estadísticas')}}
                </a>
            </div>
        </div>
    </div>
    @can('admin.editors.create')
    @endcan
    <div class="p-6 ">
        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                <a href="{{route('admin.editors.create')}}" class="flex text-center text-4xl items-center">
                    <img src="{{asset('img/nuevo_perfil.png')}}" alt="{{__('Crear nota')}}"  class=" w-24">
                    {{__('Crear nuevo perfil de redactor')}}
                </a>
            </div>
        </div>
    </div>
    
    @can('admin.editors.index')
    @endcan
    <div class="p-6 ">
        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                <a href="{{route('admin.editors.index')}}" class="flex text-center text-4xl items-center">
                    <img src="{{asset('img/panel_redactores.png')}}" alt="{{__('Crear nota')}}"  class=" w-24">
                    {{__('Panel de control de redactores')}}
                </a>
            </div>
        </div>
    </div>
    
</div>
