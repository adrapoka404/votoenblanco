<div class="w-full ">
    <a href="{{ route('admin.notas.estatus.create') }}" class="bg-file text-white bg-blue rounded-full m-2 py-1 px-2 inlin">Crear nuevo estatus</a>
</div>
@if ($statuses->count() == 0)
    <div class="w-full ">
       No hay registros  actualmente
    </div>
@else
<x-table>
    <x-slot name="header">
        <tr>
            @foreach ($lists as $item)
                <th>{{$item}}</th>
            @endforeach
        </tr>
    </x-slot>
    <x-slot name="tbody">
        @foreach ($statuses as $status)
        <tr>
            <td>{{$status->name}}</td>
            <td>
                @if ($status->status == 0 )
                    {{__('Desactivado')}}
                @else
                    {{__('Activado')}}
                @endif
            </td>
            <td>
                 @can('admin.notas.estatus.edit')
                 @endcan
                 @can('admin.notas.estatus.destroy')
                 @endcan
                            <a href="{{ route('admin.notas.estatus.edit', $status) }}"
                                class=" bg-file text-white bg-blue rounded-full m-2 py-1 px-2 inline">{{ __('Editar') }}</a>
                        
                            <form action="{{ route('admin.notas.estatus.destroy', $status) }}" method="POST"
                                class="w-full max-w-sm inline">
                                @csrf
                                @method('delete')

                                <input type="submit" value="{{ __('Quitar') }}"
                                    class=" bg-red-300 text-white rounded-full m-2 py-1 px-2">
                            </form>
                        
            </td>
        </tr>    
        @endforeach
    </x-slot>
</x-table>
@endif
