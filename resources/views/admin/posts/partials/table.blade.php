<div class="py-8 px-5">
    <div class="w-full text-right">
        @can('admin.notas.create')
            <a href="{{ route('admin.notas.create') }}" class="bg-file text-white bg-black rounded-full m-2 py-1 px-2 inlin">
                Crear nuevo post
            </a>
        @endcan
    </div>
    <div class="w-full flex my-3">
        <div class="flex-1">
            <input type="text" value="{{ $filter_title }}" name="filter_title" id="filter_title"
                placeholder="Filtrar por contenido">
        </div>
        <div class="flex-1 text-center">
            @if($editor)
            <select name="filter_editor" id="filter_editor">
                <option value="">Filtrar por editor</option>
                @foreach ($editors as $editor)
                    @if ($filter_editor == $editor->id)
                        <option value="{{ $editor->id }}" selected>{{ $editor->name }}</option>
                    @else
                        <option value="{{ $editor->id }}">{{ $editor->name }}</option>
                    @endif
                @endforeach
            </select>
            @else
                {{Auth::user()->name}}
                <input type="hidden" value="{{ Auth::user()->id }}" name="filter_editor" id="filter_editor">
            @endif
        </div>
        <div class="flex-1">
            <select name="filter_status" id="filter_status">
                <option value="">Filtrar por estado</option>
                @foreach ($statuses as $status)
                    @if ($filter_status == $status->id)
                        <option value="{{ $status->id }}" selected>{{ $status->name }}</option>
                    @else
                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="flex-1">
            <label class=" bg-file text-white bg-green rounded-full m-2 py-1 px-2 inline cursor-pointer w-full"
                id='btnFilter'>Filtrar</label>
            <label class=" bg-file text-white bg-orange rounded-full m-2 py-1 px-2 inline cursor-pointer w-full"
                id='btnClearFilter'>Limpiar filtros</label>
        </div>
    </div>
    @if ($posts->count() == 0)
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
                @foreach ($posts as $post)
                    <tr>
                        <td class="border-x-2 border-wine mx-2 my-3 px-2 font-sans">
                            {{ $post->title }}
                        </td>
                        <td class="border-x-2 border-wine mx-2 my-3 px-2 font-sans">

                            {{ $post->user->name }}
                        </td>
                        <td class="border-x-2 border-wine mx-2 my-3 px-2 font-sans">
                            @if ($editor)
                                <select name="post[{{ $post->id }}][status]" id="" class="capitalize">
                                    @foreach ($statuses as $status)
                                        @if ($status->id == $post->status->id)
                                            <option value="{{ $status->id }}" selected>{{ $status->name }}</option>
                                        @else
                                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            @else
                                {{ $post->status->name }}
                            @endif

                        </td>
                        <td class="border-x-2 border-wine mx-2 my-3 px-2 font-sans">

                            @can('admin.notas.destroy')
                                <!--form action="" class="inline">
                                            <a href="{{ route('admin.notas.update', $post->id) }}"
                                                class=" bg-file text-white bg-gray-dark rounded-full m-2 py-1 px-2 inline">{{ __('Actualizar') }}</a>
                                        </form-->
                            @endcan
                            @can('admin.notas.edit')
                                <a href="{{ route('admin.notas.edit', $post->id) }}"
                                    class=" bg-file text-white bg-gray-dark rounded-full m-2 py-1 px-2 inline">
                                    {{ __('Editar') }}
                                </a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                <tfoot>
                    <tr>
                        <td colspan="3">{{ $posts->links() }}</td>
                    </tr>
                </tfoot>
            </x-slot>
        </x-table>
    @endif
</div>
@section('jqueryui')
    <script>
        var base = "{{ route('admin.notas.index') }}";
        $(document).ready(function() {
            $("#btnClearFilter").on('click', function() {
                $(location).prop('href', base)
            })
            $("#btnFilter").on('click', function() {
                url = "";
                filter_title = $("#filter_title")
                filter_editor = $("#filter_editor")
                filter_status = $("#filter_status")

                if (filter_title.val() != '') {
                    if (url == '')
                        url += '?'
                    url += 'filter_title=' + filter_title.val()
                }

                if (filter_editor.val() != '') {
                    if (url == '')
                        url += '?'
                    else
                        url += '&'
                    url += 'filter_editor=' + filter_editor.val()
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
