<div class="pb-3">
    {!! Form::label('title', __('Encabezado'), ['class' => 'text-2xl font-semibold text-black mb-3']) !!}
    <x-help-form>No mayor de 250 caracteres</x-help-form>
    {!! Form::text('title', null, [
        'class' => 'border-1 border-wine focus:border-wine focus:ring-wine rounded-md my-3 w-2/3 block',
        'placeholder' => __('Título de la nota'),
        'autofocus',
        'id' => 'textTitle',
    ]) !!}
    <div><small id="counterTitle" class=" text-xs text-red-500 top-0    ">0 de 250</small></div>
    @error('title')
        <span class="text-red-600 text-xs">{{ $message }}</span>
    @enderror
</div>
<div class="pb-3">
    {!! Form::label('body', __('Cuerpo de la nota'), ['class' => 'text-2xl font-semibold text-black mb-3']) !!}
    {!! Form::textarea('body', null, [
        'id' => 'body',
        'class' => 'border-1 border-wine focus:border-wine focus:ring-wine rounded-md my-3 w-full block',
        'placeholder' => __('Cuerpo de la nota'),
    ]) !!}
    @error('body')
        <span class="text-red-600 text-xs">{{ $message }}</span>
    @enderror
</div>
<div class="pb-3">
    {!! Form::label('description', __('Meta descripción'), ['class' => 'text-2xl font-semibold text-black mb-3']) !!}
    {!! Form::textarea('description', null, [
        'class' => 'border-1 border-wine focus:border-wine focus:ring-wine rounded-md my-3 w-full block',
        'placeholder' => __('Meta description'),
        'rows' => '2',
        'id' => 'textDescription',
    ]) !!}
    <div><small id="counterDescription" class=" text-xs text-red-500 top-0">0 de 160</small></div>
    @error('description')
        <span class="text-red-600 text-xs">{{ $message }}</span>
    @enderror
</div>
<div class="pb-3">
    {!! Form::label('tags', __('Tags'), ['class' => 'text-2xl font-semibold text-black mb-3']) !!}
    {!! Form::textarea('tags', null, [
        'class' => 'border-1 border-wine focus:border-wine focus:ring-wine rounded-md my-3 w-full block',
        'placeholder' => __('Tags'),
        'rows' => '2',
    ]) !!}
    @error('tags')
        <span class="text-red-600 text-xs">{{ $message }}</span>
    @enderror
</div>
<div class="pb-3">
    {!! Form::label('keywords', __('keywords'), ['class' => 'text-2xl font-semibold text-black mb-3']) !!}
    {!! Form::textarea('keywords', null, [
        'class' => 'border-1 border-wine focus:border-wine focus:ring-wine rounded-md my-3 w-full block',
        'placeholder' => __('Keywords'),
        'rows' => '2',
    ]) !!}
    @error('keywords')
        <span class="text-red-600 text-xs">{{ $message }}</span>
    @enderror
</div>
<div class="pb-3">

    {!! Form::label('categories', __('Categorias'), ['class' => 'text-2xl font-semibold text-black mb-3']) !!}

    <div class="grid grid-cols-1 w-full">
        <select name="categorias" id="categorySelect">
            <option> Elige hasta 4 categorías</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->nombre }}</option>
            @endforeach
        </select>
        <div><small id="counterCategories" class=" text-xs text-blue top-0">hay 0 categorias relacionadas de 4
                permitidas</small></div>
        <div class="shadow rounded px-3 pt-3 pb-0" id="categories">
            @if (old('categories'))
                @foreach (old('categories') as $i => $oldcategory)
                    <div id="category_selected{{ $i }}" class="categoryold flex py-2">
                        <div class="w-3/4">{{ $oldcategory }}
                            <input type="hidden" name="categories[{{ $i }}]" value="{{ $oldcategory }}">
                        </div>
                        <div class="cursor-pointer px-3 py-1 rounded-full bg-wine w-1/4 text-white"
                            onclick='quitar_categoria("category_selected{{ $i }}")'>
                            Quitar
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="w-full">

    </div>
    @error('categories')
        <span class="text-red-600 text-xs">{{ $message }}</span>
    @enderror
</div>

<div class="pb-3">

    {!! Form::label('relate', __('Relacionadas'), ['class' => 'text-2xl font-semibold text-black mb-3']) !!}
    <div class="grid grid-cols-1 w-full">
        {!! Form::text('autocomplete_related', '', [
            'class' => 'border-1 border-wine focus:border-wine focus:ring-wine rounded-md my-3 w-2/3 block',
            'placeholder' => __('Título de la nota'),
            'id' => 'related_autocomplete',
        ]) !!}
        <div><small id="counterRelated" class=" text-xs text-blue top-0">hay 0 notas relacionadas de 4
                permitidas</small></div>
        <div class="shadow rounded px-3 pt-3 pb-0" id="relateds">
            @if (old('related'))
                @foreach (old('related') as $i => $oldrelated)
                    <div id="related_selected{{ $i }}" class="flex py-2 relatedold">
                        <div class="w-3/4">{{ $oldrelated }}
                            <input type="hidden" name="related[{{ $i }}]" value="{{ $oldrelated }}">
                        </div>
                        <div class="cursor-pointer px-3 py-1 rounded-full bg-wine w-1/4 text-white"
                            onclick='quitar_related("related_selected{{ $i }}")'>
                            Quitar
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    @error('relateds')
        <span class="text-red-600 text-xs">{{ $message }}</span>
    @enderror
