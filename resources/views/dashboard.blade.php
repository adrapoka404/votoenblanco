<x-app-layout>
    @if(empty(Auth::user()->roles()->get()))
    <div class=" bg-red-300 text-lg font-extralight">Sin Rol</div>    
    @endif
    <x-jet-welcome />
</x-app-layout>
