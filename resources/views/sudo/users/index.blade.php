<x-app-layout>
    <div class="py-8 px-5">
        <div class="w-full text-right">
            <a href="{{ route('sudo.roles.index') }}" class="bg-file text-white bg-black rounded-full m-2 py-1 px-2 inlin">
                Roles
            </a>
            <a href="{{ route('sudo.permissions.index') }}" class="bg-file text-white bg-black rounded-full m-2 py-1 px-2 inlin">
                Permisos
            </a>
        </div>
        @if ($users->count() == 0)
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
                    @foreach ($users as $user)
                        <tr>
                            <td class="border-x-2 border-wine mx-2 my-3 px-2 font-sans">
                                <x-link-table href="{{ route('sudo.roles.edit', $user->id) }}" txt="{{ $user->name }}" />
                            </td>
                            <td class="border-x-2 border-wine mx-2 my-3 px-2 font-sans">
                                <x-link-table href="{{ route('sudo.roles.edit', $user->id) }}" txt="{{ $user->email }}" />
                            </td>
                            <td class="border-x-2 border-wine mx-2 my-3 px-2 font-sans">
                                @foreach ($user->roles as $role)
                                    {{$role->name}}
                                @endforeach
                            </td>                            
                            <td class="border-x-2 border-wine mx-2 my-3 px-2 font-sans">
                                @can('sudo.asign.permissions.index')
                                <a href="{{ route('sudo.asign.permissions.edit', $user->id) }}"
                                    class=" bg-file text-white bg-gray-dark rounded-full m-2 py-1 px-2 inline">
                                    {{ __('Roles') }}
                                </a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    <tfoot>
                        <tr>
                            <td colspan="3">{{ $users->links() }}</td>
                        </tr>
                    </tfoot>
                </x-slot>
            </x-table>
        @endif
    </div>
    
</x-app-layout>
