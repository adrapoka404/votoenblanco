<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
        <x-info />
        <div class="w-full">
            <div class="w-full flex py-10">
                <div class="inline w-1/3">
                    <div class="w-28 h-28 bg-no-repeat bg-contain text-center mx-auto"
                        style="background-image: url({{ asset('img/guardadas.png') }})"></div>
                </div>
                <div class="inline w-2/3">
                    <div class="border-b-4 border-b-wine text-4xl px-5 py-8 capitalize"> notas guardadas</div>
                    <div class="text-xl ">Aquí podrás ver tus notas y videos que has guardado</div>
                </div>

            </div>
            @if ($saveds->count() > 0)
                @foreach ($saveds as $saved)
                    <div class="w-full flex py-10">
                        <div class="inline w-1/3">
                            <div class="w-full h-full bg-no-repeat bg-contain text-center mx-auto"
                                style="background-image: url({{ asset('storage/' . $saved->post->image_principal) }})">
                            </div>
                        </div>
                        <div class="inline w-2/3  px-5 ">
                            <div class="text-wine text-xl font-semibold">
                                <a href="{{ route('notas.show', $saved->post->slug) }}" target="_blank">
                                    {{ $saved->post->title }}
                                </a>
                            </div>
                            <div class="text-black capitalize">sección</div>
                            <div class="text-black capitalize">guardada el {{ $saved->created_at }}</div>
                            <div class="flex my-2">
                                <div class="w-1/2 text-center">
                                    <form action="{{ route('admin.suscriptores.destroy', $saved->id) }}" method="POST"
                                        class="w-full max-w-sm inline" id='form{{ $saved->id }}'>
                                        @csrf
                                        @method('delete')
                                        <input type="submit" class="hidden" id="hiddenSubmit{{ $saved->id }}">
                                        <div class="bg-contain bg-no-repeat h-12 cursor-pointer"
                                            style="background-image: url({{ asset('img/desguardar.png') }})"
                                            onclick="btn_submit({{ $saved->id }})"></div>
                                    </form>
                                </div>
                                <div class="w-1/2 text-center h-12 bg-contain bg-no-repeat cursor-pointer"
                                    style="background-image: url({{ asset('img/compartir.png') }})"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{$saveds->links()}}
            @else
                <div class=" text-lg font-semibold">Aun no tienes notas guardadas, ve al <a href="/" class=" text-blue cursor-pointer font-light" >sitio</a></div>
            @endif
            <div class="w-full flex my-5 py-10">
                <div class="inline w-1/2 text-center">
                    <a href="{{ route('admin.suscriptores.index') }}"
                        class="text-white bg-black rounded-full mx-5 px-5 py-2 capitalize">
                        regresar al menú
                    </a>
                </div>
                <div class="inline w-1/2 text-center">
                    <a href="/" class="text-white bg-black rounded-full mx-5 px-5 py-2 capitalize">
                        página principal
                    </a>
                </div>
            </div>
        </div>
    </div>
    @section('jqueryui')
        <script>
            $(document).ready(function() {
                $("#labelSubmit").on('click', function() {
                    $("#hiddenSubmit").click()
                })
            })

            function btn_submit(id) {
                console.log('El id: ' + id);
                $("#form" + id).submit()
            }
        </script>
    @endsection
</x-app-layout>
