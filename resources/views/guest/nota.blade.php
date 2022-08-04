<x-guest-layout>
    <div class="mx-5 px-4 sm:px-6 lg:px-8">
        <div class="my-10 inline-flex">
            <div class="w-2/3  items-center">
                <div class="Header nota my-5">
                    <div class="text-red-800 text-3xl font-bold mb-5 w-full">{{ $post->title }}</div>
                    <div class=" left-0 text-left my-5">{{ $post->editor->name }}</div>
                    <div class=" w-4/5 mx-auto border bg-gray border-gray-light text-center">
                        <img src="{{ asset('img/nota.png') }}" alt="  " class=" ">
                    </div>
                </div>

                <div class="nota body text2xl text-justify">
                    <div class="py-2 my-3">Voto en blanco ({{ $post->created_at }}) ll Redacción</div>
                    {!! $post->details->body !!}
                </div>
            </div>

            <div class="w-1/3">
                <div class="ml-5 text-red-800 font-extralight text-3xl">Relacionadas:</div>
                @if ($post->relateds->count() > 0)
                    @foreach ($post->relateds as $related)
                        <div class="m-5 inline-flex w-full">
                            <a href="{{ route('notas.show', $related->post_id) }}"
                                class="inline-flex font-bold text-sm">
                                <img src="{{ asset('img/bullet.png') }}" alt="" class="w-10 mr-1 inline-flex">
                                <small class="w-25 my-auto break-words">{{ $related->title }}</small>
                            </a>
                        </div>
                    @endforeach
                @else
                    <div>Sin notas relacionadas</div>
                @endif

                <div class="ml-5 h-96 bg-black text-white text-center">Publicidad</div>
            </div>
        </div>
        <div class="bg-black  my-auto h-96 text-white text-center mb-10">
            Publicidad
        </div>
        <div class="py-10">
            <x-title-dark>Comentarios</x-title-dark>
            @if (count($post->comments) == 0)
                Esta nota aun no tiene comentarios
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
            <div class="flex text-center mx-10 my-16">
                <div class="w-1/2 cursor-pointer my-10 text-center ">
                    @if ($post->saveme)
                        {!! Form::open(['route' => 'notas.nosave', 'id' => 'formNoSave']) !!}
                        {!! Form::hidden('post_id', $post->id, []) !!}
                        <div class="cursor-pointer" id="btnNoSave">

                            <img src="{{ asset('img/img_save.png') }}" alt="" class="inline w-20 h-20"
                                id='imgNoSave'>
                            <label for="imgNoSave" class="ml-5 font-bold text-3xl">Quitar de guardados</label>
                        </div>
                        {!! Form::close() !!}
                    @else
                        {!! Form::open(['route' => 'notas.save', 'id' => 'formSave']) !!}
                        {!! Form::hidden('save[post_id]', $post->id, []) !!}
                        <div class="cursor-pointer" id="btnSave">

                            <img src="{{ asset('img/guardar.png') }}" alt="" id="imgSave"
                                class="inline w-20 h-20">
                            <label for="imgSave" class="ml-5 font-bold text-3xl">Guarda</label>
                        </div>
                        {!! Form::close() !!}
                    @endif


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
                @if ($post->likeme)
                    <div>Ya reaccioné, ¿qué pasa ahi?</div>
                @else
                    <div class="w-1/2 cursor-pointer my10 text-right">
                        {!! Form::open(['route' => 'notas.slike', 'id' => 'formSlike']) !!}
                        {!! Form::hidden('post_id', $post->id, []) !!}
                        {!! Form::hidden('reaction', 1, []) !!}
                        <div class="cursor-pointer" id="btnSuperLike">
                            <img src="{{ asset('img/slike.png') }}" alt="" id="slike"
                                class="inline w-20 h-20">
                            <label for="slike" id="labelSlike"
                                class=" ml-5 font-bold text-3xl">{{ $post->slikes }}</label>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="w-1/2 cursor-pointer my10 text-center">
                        {!! Form::open(['route' => 'notas.like', 'id' => 'formLike']) !!}
                        {!! Form::hidden('post_id', $post->id, []) !!}
                        {!! Form::hidden('reaction', 2, []) !!}
                        <div class="cursor-pointer" id="btnLike">
                            <img src="{{ asset('img/like.png') }}" alt="" id="like"
                                class="inline w-20 h-20">
                            <label for="like" id="labelLike"
                                class=" ml-5 font-bold text-3xl">{{ $post->likes }}</label>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="w-1/2 cursor-pointer my10 text-left">
                        {!! Form::open(['route' => 'notas.nolike', 'id' => 'formNoLike']) !!}
                        {!! Form::hidden('post_id', $post->id, []) !!}
                        {!! Form::hidden('reaction', 3, []) !!}
                        <div class="cursor-pointer" id="btnNoLike">
                            <img src="{{ asset('img/nolike.png') }}" alt="" id="nolike"
                                class="inline w-20 h-20">
                            <label for="nolike" id="labelNoLike"
                                class=" ml-5 font-bold text-3xl">{{ $post->nlikes }}</label>
                        </div>
                        {!! Form::close() !!}
                    </div>
                @endif
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
                    })
                })

                $("#btnSave").on('click', function() {
                    reaction('Save')
                })

                $("#btnNoSave").on('click', function() {
                    reaction('NoSave')
                })

                $("#btnShare").on('click', function() {
                    reaction(id, "{{ route('notas.share') }}")
                })

                $("#btnSuperLike").on('click', function() {
                    reaction('Slike')
                })

                $("#btnLike").on('click', function() {
                    reaction("Like")
                })

                $("#btnNoLike").on('click', function() {
                    reaction("NoLike")
                })


            })

            function reaction(what) {
                $.ajax({
                    url: $("#form" + what).attr('action'),
                    type: 'POST',
                    dataType: 'JSON',
                    data: $("#form" + what).serialize(),
                    success: function(data) {
                        if (data.error) {
                            if (what == 'Save') {
                                alert('Pop de suscripcion, que aun no hago');
                            }
                        }
                        if (data.success && what == 'Save')
                            $("#img" + what).attr('src', '{{ asset('img/') }}/img_' + what + '.png')

                        if (data.success && (what == 'Slike' || what == "NoLike" || what == "Like"))
                            $("#label" + what).html(data.slikes);
                    }
                })
            }
        </script>
    @endsection
</x-guest-layout>
