<div class="py-8 px-5">
    <div class="w-full text-right">
        <a href="{{ route('sudo.permissions.create') }}" class="bg-file text-white bg-black rounded-full m-2 py-1 px-2 inlin">
            Crear nuevo Permiso
        </a>
    </div>
    @if ($permissions->count() == 0)
        <div class="w-full ">
            No hay registros actualmente
        </div>
    @else
        <x-info />
        <x-table>
            <x-slot name="header">
                <tr>
                    @foreach ($headers as $item)
                        <th
                            class=" capitalize border-x-2 border-b-2 border-wine bg-gray-dark text-white px-2 font-light py-2">
                            {{ $item }}
                        </th>
                    @endforeach
                </tr>
            </x-slot>
            <x-slot name="tbody">
                @foreach ($permissions as $permission)
                    <tr>
                        <td class="border-x-2 border-wine mx-2 my-3 px-2 font-sans">
                            <x-link-table href="{{ route('sudo.permissions.edit', $permission->id) }}" txt="{{ $permission->name }}" />
                        </td>
                        
                        <td class="border-x-2 border-wine mx-2 my-3 px-2 font-sans">
                            @can('sudo.permissions.edit')
                            @endcan
                            @can('sudo.permissions.destroy')
                            @endcan
                            <form action="" class="inline">
                                <a href="{{ route('sudo.permissions.update', $permission->id) }}"
                                    class=" bg-file text-white bg-gray-dark rounded-full m-2 py-1 px-2 inline">{{ __('Actualizar') }}</a>
                            </form>
                            <a href="{{ route('sudo.permissions.edit', $permission->id) }}"
                                class=" bg-file text-white bg-gray-dark rounded-full m-2 py-1 px-2 inline">{{ __('Editar') }}</a>



                        </td>
                    </tr>
                @endforeach
                <tfoot>
                    <tr>
                        <td colspan="3">{{ $permissions->links() }}</td>
                    </tr>
                </tfoot>
            </x-slot>
        </x-table>
    @endif
</div>
