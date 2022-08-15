<div
    class=" bg-black border-t-8 border-red-800 pt-10 pb-5 mt-10 mb-2 text-white font-sans font-medium">
    <div class="flex flex-wrap">
        <div class="w-full md:w-1/2 lg:w-1/3">
            <img src="{{ asset('img/vb_footer.png') }}" alt="" class="px-10">
        </div>
        <div class="w-full md:w-1/2 lg:w-1/3 font-sans font-light tracking-widest items-center my-10 md:my-auto ">
            <div class="flex flex-col-5 flex-row-2">
                <div>
                    <a href="https://bit.ly/3hIQPCu" target="_blank">
                        <div class=" w-8 h-8 bg-no-repeat mx-1 bg-insta bg-contain"></div>
                    </a>
                </div>
                <div>
                    <a href="https://www.facebook.com/VtenBlanco" target="_blank">
                        <div class="w-8 h-8 bg-no-repeat mx-2 bg-fb bg-contain"></div>
                    </a>
                </div>
                <div>
                    <a href="https://bit.ly/35yOasG" target="_blank">
                        <div class="w-8 h-8 bg-no-repeat mx-2 bg-tw bg-contain"></div>
                    </a>
                </div>
                <div> <a href="https://bit.ly/3hOtXkR" target="_blank">
                        <div class="w-8 h-8 bg-no-repeat mx-2 bg-tt bg-contain"></div>
                    </a>

                </div>
                <div>
                    <a href="https://www.youtube.com/channel/UCGCPi8_DG0nUq_A_E0sN4SQ" target="_blank">
                        <div class="w-8 h-8 bg-no-repeat mx-2 bg-yt bg-contain"></div>
                    </a>
                </div>
                <span class="ml-3 h-8">Contáctanos</span>
            </div>
            
            <div class="w-full mt-5 inline-flex">
                <a href="https://wa.me/5526593156" target="_blank" id="inWhats">
                    <div class=" bg-whats w-8 h-8 bg-contain"></div>
                    
                    <span class="" id="inWhats">Anúnciate con nosotros</span>
                </a>
                
            </div>

            <div class="w-full">
                <div class="mt-10">Suscríbete</div>
            </div>

        </div>
        <div class="w-full md:w-1/2 lg:w-1/3 mt-20">
            <div class="ml-5 my-5">
                <x-actionfooter href="{{ route('web.aboutus') }}" :active="request()->routeIs('#')">
                    {{ __('Nosotros') }}
                </x-actionfooter>
            </div>
            <div class="ml-5 my-5">
                <x-actionfooter href="{{ route('web.team') }}" :active="request()->routeIs('#')">
                    {{ __('nuestro equipo') }}
                </x-actionfooter>
            </div>
            <div class="ml-5 my-5">
                <x-actionfooter href="{{ route('web.privacy') }}" :active="request()->routeIs('#')">
                    {{ __('aviso de privacidad') }}
                </x-actionfooter>
            </div>
        </div>
        <div class="w-full md:w-1/2 lg:w-2/3 font-sans font-light tracking-widest mt-20 pl-10 inline-block align-text-baseline">
        <p class=" align-bottom">Metepec. Estado de México</p>
        <p>COPYRIGHT todos los derechos Reservados</p>
        donde va este texto
        </div>
        <div class="w-full lg:w-1/3 flex flex-col-2 items-end mt-20 font-sans font-light tracking-widest place-content-end">
            <div class="bg-security bg-no-repeat w-20 h-20 bg-contain"></div>
            <div class="w-1/2 font-serif font-medium">Cetificado de seguridad</div>
        </div>
    </div>
</div>
