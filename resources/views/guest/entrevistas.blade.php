<x-guest-layout>
    <x-liston>{{ __('entrevistas') }}</x-liston>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-3 gap-4">

        <div class="col-span-3">
            <div class=" grid grid-cols-2">
                <div class="mx-auto">
                    <a href="{{ route('web.entrevistas') }}">
                        <img class=" w-86 h-52 object-cover object-center mb-4 " src="{{ asset('img/conociendoa.png') }}"
                            alt="Image Size 720x400" />
                    </a>
                </div>
                <div class="text-left mt-10">
                    <div class="ml-5 my-auto">
                        <div class="text-red-800 font-semibold">Descripción</div>
                        <div>
                            Sección de entrevistas dedicada a servidores públicos o empresarios destacados, que sean
                            conocidos a nivel local, estatal, nacional o internacional y tengan presencia en redes
                            sociales.

                            En esta sección se debe destacar a él/ella como ser humano, así como sus logros y el camino
                            que ha recorrido para conseguirlos.

                        </div>
                        <div>
                            <div class="text-red-800 font-semibold">Formato de video</div>
                            <div>
                                Entrevista en formato de vlog o a dos personas
                            </div>
                        </div>
                        <div>
                            <a href="{{ route('web.entrevistas') }}"
                                class="bg-red-800 px-10 text-white rounded-lg font-semibold">Ver más</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div></div>
        <div></div>
        <div class=" col-span-3">
            <div class=" grid grid-cols-2">
                <div class="text-left mt-10">
                    <div class="ml-5 my-auto">
                        <div class="text-red-800 font-semibold">Descripción</div>
                        <div>
                            Sección de entrevistas o reportaje dedicada a hombre y mujeres jóvenes que tengan un
                            proyecto innovador de índole científico, tecnológico, social, cultural, económico o afín.

                            En esta sección se busca destacar el proyecto, cómo surgió la idea, cómo ha ido creciendo,
                            cuáles son los logros y proyecciones.

                            La historia del proyecto también incluye a sus creadores, por lo que también se debe hablar
                            de ellos, pero dando más peso al proyecto.

                        </div>
                        <div>
                            <div class="text-red-800 font-semibold">Formato de video</div>
                            <div>
                                Entrevista en formato de vlog o a dos personas
                            </div>
                        </div>
                        <div>
                            <a href="{{ route('web.entrevistas') }}"
                                class="bg-red-800 px-10 text-white rounded-lg font-semibold">Ver más</a>
                        </div>
                    </div>
                </div>
                <div class="mx-auto">
                    <a href="{{ route('web.entrevistas') }}">
                        <img class=" w-86 h-52 object-cover object-center mb-4 " src="{{ asset('img/mashumanos.png') }}"
                            alt="Image Size 720x400" />
                    </a>
                </div>
            </div>

        </div>
        <div class="col-span-3">
            <div class=" grid grid-cols-2">
                <div class="mx-auto">
                    <a href="{{ route('web.entrevistas') }}">
                        <img class=" w-86 h-52 object-cover object-center mb-4 "
                            src="{{ asset('img/mujeresenaccion.png') }}" alt="Image Size 720x400" />
                    </a>
                </div>
                <div class="text-left mt-10">
                    <div class="ml-5 my-auto">
                        <div class="text-red-800 font-semibold">Descripción</div>
                        <div>
                            Sección de entrevistas dedicada 100% a mujeres destacadas, con un proyecto en pro del
                            empoderamiento femenino, ayuda a la sociedad o que haya destacado en alguna actividad
                            social, cultural, científica, económica o tecnología.

                            Debe tener presencia en redes sociales, principalmente en Facebook e Instagram.

                            En la entrevista se destaca a ella como persona, su trayecto y su proyecto.
                        </div>
                        <div>
                            <div class="text-red-800 font-semibold">Formato de video</div>
                            <div>Entrevista en formato de vlog o a dos personas
                            </div>
                        </div>
                        <div>
                            <a href="{{ route('web.entrevistas') }}"
                                class="bg-red-800 px-10 text-white rounded-lg font-semibold">Ver más</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div></div>
        <div></div>
        <div class=" col-span-3">
            <div class=" grid grid-cols-2">
                <div class="text-left mt-10">
                    <div class="ml-5 my-auto">
                        <div class="text-red-800 font-semibold">Descripción</div>
                        <div>
                            Sección de entrevista o reportaje, dedicada a deportistas o deportes.

                            En la entrevista se destaca al deportista y su trayectoria. Cuando se enfoca al deporte, se
                            debe contar parte de su historia (orígenes), evolución y situación actual.

                        </div>
                        <div>
                            <div class="text-red-800 font-semibold">Formato de video</div>
                            <div>
                                Entrevista en formato de vlog o a dos personas
                            </div>
                        </div>
                        <div>
                            <a href="{{ route('web.entrevistas') }}"
                                class="bg-red-800 px-10 text-white rounded-lg font-semibold">Ver más</a>
                        </div>
                    </div>
                </div>
                <div class="mx-auto">
                    <a href="{{ route('web.entrevistas') }}">
                        <img class=" w-86 h-52 object-cover object-center mb-4 "
                            src="{{ asset('img/victoriososent.png') }}" alt="Image Size 720x400" />
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
