<x-app-layout>
    <x-info />
    {!! Form::model($user, [
        'route' => ['sudo.asign.permissions.update', $user],
        'method' => 'put',
        'atocomplete' => 'off',
        'class' => 'px-5 mx-5',
    ]) !!}
    <div class="w-full">
        {!! Form::hidden('user_id', $user->id, []) !!}
        Permisos para: {{$user->name}}
        {!! Form::checkbox('checkall', '', false, ["id"=>"selectAll"]) !!}
        {!! Form::label('selectAll', 'Seleccionar todo', ['class'=> 'px-2 py-1 cursor-pointer']) !!}
    </div>
    <x-jet-validation-errors />
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
        @foreach ($roles as $role)
            <div class="hover:bg-gray-100 mx-2 my-1 px-2 py-1">
                <label class="cursor-pointer">
                {!! Form::checkbox('roles[]', $role->id, null, ["class"=>"items-center thecheck", "id" => "role".$role->id]) !!}
                {{$role->name}}
                </label>
            
        </div>
        @endforeach
    </div>
    <div class="flex items-center justify-center mt-4 my-3">
        <x-jet-danger-button>
            <a href="{{ route('sudo.asign.permissions.index') }}">{{ __('Cancelar') }}</a>
        </x-jet-danger-button>
        <x-jet-button class="ml-4">
            {{ __('Asignar Roles') }}
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
