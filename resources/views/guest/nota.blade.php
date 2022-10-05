<x-guest-layout>
    <div class="mx-5 px-4 sm:px-6 lg:px-8">
        <div class="my-10 flex flex-col md:flex-row">
            <div class="w-full md:w-2/3  items-center">
                <div class="Header nota my-5">
                    <div class="text-red-800 text-3xl font-bold mb-5 w-full">{{ $post->title }}</div>
                    <div class=" w-4/5 h-96 bg-no-repeat mx-auto border bg-gray border-gray-light text-center bg-cover "
                        style="background-image: url({{ asset('storage/' . $post->image_principal) }})">

                    </div>
                </div>

                <div class="nota body text2xl text-justify">
                    <div class="py-2 my-3">
                        <x-link-fb /> ({{ $post->created_at }})
                        <x-link-redactor userto="{{ route('notas.editores', $post->editor->slug) }}"
                            user="{{ $post->editor->name }}" />
                    </div>
                    {!! $post->details->body !!}
                </div>
            </div>

            <div class="w-full md:w-1/3">
                <div class="ml-5 text-red-800 font-extralight text-3xl">Relacionadas:</div>
                @if ($post->relateds->count() > 0)
                    @foreach ($post->relateds as $related)
                        <div class="ml-5 my-3  inline-flex w-7/8">
                            <a href="{{ route('notas.show', $related->slug) }}"
                                class="inline-flex font-bold text-lg tracking-wide ">
                                <img src="{{ asset('img/bullet.png') }}" alt=""
                                    class="w-10 h-10 mr-1 inline-flex">
                                <small class="w-25 my-auto break-words">
                                    @if (strlen($related->title) > 75)
                                        {{ substr($related->title, 0, 75) . '...' }}
                                    @else
                                        {{ $related->title }}
                                    @endif
                                </small>
                            </a>
                        </div>
                    @endforeach
                @else
                    <div>Sin notas relacionadas</div>
                @endif

                <div class="ml-5 h-96 bg-black text-white text-center">
                    <div id="carouselNotaPanelLateral" class="carousel slide relative" data-bs-ride="carousel">
                        <div class="carousel-inner relative w-full overflow-hidden">
                            @if(empty($ads_lateral))
                            <div class="bg-black">Publicidad</div>
                            @else
                            @foreach ($ads_lateral as $indx => $al)
                                <div
                                    class="carousel-item @if ($indx == 0) active @endif relative float-left w-full">
                                    <img src="{{ asset('storage/' . $al->sections->postlateral->origin) }}" class="block w-full h-96" alt="{{ $al->name }}" />
                                </div>
                            @endforeach
                            @endif
                        </div>
                        <button
                            class="carousel-control-prev absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline left-0"
                            type="button" data-bs-target="#carouselNotaPanelLateral" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon inline-block bg-no-repeat" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button
                            class="carousel-control-next absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline right-0"
                            type="button" data-bs-target="#carouselNotaPanelLateral" data-bs-slide="next">
                            <span class="carousel-control-next-icon inline-block bg-no-repeat" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-black  my-auto h-96 text-white text-center mb-10">
                    <div id="carouselPanelLocal" class="carousel slide relative" data-bs-ride="carousel">
                        <div class="carousel-inner relative w-full overflow-hidden">
                            @if(empty($ads_fin))
                            <div class="bg-black">Publicidad</div>
                            @else
                            @foreach ($ads_fin as $indx => $af)
                                <div
                                    class="carousel-item @if ($indx == 0) active @endif relative float-left w-full">
                                    <img src="{{ asset('storage/' . $af->sections->postbody->origin) }}" class="block w-full h-96" alt="{{ $af->name }}" />
                                </div>
                            @endforeach
                            @endif
                        </div>
                        <button
                            class="carousel-control-prev absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline left-0"
                            type="button" data-bs-target="#carouselPanelLocal" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon inline-block bg-no-repeat" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button
                            class="carousel-control-next absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline right-0"
                            type="button" data-bs-target="#carouselPanelLocal" data-bs-slide="next">
                            <span class="carousel-control-next-icon inline-block bg-no-repeat" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
        </div>
        <div class="py-10">
            <x-title-dark>Comentarios</x-title-dark>
            @if (count($post->comments) == 0)
                Esta nota aun no tiene comentarios autorizados
            @endif
            @foreach ($post->comments as $comment)
                <x-coment-post>
                    <x-slot name="imagen">{{ asset('img/nuevo_perfil.png') }}</x-slot>
                    <x-slot name="nombre">{{ $comment->name }}</x-slot>
                    <x-slot name="comment">{{ $comment->comment }}</x-slot>
                </x-coment-post>
            @endforeach
        </div>
        <div class="">
            <x-title-dark>¿Te ha gustado esta nota?</x-title-dark>
            <div class="flex flex-col md:flex-row text-center mx-10 my-16 items-center">
                <div class="w-1/2 my-10 text-center ">
                    @if ($post->saveme)
                        {!! Form::open(['route' => 'notas.nosave', 'id' => 'formNoSave']) !!}
                        {!! Form::hidden('post_id', $post->id, []) !!}
                        <div class="" id="btnNoSave">
                            <img src="{{ asset('img/guardadas.png') }}" alt="" class="inline w-20 h-20"
                                id='imgNoSave' />
                            <label for="imgNoSave" class="ml-5 font-bold text-3xl cursor-pointer" id="saveLabel">
                                Quitar de guardados
                            </label>
                        </div>
                        {!! Form::close() !!}
                    @else
                        {!! Form::open(['route' => 'notas.save', 'id' => 'formSave']) !!}
                        {!! Form::hidden('save[post_id]', $post->id, []) !!}
                        <div class="cursor-pointer" id="btnSave">
                            <img src="{{ asset('img/guardar.png') }}" alt="" id="imgSave"
                                class="inline w-20 h-20">
                            <label for="imgSave" id="saveLabel" class="ml-5 font-bold text-3xl">Guardar</label>
                        </div>
                        {!! Form::close() !!}
                    @endif


                </div>
                <div class="w-1/2 cursor-pointer my-10 text-center">
                    <div class="cursor-pointer" id="">
                        <img src="{{ asset('img/compartir.png') }}" alt="" id="comparte"
                            class="inline w-20 h-20 cursor-pointer">
                        <label for="comparte" class=" ml-5 font-bold text-3xl cursor-pointer" id='comparteLabel'>Comparte</label>
                        <div class="fb-share-button w-full" 
                        data-href="{{route('notas.show', $post->slug)}}" 
                        data-layout="button_count" 
                        data-size="small">
                        <a id='actionShared' target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{route('notas.show', $post->slug)}}&amp;src=sdkpreparse"
                         class="fb-xfbml-parse-ignore">
                        </a>
                        </div>
                        
                    </div>
                </div>

            </div>
        </div>
        <div class="py-10">
            <x-title-dark>¿Cúal es tu reacción?</x-title-dark>
            <div class="flex flex-col md:flex-row">
                <div class="w-1/2 cursor-pointer my-10 text-center md:text-rigth mx-auto">
                    {!! Form::open(['route' => 'notas.reaction', 'id' => 'formSlike']) !!}
                    {!! Form::hidden('post_id', $post->id, []) !!}
                    {!! Form::hidden('reaction', 1, []) !!}
                    <div class="cursor-pointer" id="btnSuperLike">
                        @if ($post->ireaction == 1)
                            <img src="{{ asset('img/slike.png') }}" alt="" id="slike"
                                class="inline w-20 h-20">
                        @else
                            <img src="{{ asset('img/slikeOn.png') }}" alt="" id="slike"
                                class="inline w-20 h-20">
                        @endif

                        <label for="slike" id="labelSlike"
                            class=" ml-5 font-bold text-3xl">{{ $post->slikes }}</label>
                    </div>
                    {!! Form::close() !!}
                </div>

                <div class="w-1/2 cursor-pointer my-10 text-center md:text-rigth mx-auto">
                    {!! Form::open(['route' => 'notas.reaction', 'id' => 'formLike']) !!}
                    {!! Form::hidden('post_id', $post->id, []) !!}
                    {!! Form::hidden('reaction', 2, []) !!}
                    <div class="cursor-pointer" id="btnLike">
                        @if ($post->ireaction == 2)
                            <img src="{{ asset('img/like.png') }}" alt="" id="like"
                                class="inline w-20 h-20">
                        @else
                            <img src="{{ asset('img/likeOn.png') }}" alt="" id="like"
                                class="inline w-20 h-20">
                        @endif
                        <label for="like" id="labelLike"
                            class=" ml-5 font-bold text-3xl">{{ $post->likes }}</label>
                    </div>
                    {!! Form::close() !!}
                </div>

                <div class="w-1/2 cursor-pointer my-10 text-center md:text-rigth mx-auto">
                    {!! Form::open(['route' => 'notas.reaction', 'id' => 'formNoLike']) !!}
                    {!! Form::hidden('post_id', $post->id, []) !!}
                    {!! Form::hidden('reaction', 3, []) !!}
                    <div class="cursor-pointer" id="btnNoLike">
                        @if ($post->ireaction == 3)
                            <img src="{{ asset('img/nolike.png') }}" alt="" id="nolike"
                                class="inline w-20 h-20">
                        @else
                            <img src="{{ asset('img/nolikeOn.png') }}" alt="" id="nolike"
                                class="inline w-20 h-20">
                        @endif
                        <label for="nolike" id="labelNoLike"
                            class=" ml-5 font-bold text-3xl">{{ $post->nlikes }}</label>
                    </div>
                    {!! Form::close() !!}
                </div>

            </div>
        </div>

        <div class="py-10">
            <x-title-dark>¿Qué opinas?</x-title-dark>
            <div class=" w-full md:w-2/3 mx-auto border-2 border-wine rounded-xl p-3">
                <div class=" text-green font-light clear" id="successComment"></div>
                {!! Form::open(['route' => 'notas.coments', 'id' => 'formComents']) !!}
                <div class=" m-10 mx-auto w-full">
                    Nombre:
                    {!! Form::text('coment[name]', old('coment.name'), [
                        'class' =>
                            'border-2 border-red-800 focus:border-red-800 focus:bg-red-200 focus:ring-wine rounded-md block mt-1 w-full md:w-2/3',
                    ]) !!}
                    <div class="text-red-600 text-xs clear" id="errorCommentName"></div>
                    Correo electrónico:
                    {!! Form::email('coment[email]', old('coment.email'), [
                        'class' =>
                            'border-2 border-red-800 focus:border-red-800 focus:bg-red-200 focus:ring-wine rounded-md block mt-1 w-full md:w-2/3',
                    ]) !!}
                    <div class="text-red-600 text-xs clear" id="errorCommentEmail"></div>
                    Comentario:
                    {!! Form::textarea('coment[comment]', old('coment.comment'), [
                        'class' =>
                            'border-2 border-red-800 focus:border-red-800 focus:bg-red-200 focus:ring-wine rounded-md block mt-1 w-full md:w-2/3',
                        'rows' => '5',
                    ]) !!}
                    <div class="text-red-600 text-xs clear" id="errorCommentComment"></div>
                    {!! Form::hidden('coment[post_id]', $post->id, []) !!}
                    <x-jet-validation-errors />
                    <div class="w-1/2 mx-auto items-center py-5">
                        <span class="mx-5 my-5 bg-wine text-white cursor-pointer rounded-full px-3 py-1 "
                            id="btnComents">Enviar</span>
                    </div>
                </div>
                {!! Form::close() !!}
                <div class="w-1/3" id="divErrors"></div>
            </div>

        </div>
        @csrf
    </div>
</x-guest-layout>
<div class="fb-share-button" 
data-href="{{url('notas.show', 'adx')}}" 
data-layout="button_count">
</div>
<div id="fb-root"></div>
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>