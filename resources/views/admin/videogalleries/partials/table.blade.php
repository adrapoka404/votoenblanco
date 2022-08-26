<div class=" py-8 px-5">
    <div class="w-full text-right">
        @can('admin.videogalerias.create')
        <a href="{{ route('admin.videogalerias.create') }}"
            class="bg-file text-white bg-black rounded-full m-2 py-1 px-2 inlin">
            Crear videogaleria
        </a>
        @endcan
    </div>
    @if ($vgalerias->count() == 0)
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
                @foreach ($vgalerias as $vgaleria)
                    <tr>
                        <td class="border-x-2 border-wine mx-2 my-3 px-2 font-sans">{{ $vgaleria->name }}</td>
                        <td class="border-x-2 border-wine mx-2 my-3 px-2 font-sans">{!! $vgaleria->description !!}</td>
                        <td class="border-x-2 border-wine mx-2 my-3 px-2 font-sans">
                            
                            @can('admin.videogalerias.edit')
                            <a href="{{ route('admin.videogalerias.edit', $vgaleria) }}"
                                class=" bg-file text-white bg-gray-dark rounded-full m-2 py-1 px-2 inline">
                                {{ __('Editar') }}
                            </a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                <tfoot>
                    <tr>
                        <td colspan="3">{{ $vgalerias->links() }}</td>
                    </tr>
                </tfoot>
            </x-slot>
        </x-table>
    @endif
</div>
