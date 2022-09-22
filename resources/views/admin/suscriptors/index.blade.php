<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
        <x-info />
        <div class="w-full">
            <div class="mb-5 text-lg">¡Bienvenido {{$suscriptor->name}}!</div>
            <div class="text-lg pb-14 ">
                En este tablero de control podrás realizar cambios a tu perfil, organizar tus preferencias, cambiar tu contraseña y volver a ver tus notas guardadas
            </div>
            <x-row-suscriptor>
                <x-slot name="icono" >{{asset('img/miperfil.png')}}</x-slot>
                <x-slot name="to">{{route('profile.show')}}</x-slot>
                <x-slot name="label">mi perfil</x-slot>
            </x-row-suscriptor>
            <x-row-suscriptor>
                <x-slot name="icono" >{{asset('img/guardadas.png')}}</x-slot>
                <x-slot name="to">{{route('admin.suscriptores.guardadas')}}</x-slot>
                <x-slot name="label">notas guardadas</x-slot>
            </x-row-suscriptor>
            <x-row-suscriptor>
                <x-slot name="icono" >{{asset('img/config.png')}}</x-slot>
                <x-slot name="to">{{route('admin.suscriptores.config')}}</x-slot>
                <x-slot name="label">configuración</x-slot>
            </x-row-suscriptor>
            <div class="w-full flex my-5 py-10">
                <div class="inline w-1/2 text-center" >
                    <a href="" class="text-white bg-black rounded-full mx-5 px-5 py-2 capitalize">pagina principal</a>
                </div>
                <div class="inline w-1/2 text-center">
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        {!! Form::submit('Cerrar sesión', [
                            'class' =>
                                'text-white bg-black rounded-full mx-5 px-5 py-2 capitalize cursor-pointer',
                        ]) !!}
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
