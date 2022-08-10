<div class="pb-3">
    {!! Form::label('name', __('Nombre'), ['class' => 'text-2xl font-semibold text-black mb-3']) !!}
    {!! Form::text('name', old('name') ? old('name') : (isset($role) ? $role->name : ''), [
        'class' => 'border-1 border-wine focus:border-wine focus:ring-wine rounded-md my-3 w-2/3 block',
        'placeholder' => __('Administrador'),
        'autofocus',
    ]) !!}
    @error('name')
        <x-has-error>{{ $message }}</x-has-error>
    @enderror
</div>
<div class="w-full">
    Permisos para el Role
    {!! Form::checkbox('checkall', '', false, ["id"=>"selectAll"]) !!}
    {!! Form::label('selectAll', 'Seleccionar todo', ['class'=> 'px-2 py-1 cursor-pointer']) !!}
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
    @foreach ($permissions as $permission)
        <div class="hover:bg-gray-100 mx-2 my-1 px-2 py-1">
            <label>
                {!! Form::checkbox('permissions[]', $permission->id, null, ["class"=>"items-center thecheck", "id" => "permission".$permission->id]) !!}
                {{$permission->name}}    
            </label>
        </div>
    @endforeach
</div>

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