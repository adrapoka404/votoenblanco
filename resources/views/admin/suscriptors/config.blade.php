<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
        <x-info />
        <div class="w-full">
            <div class="w-full flex py-10">
                <div class="inline w-1/3">
                    <div class="w-28 h-28 bg-no-repeat bg-contain text-center mx-auto"
                        style="background-image: url({{ asset('img/config.png') }})"></div>
                </div>
                <div class="inline w-2/3">
                    <div class="border-b-4 border-b-wine text-4xl px-5 py-8 capitalize"> configuración</div>
                    <div class="text-xl ">Elige tus secciones favoritas para recibir notificaciones cuando tengamos
                        nuevas noticias</div>
                </div>
                
            </div>
            <form action="{{ route('admin.suscriptores.suscribeto', 'config') }}" method="POST"
                    class="w-full max-w-sm inline">
                    @csrf
            <div class="flex w-full">
                <div class="w-1/2">
                    <div class="bg-wine pl-10 font-semibold text-lg text-white py-2">Entrevistas</div>
                    @foreach ($entrevistas as $entrevista)
                        <div class="pl-10 my-5">
                            <label for="category{{ $entrevista->id }}" class="cursor-pointer">

                                {!! Form::checkbox('suscribeto[]', $entrevista->id, $entrevista->check, [
                                    'class' => '',
                                    'id' => 'category' . $entrevista->id,
                                ]) !!}
                                {{ $entrevista->nombre }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="w-1/2">
                    <div class="bg-wine pl-10 font-semibold text-lg text-white py-2">Reportajes</div>
                    @foreach ($reportajes as $reportaje)
                        <div class="pl-10 my-5">
                            <label for="category{{ $reportaje->id }}" class="cursor-pointer">
                                {!! Form::checkbox('suscribeto[]', $reportaje->id, $reportaje->check, [
                                    'class' => '',
                                    'id' => 'category' . $reportaje->id,
                                ]) !!}
                                {{ $reportaje->nombre }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="w-full">
                <div class="bg-wine pl-10 font-semibold text-lg text-white py-2">Noticias</div>
                <div class="grid grid-cols-2 pl-10 my-5">
                    @foreach ($noticias as $noticia)
                        <div class="w-1/2 my-5">
                            <label for="category{{ $noticia->id }}" class="cursor-pointer">
                                {!! Form::checkbox('suscribeto[]', $noticia->id, $noticia->check, [
                                    'class' => '',
                                    'id' => 'category' . $noticia->id,
                                ]) !!}
                                {{ $noticia->nombre }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="w-full flex my-5 py-10">
                <div class="inline w-1/3 text-center">
                    <a href="{{ route('admin.suscriptores.index') }}"
                        class="text-white bg-black rounded-full mx-5 px-5 py-2 capitalize">
                        regresar al menú
                    </a>
                </div>
                <div class="inline w-1/3 text-center">
                    <input type="submit"
                        class="text-white bg-black rounded-full mx-5 px-5 py-2 capitalize cursor-pointer"
                        value="actualizar perfil" />


                </div>
                <div class="inline w-1/3 text-center">
                    <a href="{{ route('logout') }}" class="text-white bg-black rounded-full mx-5 px-5 py-2 capitalize">
                        cerrar sesión
                    </a>
                </div>
            </div>
            </form>
        </div>
    </div>
</x-app-layout>
