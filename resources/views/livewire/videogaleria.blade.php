<div class="max-w-7xl mx-auto px-4 my-5 sm:px-6 lg:px-8 md:flex items-center">
    <div class="w-full md:w-2/3  items-center">
        <span class="text-3xl text-red-800 font-bold">Videogaleria</span>
        <div class="w-full my-10">
            <iframe height="386" width="100%"  src="{{$vgaleria->url}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3">
            @foreach ($vgalerias as $vg)
            <div>
                <iframe class="w-full my-5 mx-2 px-2 md:w-52"   src="{{$vg->url}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>    
            @endforeach
            
        </div>
    </div>
    <div class="bg-black w-full md:w-1/3 text-center h-96 text-white font-extralight text-2xl m-2">
        @foreach ($home_lateral as $hl)
                    <img src="{{asset('storage/'.$hl->body)}}" alt="{{$hl->name}}">
                        
                    @endforeach
    </div>

</div>
