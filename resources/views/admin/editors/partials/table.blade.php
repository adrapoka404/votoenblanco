<div class=" py-8 px-5">
    <div class="w-full text-right">
        @can('admin.editors.create')
        @endcan
        <a href="{{ route('admin.editors.create') }}"
            class="bg-file text-white bg-black rounded-full m-2 py-1 px-2 inlin">
            Crear nuevo editor
        </a>
        
    </div>
    @if ($editors->count() == 0)
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
                @foreach ($editors as $editor)
                    <tr>
                        <td class="border-x-2 border-wine mx-2 my-3 px-2 font-sans">{{ $editor->user->name }}</td>
                        <td class="border-x-2 border-wine mx-2 my-3 px-2 font-sans">{{ $editor->user->email }}</td>
                        <td class="border-x-2 border-wine mx-2 my-3 px-2 font-sans">
                            @if ($editor->status == 0)
                                {{ __('Desactivado') }}
                            @else
                                {{ __('Activado') }}
                            @endif
                        </td>
                        <td class="border-x-2 border-wine mx-2 my-3 px-2 font-sans">{{ $editor->specialty }}</td>
                        <td class="border-x-2 border-wine mx-2 my-3 px-2 font-sans">
                            
                            @can('admin.editors.edit')
                            @endcan
                            <a href="{{ route('admin.editors.edit', $editor) }}"
                                class=" bg-file text-white bg-gray-dark rounded-full m-2 py-1 px-2 inline">
                                {{ __('Editar') }}
                            </a>
                            @if ($editor->status == 0)
                                <form action="{{ route('admin.editors.show', $editor) }}"
                                    class="w-full max-w-sm inline">
                                    @csrf
                                    <input type="submit" value="{{ __('Habilitar') }}"
                                        class=" bg-wine text-white rounded-full m-2 py-1 px-2 cursor-pointer">
                                </form>
                            @else
                                @can('admin.editors.destroy')
                                <form action="{{ route('admin.editors.destroy', $editor) }}" method="POST"
                                    class="w-full max-w-sm inline">
                                    @csrf
                                    @method('delete')

                                    <input type="submit" value="{{ __('Deshabilitar') }}"
                                        class=" bg-wine text-white rounded-full m-2 py-1 px-2 cursor-pointer">
                                </form>
                                @endcan
                            @endif


                        </td>
                    </tr>
                @endforeach
                <tfoot>
                    <tr>
                        <td colspan="3">{{ $editors->links() }}</td>
                    </tr>
                </tfoot>
            </x-slot>
        </x-table>
    @endif
</div>
