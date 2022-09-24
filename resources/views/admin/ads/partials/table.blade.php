<div class="py-8 px-5">
    <div class="w-full text-right">
        @can('admin.anuncios.create')
            <a href="{{ route('admin.anuncios.create') }}"
                class="bg-file text-white bg-black rounded-full m-2 py-1 px-2 inlin">
                Crear nuevo anuncio
            </a>
        @endcan
    </div>
    <div class="w-full flex my-5">
        <div class="flex-1">
            <input type="text" value="{{ $filter_name }}" name="filter_name" id="filter_name"
                placeholder="Filtrar nombre">
        </div>
        <div class="flex-1">
            <input type="text" value="{{ $filter_start }}" name="filter_start" id="filter_start"
                placeholder="Inicia">
        </div>
        <div class="flex-1">
            <input type="text" value="{{ $filter_end }}" name="filter_end" id="filter_end" placeholder="Termina">
        </div>
        <div class="flex-1">
            <select name="filter_status" id="filter_status">
                <option value="">Filtrar por estado</option>
                @if ($filter_status == 1)
                    <option value="1" selected>Activo</option>
                    <option value="0">Deshabilitado</option>
                @else
                    <option value="1" selected>Activo</option>
                    <option value="0">Deshabilitado</option>
                @endif
            </select>
        </div>
        <div class="flex-1">
            <div>
                <label class=" bg-file text-white bg-green rounded-full m-2 py-1 px-2 inline cursor-pointer w-full"
                id='btnFilter'>Filtrar</label>
            </div>
            <div>
            <label class=" bg-file text-white bg-orange rounded-full m-2 py-1 px-2 inline cursor-pointer w-full"
                id='btnClearFilter'>Limpiar filtros</label>
            </div>
        </div>
    </div>
    @if ($ads->count() == 0)
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
                @foreach ($ads as $ad)
                    <tr>
                        <td class="border-x-2 border-wine mx-2 my-3 px-2 font-sans">
                            {{ $ad->name }}
                        </td>
                        <td class="border-x-2 border-wine mx-2 my-3 px-2 font-sans">

                            @if( $ad->status == 1 )
                            Activo
                            @else
                            Deshabilitado
                            @endif
                        </td>
                        <td class="border-x-2 border-wine mx-2 my-3 px-2 font-sans">
                            {{$ad->start}}
                        </td>
                        <td class="border-x-2 border-wine mx-2 my-3 px-2 font-sans">
                            {{$ad->end}}
                        </td>
                        <td class="border-x-2 border-wine mx-2 my-3 px-2 font-sans">

                            @can('admin.anuncios.destroy')
                                <!--form action="" class="inline">
                                                <a href="{{ route('admin.anuncios.update', $ad->id) }}"
                                                    class=" bg-file text-white bg-gray-dark rounded-full m-2 py-1 px-2 inline">{{ __('Eiminar') }}</a>
                                            </form-->
                            @endcan
                            @can('admin.anuncios.edit')
                                <a href="{{ route('admin.anuncios.edit', $ad->id) }}"
                                    class=" bg-file text-white bg-gray-dark rounded-full m-2 py-1 px-2 inline">
                                    {{ __('Editar') }}
                                </a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                <tfoot>
                    <tr>
                        <td colspan="3">{{ $ads->links() }}</td>
                    </tr>
                </tfoot>
            </x-slot>
        </x-table>
    @endif
</div>
@section('jqueryui')
    <script>
        var base = "{{ route('admin.anuncios.index') }}";
        $(document).ready(function() {
            $("#btnClearFilter").on('click', function() {
                $(location).prop('href', base)
            })
            $("#btnFilter").on('click', function() {
                url = "";
                filter_name     = $("#filter_name")
                filter_start    = $("#filter_start")
                filter_end      = $("#filter_end")
                filter_status   = $("#filter_status")

                if (filter_name.val() != '') {
                    if (url == '')
                        url += '?'
                    url += 'filter_name=' + filter_name.val()
                }

                if (filter_start.val() != '') {
                    if (url == '')
                        url += '?'
                    else
                        url += '&'
                    url += 'filter_start=' + filter_start.val()
                }

                if (filter_end.val() != '') {
                    if (url == '')
                        url += '?'
                    else
                        url += '&'
                    url += 'filter_end=' + filter_end.val()
                }

                if (filter_status.val() != '') {
                    if (url == '')
                        url += '?'
                    else
                        url += '&'
                    url += 'filter_status=' + filter_status.val()
                }

                $(location).prop('href', base + url)

            })
        })
    </script>
@endsection
