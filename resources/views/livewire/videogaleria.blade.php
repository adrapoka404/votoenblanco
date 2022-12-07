<div class="lg:mx-10 px-4 my-5 grid sm:grid-col-1 lg:grid-cols-3 sm:px-6 w-full items-center">
    <div class="w-full lg:col-span-2 items-center mr-5">
        <span class="text-3xl text-red-800 font-bold">Videogaleria</span>
        <div class="w-full my-10">
        
            <div id="carouselVideoGaleria" class="carousel slide relative" data-bs-ride="carousel">
                <div class="carousel-inner relative w-full overflow-hidden">
                    <div class="carousel-item active relative float-left w-full">
                    <iframe height="600" width="100%" src="{{ $vgaleria->url }}" title="{{$vgaleria->title}}" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                    </div>
                    @foreach ($vgalerias as $indx => $vg)
                        <div class="carousel-item relative float-left w-full">
                            <iframe height="600" width="100%" src="{{ $vg->url }}" title="{{$vg->title}}" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                    </div>
                    @endforeach
                </div>
                <button
                    class="carousel-control-prev absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline left-0"
                    type="button" data-bs-target="#carouselVideoGaleria" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon inline-block bg-no-repeat" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button
                    class="carousel-control-next absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline right-0"
                    type="button" data-bs-target="#carouselVideoGaleria" data-bs-slide="next">
                    <span class="carousel-control-next-icon inline-block bg-no-repeat" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
    <div class="w-full text-center lg:h-96 text-white font-extralight text-2xl pl-2">
        <div id="carouselPanelLateral" class="carousel slide relative" data-bs-ride="carousel">
            <div class="carousel-inner relative w-full overflow-hidden">
                @if (empty($home_lateral))
                    <div class="bg-black">Publicidad</div>
                @else
                    @foreach ($home_lateral as $indx => $hl)
                        <div
                            class="carousel-item @if ($indx == 0) active @endif relative float-left w-full">
                            <img src="{{ asset('storage/' . $hl->sections->local->origin) }}" class="block w-full"
                                alt="{{ $hl->name }}" />
                        </div>
                    @endforeach
                @endif
            </div>
            <button
                class="carousel-control-prev absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline left-0"
                type="button" data-bs-target="#carouselPanelLateral" data-bs-slide="prev">
                <span class="carousel-control-prev-icon inline-block bg-no-repeat" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button
                class="carousel-control-next absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline right-0"
                type="button" data-bs-target="#carouselPanelLateral" data-bs-slide="next">
                <span class="carousel-control-next-icon inline-block bg-no-repeat" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

</div>
