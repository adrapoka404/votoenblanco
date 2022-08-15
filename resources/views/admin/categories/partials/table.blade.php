<div class="py-8 px-5">
    <div class="w-full text-right">
        <a href="{{ route('admin.categorias.create') }}"
            class="bg-file text-white bg-black rounded-full m-2 py-1 px-2 inlin">Crear nueva categoría</a>
            <x-info />
    </div>
    @if ($categories->count() == 0)
        <div class="w-full ">
            No hay registros actualmente
        </div>
    @else
        <x-table>
            <x-slot name="header">
                <tr>
                    @foreach ($headers as $item)
                        <th class=" capitalize border-x-2 border-b-2 border-wine bg-gray font-light py-2">
                            {{ $item }}</th>
                    @endforeach
                </tr>
            </x-slot>
            <x-slot name="tbody">
                @foreach ($categories as $category)
                    <tr>
                        <td class="border-x-2 border-wine mx-2 my-3 px-2 font-sans">{{ $category->nombre }}</td>
                        <td class="border-x-2 border-wine mx-2 my-3 px-2 font-sans">
                            @if ($category->visible == 0)
                                {{ __('Desactivado') }}
                            @else
                                {{ __('Activado') }}
                            @endif
                        </td>
                        <td class="border-x-2 border-wine mx-2 my-3 px-2 font-sans">
                            @can('admin.categorias.edit')
                            @endcan
                            @can('admin.categorias.destroy')
                            @endcan
                            <a href="{{ route('admin.categorias.edit', $category->id) }}"
                                class=" bg-file text-white bg-gray-dark rounded-full m-2 py-1 px-2 inline">{{ __('Editar') }}</a>

                            <form action="{{ route('admin.categorias.destroy', $category) }}" method="POST"
                                class="w-full max-w-sm inline">
                                @csrf
                                @method('delete')

                                <input type="submit" value="{{ __('Quitar') }}"
                                    class=" bg-wine text-white rounded-full m-2 py-1 px-2">
                            </form>

                        </td>
                    </tr>
                @endforeach
                <tfoot>
                    <tr>
                        <td colspan="3">{{ $categories->links() }}</td>
                    </tr>
                </tfoot>
            </x-slot>
        </x-table>
    @endif
</div>