</div>

<div class="pb-3">
    {!! Form::label('tags', __('Programación en redes'), ['class' => 'text-2xl font-semibold text-black mb-3']) !!}
    <div class="grid grid-cols-2 w-full">
        <div class="rounded-sm py-3 mx-2">
            <label for="redesfb" class="pl-3 my-4 inline cursor-pointer text-left ">
                {{ __('Facebook: Voto en Blanco MX') }}
                {!! Form::checkbox('redfb', null, null, [
                    'class' => 'bg-gray-dark border-wine text-wine focus:ring-wine mr-2',
                    'id' => 'redesfb',
                ]) !!}
            </label>
        </div>
        <div class=" rounded-sm py-3 mx-2">
            <label for="redestw" class="pl-3 my-4 inline cursor-pointer text-left ">
                {{ __('Twitter: VB Noticias') }}
                {!! Form::checkbox('redtw', null, null, [
                    'class' => 'bg-gray-dark border-wine text-wine focus:ring-wine mr-2',
                    'id' => 'redestw',
                ]) !!}
            </label>
        </div>
        <div class="cols-2">
            {!! Form::textarea('social_text', null, [
                'class' => 'border-1 border-wine focus:border-wine focus:ring-wine rounded-md my-3 w-full block',
                'placeholder' => __('Copy para redes'),
                'rows' => '2',
            ]) !!}
        </div>
    </div>
    @error('social_text')
        <span class="text-red-600 text-xs">{{ $message }}</span>
    @enderror
</div>
<div class="pb-3 my-2">
    {!! Form::label('posted', __('Publicar nota en votoenblanco.com.mx'), [
        'class' => 'text-2xl font-semibold text-black mb-3',
    ]) !!}
    <div class="grid grid-cols-2 w-full">
        <div>
            {!! Form::label('port_now', 'Publicar en cuanto el editor autorice', []) !!}
            {!! Form::checkbox('post_now', null, true, []) !!}

        </div>
        <div>
            @error('date')
                <span class="text-red-600 text-xs">{{ $message }}</span>
            @enderror
            @error('time')
                <span class="text-red-600 text-xs">{{ $message }}</span>
            @enderror
        </div>
        <div>
            {!! Form::date('date', null, []) !!} -
            {!! Form::time('time', null, []) !!}
        </div>


    </div>
    <div class="pb-3 my-3">
        {!! Form::label('', __('Nota destacada'), ['class' => 'text-2xl font-semibold text-black mb-3']) !!}
        <div>
        {!! Form::label('featured', __('¿Destacar nota?')) !!}
        {!! Form::checkbox('featured', null, false, []) !!}
    </div>
        <div>
            <small class=" text-xs text-blue top-0">
                Remplaza la nota principal del sitio
            </small>
        </div>
        @error('date')
            <span class="text-red-600 text-xs">{{ $message }}</span>
        @enderror
        @error('time')
            <span class="text-red-600 text-xs">{{ $message }}</span>
        @enderror

    </div>
</div>

