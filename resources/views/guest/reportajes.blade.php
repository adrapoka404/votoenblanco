<x-guest-layout>
    <x-liston>{{ __('reportajes') }}</x-liston>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-3 gap-4">

        <div class="col-span-3">
            <div class=" grid grid-cols-2">
                <div class="mx-auto">
                    <a href="{{ route('web.entrevistas') }}">
                        <img class=" w-86 h-52 object-cover object-center mb-4 "
                            src="{{ asset('img/vagabundarioent.png') }}" alt="Image Size 720x400" />
                    </a>
                </div>
                <div class="text-left mt-10">
                    <div class="ml-5 my-auto">
                        <div class="text-red-800 font-semibold">Descripción</div>
                        <div>
                            Recomendación de sitios para turistear, comer, comprar, etc.
                            Formato de reportaje, puede incluir entrevistas.
                        </div>
                        <div>
                            <div class="text-red-800 font-semibold">Formato de video</div>
                            <div>
                                Su formato en video puede mostrar el lado guapachosos de la cultura en formato de video
                                vlog.
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
                            Sección de reportaje dedicada a cultura, todo aquello que entre por tus sentidos.
                            abordar historia, actualidad, importancia e impacto en la sociedad.
                            Se puede realizar mediante entrevistas o investigación documental.
                        </div>
                        <div>
                            <div class="text-red-800 font-semibold">Formato de video</div>
                            <div>
                                Reportaje en formato de vlog o a dos personas.

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
                            src="{{ asset('img/sensaciones.png') }}" alt="Image Size 720x400" />
                    </a>
                </div>
            </div>

        </div>
        <div class="col-span-3">
            <div class=" grid grid-cols-2">
                <div class="mx-auto">
                    <a href="{{ route('web.entrevistas') }}">
                        <img class=" w-86 h-52 object-cover object-center mb-4 "
                            src="{{ asset('img/haciendoecos.png') }}" alt="Image Size 720x400" />
                    </a>
                </div>
                <div class="text-left mt-10">
                    <div class="ml-5 my-auto">
                        <div class="text-red-800 font-semibold">Descripción</div>
                        <div>
                            Sección de entrevista o reportaje dedicada a problemas medioambientales locales, nacionales
                            o internacionales.

                            La versión escrita puede ser realizada con información documental, mediante la entrevista
                            con uno o varios expertos en el tema, o dedicar el espacio a una AC o proyecto que atienda
                            situaciones medioambientales.
                        </div>
                        <div>
                            <div class="text-red-800 font-semibold">Formato de video</div>
                            <div>
                                Reportaje / Entrevista en formato de vlog o a dos personas

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
                            Sección de reportaje dedicada a Organizaciones de la Sociedad Civil. Tiene como objetivo
                            promover la labor social que realizan y crear conciencia en nuestros lectores.
                            Se puede realizar mediante entrevistas o investigación documental.
                        </div>
                        <div>
                            <div class="text-red-800 font-semibold">Formato de video</div>
                            <div>
                                Reportaje en formato de vlog o a dos personas. Puede contener partes de entrevista lo
                                importante es destacar la labor de la Organización no del entrevistado
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
                            src="{{ asset('img/comununidad.png') }}" alt="Image Size 720x400" />
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
