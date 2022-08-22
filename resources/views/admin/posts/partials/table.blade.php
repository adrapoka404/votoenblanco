<div class="py-8 px-5">
    <div class="w-full text-right">
        <a href="{{ route('admin.notas.create') }}" class="bg-file text-white bg-black rounded-full m-2 py-1 px-2 inlin">
            Crear nuevo post
        </a>
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
                            @can('admin.notas.edit')
                            @endcan
                            <x-link-table href="{{ route('admin.notas.edit', $post->id) }}" txt="{{ $post->title }}" />
                            
                        </td>
                        <td class="border-x-2 border-wine mx-2 my-3 px-2 font-sans">
                            
                                {{ $post->user->name }}
                        </td>
                        <td class="border-x-2 border-wine mx-2 my-3 px-2 font-sans">
                            <select name="post[{{ $post->id }}][status]" id="">
                                @foreach ($statuses as $status)
                                    @if ($status->id == $post->status->id)
                                        <option value="{{ $status->id }}" selected>{{ $status->name }}</option>
                                    @else
                                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </td>
                        <td class="border-x-2 border-wine mx-2 my-3 px-2 font-sans">

                            @can('admin.notas.destroy')
                            @endcan
                            <form action="" class="inline">
                                <a href="{{ route('admin.notas.update', $post->id) }}"
                                    class=" bg-file text-white bg-gray-dark rounded-full m-2 py-1 px-2 inline">{{ __('Actualizar') }}</a>
                            </form>
                            @can('admin.notas.edit')
                            @endcan
                            <a href="{{ route('admin.notas.edit', $post->id) }}"
                                    class=" bg-file text-white bg-gray-dark rounded-full m-2 py-1 px-2 inline">
                                    {{ __('Editar') }}
                                </a>
                            
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
