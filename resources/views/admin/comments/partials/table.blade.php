<div class="py-8 px-5">
    <div class="w-full text-right border-1 border-gray-dark">
        <div class="flex flex-row">
            <div class="flex-1 text-center">
                <select name="post_id" id="post_id">
                    <option value="">Filtrar por nota</option>
                    @foreach ($posts as $post)
                        @if ($post->id == $post_id)
                            <option value="{{ $post->id }}" selected>{{ $post->title }}</option>
                        @else
                            <option value="{{ $post->id }}">{{ $post->title }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="flex-1 text-center">
                <select name="user_id" id="user_id">
                    <option value="">Filtrar por usuario</option>
                    @foreach ($users as $user)
                        @if ($user['id'] == $user_id)
                            <option value="{{ $user['id'] }}" selected>{{ $user['name'] }}</option>
                        @else
                            <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="flex-1 text-center">
                <select name="status" id="status">
                    <option value="">Filtrar por estado</option>
                    <option value="0" @if ($status == 0) selected @endif>Ocultos</option>
                    <option value="1" @if ($status == 1) selected @endif>Autorizados</option>
                </select>
            </div>
            <div class="flex-1 text-center">
                <label class=" bg-file text-white bg-green rounded-full m-2 py-1 px-2 inline cursor-pointer w-full"
                    id='btnFilter'>Filtrar</label>
                    <label class=" bg-file text-white bg-orange rounded-full m-2 py-1 px-2 inline cursor-pointer w-full"
                    id='btnClearFilter'>Limpiar filtros</label>
            </div>
        </div>
    </div>
    @if ($comments->count() == 0)
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
                @foreach ($comments as $comment)
                    <tr class="border-b-2 border-b-gray-dark">
                        <td class="border-x-2 border-wine mx-2 my-3 px-2 font-sans text-xs">
                            <a href="{{ route('notas.show', $comment->post->slug) }}" target="_blank"
                                class=" text-blue cursor-pointer">
                                {{ $comment->post->title }}
                            </a>
                        </td>
                        <td class="border-x-2 border-wine mx-2 my-3 px-2 font-sans text-sm">

                            {{ $comment->name }}
                        </td>
                        <td class="border-x-2 border-wine mx-2 my-3 px-2 font-sans text-sm  ">

                            {{ $comment->comment }}
                        </td>
                        <td class="border-x-2 border-wine mx-2 my-3 px-2 font-sans text-xs">
                            {{ $comment->created_at }}
                        </td>
                        <td class="border-x-2 border-wine mx-2 my-3 px-2 font-sans">
                            @can('admin.comentarios.edit')
                                @if ($comment->status == 0)
                                    <a href="{{ route('admin.comentarios.edit', $comment->id) }}"
                                        class=" bg-file text-white bg-green rounded-full m-2 py-1 px-2 inline cursor-pointer">
                                        {{ __('Autorizar') }}
                                    </a>
                                @else
                                    <a href="{{ route('admin.comentarios.edit', $comment->id) }}"
                                        class=" bg-file text-white bg-wine rounded-full m-2 py-1 px-2 inline cursor-pointer">
                                        {{ __('Ocultar') }}
                                    </a>
                                @endif
                            @endcan
                        </td>
                    </tr>
                @endforeach
                <tfoot>
                    <tr>
                        <td colspan="3">{{ $comments->links() }}</td>
                    </tr>
                </tfoot>
            </x-slot>
        </x-table>
    @endif
</div>
@section('jqueryui')
    <script>
        var base = "{{ route('admin.comentarios.index') }}";
        $(document).ready(function() {
            $("#btnClearFilter").on('click', function(){
                $(location).prop('href', base)
            })
            $("#btnFilter").on('click', function() {
                url = "";
                post_id = $("#post_id")
                user_id = $("#user_id")
                estado = $("#status")

                if (post_id.val() != '') {
                    if (url == '')
                        url += '?'
                    url += 'post_id=' + post_id.val()
                }

                if (user_id.val() != '') {
                    if (url == '')
                        url += '?'
                    else
                        url += '&'
                    url += 'user_id=' + user_id.val()
                }

                if (estado.val() != '') {
                    if (url == '')
                        url += '?'
                    else
                        url += '&'
                    url += 'status=' + estado.val()
                }

                $(location).prop('href', base + url)
                
            })
        })
    </script>
@endsection
