<x-app-layout>
    <x-info />
    {!! Form::open([
        'route' => 'sudo.asign.permissions.store',
        'atocomplete' => 'off',
        'class' => 'px-5 mx-5',
    ]) !!}
    <div class="w-full">
        {!! Form::hidden('role_id', $role->id, []) !!}
        Permisos para: {{$role->name}}
        {!! Form::checkbox('checkall', '', false, ["id"=>"selectAll"]) !!}
        {!! Form::label('selectAll', 'Seleccionar todo', ['class'=> 'px-2 py-1 cursor-pointer']) !!}
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
        @foreach ($permissions as $permission)
            <div class="hover:bg-gray-100 mx-2 my-1 px-2 py-1">
                {!! Form::checkbox('permissions['.$permission->id.']', $permission->id, false, ["class"=>"items-center thecheck", "id" => "permission".$permission->id]) !!}
                {!! Form::label('permission'.$permission->id, $permission->name, ["class" => "cursor-pointer"]) !!}
            
        </div>
        @endforeach
    </div>
    <div class="flex items-center justify-center mt-4 my-3">
        <x-jet-danger-button>
            <a href="{{ route('sudo.roles.index') }}">{{ __('Roles') }}</a>
        </x-jet-danger-button>
        <x-jet-button class="ml-4">
            {{ __('Asignar Permisos') }}
        </x-jet-button>
    </div>
    {!! Form::close() !!}
    @section('jqueryui')
        <script>
            $.selectAll = $("#selectAll")
            $(document).ready(function(){
                $("#selectAll").on('change', function(){
                    //console.log($(this).is(':checked'));
                    $(".thecheck").prop('checked', $(this).is(':checked'))
                })
            })
        </script>
    @endsection
</x-app-layout>