<div class="pb-3 grid grid-cols-2  ">
    <div>
        @if (isset($post) && $category->imagen_principal)
            <img src="{{ Storage::url($post->imagen_principal) }}" alt="{{ $post->title }}" class="w-20"
                id="img_category">
        @else
            <img src="{{ asset('img/no_category.jpg') }}" alt="No imagen" class="w-20" id="img_category">
        @endif
    </div>

    <div class=" text-right">
        <span class="cursor-pointer bg-blue rounded-full px-5 py-3" id="btnModalImgs">Vincular imagen</span>
        {!! Form::file('image_principal', [
            'id' => 'file',
            'class' => 'border-2 border-wine focus:border-wine rounded-md mt-1 block mx-auto',
            'placeholder' => __('Imagen principal'),
            'accept' => 'image/*',
        ]) !!}

        @error('image_principal')
            <small class=" text-red-600">{{ $message }}</small>
        @enderror

        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="relative z-10  hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true"
            id="modalImages">
            <!--
      Background backdrop, show/hide based on modal state.
  
      Entering: "ease-out duration-300"
        From: "opacity-0"
        To: "opacity-100"
      Leaving: "ease-in duration-200"
        From: "opacity-100"
        To: "opacity-0"
    -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-95 transition-opacity"></div>

            <div class="fixed z-10 inset-0 overflow-y-auto">
                <div class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0">
                    <!--
          Modal panel, show/hide based on modal state.
  
          Entering: "ease-out duration-300"
            From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            To: "opacity-100 translate-y-0 sm:scale-100"
          Leaving: "ease-in duration-200"
            From: "opacity-100 translate-y-0 sm:scale-100"
            To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        -->
                    <div
                        class="relative bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 w-1/2">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class=" sm:items-start">
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <div class="mt-2" id="Lista de carpetas">
                                        Aqui deberia salir la lista de carpetas y un boton para subir imagenes.
                                        <strong>Qué por qué no esta?</strong>
                                        - Porque apenas lo estoy desarrollando.
                                        Dale click al boton ese feo de al lado
                                        <img src="{{ asset('img/vuelvapronto.jpg') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="button"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"
                                id="noimagen">Cerrar</button>
                            <!--button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cerrar</button-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('jqueryui')
    <script>
        CKEDITOR.replace('body');
        var categorySelect = $(".categoryold").length
        var relatedSelect = $(".relatedold").length
        $(document).ready(function() {
            console.log("El conteo de relacionados empieza en " + relatedSelect)
            console.log("El conteo de categorias empieza en " + categorySelect)
            $("#btnModalImgs").on('click', function() {
                $("#modalImages").show();
            })

            $("#noimagen").on('click', function() {
                $("#modalImages").hide();
            })

            $("#categorySelect").on('change', function() {
                agrega_categoria($(this).val(), $("#categorySelect option:selected").text());

            })

            $("#textTitle").on('keyup', function() {
                contarTitle()
            })

            $("#textDescription").on('keyup', function() {
                contarDescrition()
            })
            contarTitle()
            contarDescrition()
            isAllCategory()
            isAllRelated();
        })

        $("#related_autocomplete").autocomplete({
            minLength: 3,
            source: function(request, response) {
                $.ajax({
                    url: "{{ route('services.related') }}",
                    type: 'GET',
                    dataType: 'JSON',
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        response(
                            $.map(data, function(cats, i) {
                                return $.map(cats, function(post, y) {
                                    return {
                                        label: i + ': ' + post.title,
                                        value: post.id,
                                        cat: i
                                    }
                                })
                            })
                        )
                    }
                })
            },
            select: function(event, ui) {
                agregar_relacionado(ui.item.label, ui.item.value);
                $(this).val("")
                return false
            }

        })

        function contarDescrition() {
            hay = $("#textDescription").val().length;

            if (hay > 120 && hay < 160) {
                $("#counterDescription").removeClass('text-red-500');
                $("#counterDescription").addClass('text-green');
            } else {
                $("#counterDescription").addClass('text-red-500');
                $("#counterDescription").removeClass('text-green');
            }

            $("#counterDescription").html(hay + ' de ' + 160)
        }

        function contarTitle() {
            hay = $("#textTitle").val().length;

            if (hay > 15 && hay < 250) {
                $("#counterTitle").removeClass('text-red-500');
                $("#counterTitle").addClass('text-green');
            } else {
                $("#counterTitle").addClass('text-red-500');
                $("#counterTitle").removeClass('text-green');
            }

            $("#counterTitle").html(hay + ' de ' + 250)
        }

        function quitar_categoria(id) {
            $("#" + id).remove()
            isAllCategory()
        }

        function quitar_related(id) {
            $("#" + id).remove()
            isAllRelated()
        }

        function agrega_categoria(id, value) {
            quitar_categoria('category_selected' + id);

            html = '<div id="category_selected' + id + '" class="categoryold flex py-2">';
            html += '   <div class="w-3/4">' + value;
            html += '       <input type="hidden" name="categories[' + id + ']" value="' + value + '">';
            html += '   </div>';
            html +=
                '   <div class="cursor-pointer px-3 py-1 rounded-full bg-wine w-1/4 text-white" onclick=quitar_categoria("category_selected' +
                id +
                '")>Quitar</div>';
            html += '</div>';

            $("#categories").append(html);
            isAllCategory()
        }

        function isAllCategory() {
            hay = $(".categoryold").length;
            $("#counterCategories").html('Hay ' + hay + ' categorías relacionadas de ' + 4 + ' permitidas')

            $("#categorySelect").prop('disabled', false)
            if (hay >= 4)
                $("#categorySelect").prop('disabled', true)
        }

        function isAllRelated() {
            hay = $(".relatedold").length
            $("#counterRelated").html('Hay ' + hay + ' notas relacionadas de ' + 4 + ' permitidas')

            $("#related_autocomplete").attr("disabled", false);
            if (hay >= 4)
                $("#related_autocomplete").attr("disabled", true);


        }

        function agregar_relacionado(value, id) {
            quitar_related('related_selected' + id)
            html = '<div id="related_selected' + id + '" class="flex py-2 relatedold">';
            html += '   <div class="w-3/4">' + value;
            html += '       <input type="hidden" name="related[' + id + ']" value="' + value + '">';
            html += '   </div>';
            html +=
                '   <div class="cursor-pointer px-3 py-1 rounded-full bg-wine w-1/4 text-white" onclick=quitar_related("related_selected' +
                id +
                '")>Quitar</div>';
            html += '</div>';

            $("#relateds").append(html);
            isAllRelated()
        }
    </script>
@endsection
