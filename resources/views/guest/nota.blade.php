<x-guest-layout>
    <div class="mx-5 px-4 sm:px-6 lg:px-8">
        <div class="my-10 inline-flex">
            <div class="w-2/3 text-center items-center">
                <div class="Header nota my-5">
                    <div class="text-red-800 text-3xl font-bold mb-5 w-full">{{ $post->title }}</div>
                    <div class=" left-0 text-left my-5">{{ $post->editor->name }}</div>
                    <div class=" w-4/5 mx-auto border bg-gray border-gray-light text-center">
                        <img src="{{ asset('img/nota.png') }}" alt="  " class=" ">
                    </div>
                </div>

                <div class="nota body text2xl">
                    <div class="py-2 my-3 text-justify">Voto en blanco ({{ $post->created_at }}) ll Redacción</div>
                    {{ html_entity_decode($post->details->body) }}
                </div>
            </div>

            <div class="w-1/3">
                <div class="ml-5 text-red-800 font-extralight text-3xl">Relacionadas:</div>
                @foreach ($post->relateds as $related)
                    <div class="m-5 inline-flex w-full">
                        <a href="{{ route('notas.show', $related->post_id) }}" class="inline-flex font-bold text-sm">
                            <img src="{{ asset('img/bullet.png') }}" alt="" class="w-10 mr-1 inline-flex">
                            <small class="w-25 my-auto break-words">{{ $related->title }}</small>
                        </a>
                    </div>
                @endforeach
                <div class="ml-5 h-96 bg-black text-white text-center">Publicidad</div>
            </div>
        </div>
        <div class="bg-black  my-auto h-96 text-white text-center mb-10">
            Publicidad
        </div>
        <div class="py-10">
            <x-title-dark>Comentarios</x-title-dark>

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
            <div class="flex text-center mx-10 my-16">
                <div class="w-1/2 cursor-pointer my-10 text-center ">
                    <div class="cursor-pointer" id="btnSave">
                        <img src="{{ asset('img/guardar.png') }}" alt="" id="guarda"
                            class="inline w-20 h-20">
                        <label for="guarda" class="ml-5 font-bold text-3xl">Guarda</label>
                    </div>
                </div>
                <div class="w-1/2 cursor-pointer my-10 text-center">
                    <div class="cursor-pointer" id="btnShare">
                        <img src="{{ asset('img/compartir.png') }}" alt="" id="comparte"
                            class="inline w-20 h-20">
                        <label for="comparte" class=" ml-5 font-bold text-3xl">Comparte</label>
                    </div>
                </div>

            </div>
        </div>
        <div class="py-10">
            <x-title-dark>¿Cúal es tu reacción?</x-title-dark>
            <div class="flex">
                <div class="w-1/2 cursor-pointer my10 text-right">
                    <div class="cursor-pointer" id="btnSuperLike">
                        <img src="{{ asset('img/slike.png') }}" alt="" id="slike" class="inline w-20 h-20">
                        <label for="slike" class=" ml-5 font-bold text-3xl">1{{ $post->slikes }}</label>
                    </div>
                </div>
                <div class="w-1/2 cursor-pointer my10 text-center">
                    <div class="cursor-pointer" id="btnLike">
                        <img src="{{ asset('img/like.png') }}" alt="" id="like" class="inline w-20 h-20">
                        <label for="like" class=" ml-5 font-bold text-3xl">2{{ $post->likes }}</label>
                    </div>
                </div>
                <div class="w-1/2 cursor-pointer my10 text-left">
                    <div class="cursor-pointer" id="btnNoLike">
                        <img src="{{ asset('img/nolike.png') }}" alt="" id="nolike"
                            class="inline w-20 h-20">
                        <label for="nolike" class=" ml-5 font-bold text-3xl">3{{ $post->nolikes }}</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-10">
            <x-title-dark>Qué opinas?</x-title-dark>
            <div class=" w-2/3 mx-auto border-2 border-wine rounded-xl p-3">
                <div class=" text-green font-light clear" id="successComment"></div>
                {!! Form::open(['route' => 'notas.coments', 'id' => 'formComents']) !!}
                <div class=" m-10 mx-auto w-full">
                    Nombre:
                    {!! Form::text('coment[name]', old('coment.name'), [
                        'class' =>
                            'border-2 border-red-800 focus:border-red-800 focus:bg-red-200 focus:ring-wine rounded-md block mt-1 w-full md:w-1/2',
                    ]) !!}
                    <div class="text-red-600 text-xs clear" id="errorCommentName"></div>
                    Correo electrónico:
                    {!! Form::email('coment[email]', old('coment.email'), [
                        'class' =>
                            'border-2 border-red-800 focus:border-red-800 focus:bg-red-200 focus:ring-wine rounded-md block mt-1 w-full md:w-1/2',
                    ]) !!}
                    <div class="text-red-600 text-xs clear" id="errorCommentEmail"></div>
                    Comentario:
                    {!! Form::textarea('coment[comment]', old('coment.comment'), [
                        'class' =>
                            'border-2 border-red-800 focus:border-red-800 focus:bg-red-200 focus:ring-wine rounded-md block mt-1 w-full md:w-1/2',
                        'rows' => '5',
                    ]) !!}
                    <div class="text-red-600 text-xs clear" id="errorCommentComment"></div>
                    {!! Form::hidden('coment[post_id]', $post->id, []) !!}
                    <x-jet-validation-errors />
                    <div class="w-1/2 mx-auto items-center py-5">
                        <span class="mx-3 my-5 bg-wine text-white cursor-pointer rounded-full px-3 py-1 "
                            id="btnComents">Enviar</span>
                    </div>
                </div>
                {!! Form::close() !!}
                <div class="w-1/3" id="divErrors"></div>
            </div>

        </div>
        @csrf
    </div>
    @section('jquery')
        <script>
            var id = "{{ $post->id }}";

            $(document).ready(function() {
                $("#btnComents").on('click', function() {
                    $(".clear").html('');
                    $.ajax({
                        url: $("#formComents").attr('action'),
                        type: 'POST',
                        dataType: 'JSON',
                        data: $("#formComents").serialize(),
                        success: function(data) {
                            $("#successComment").html(data.msg)
                            $("#formComents").get(0).reset()

                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            if (xhr.responseJSON.errors) {
                                errores = xhr.responseJSON.errors;

                                if (errores['coment.name'])
                                    $("#errorCommentName").html(errores['coment.name'][0]);

                                if (errores['coment.email'])
                                    $("#errorCommentEmail").html(errores['coment.email'][0]);

                                if (errores['coment.comment'])
                                    $("#errorCommentComment").html(errores['coment.comment'][0]);
                            }

                        },
                        //$("#formComents").submit();
                    })
                })

                $("#btnSave").on('click', function() {
                    reaction(id, "{{ route('notas.save') }}")
                })

                $("#btnShare").on('click', function() {
                    reaction(id, "{{ route('notas.share') }}")
                })

                $("#btnSuperLike").on('click', function() {
                    reaction(id, "{{ route('notas.slike') }}")
                })

                $("#btnLike").on('click', function() {
                    reaction(id, "{{ route('notas.like') }}")
                })

                $("#btnNoLike").on('click', function() {
                    reaction(id, "{{ route('notas.nolike') }}")
                })


            })

            /*function reaction(what, where) {
                $.ajax({
                    url: where,
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        id: what,
                        _token: document.getElementsByName("_token")
                    },
                    success: function(data) {
                        console.log(data);
                        /*response($.map(data, function(item) {
                            return {
                                label: item.title,
                                value: item.id
                            }
                        }))
                    }
                })
            }*/
        </script>
    @endsection
</x-guest-layout>
