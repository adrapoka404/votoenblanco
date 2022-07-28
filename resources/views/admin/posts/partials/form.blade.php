<div class="pb-3">
    {!! Form::label('title', __('Encabezado'), ['class' => 'text-2xl font-semibold text-black mb-3']) !!}
    <x-help-form>No mayor de 250 caracteres</x-help-form>
    {!! Form::text('title', null, [
        'class' => 'border-1 border-wine focus:border-wine focus:ring-wine rounded-md my-3 w-2/3 block',
        'placeholder' => __('Título de la nota'),
        'autofocus',
        'id'=>'textTitle',
    ]) !!}
    <div><small id="counterTitle" class=" text-xs text-red-500 top-0    ">250</small></div>
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
    <div><small id="counterDescription" class=" text-xs text-red-500 top-0">160</small></div>
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
        <div class="shadow rounded px-3 pt-3 pb-0" id="categories"></div>
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
        <div class="shadow rounded px-3 pt-3 pb-0" id="relateds"></div>
    </div>
    @error('relateds')
        <span class="text-red-600 text-xs">{{ $message }}</span>
    @enderror
</div>

<div class="pb-3">
    {!! Form::label('tags', __('Programación en redes'), ['class' => 'text-2xl font-semibold text-black mb-3']) !!}
    <div class="grid grid-cols-2 w-full">
        <div class="border-2 border-wine rounded-sm py-3">
            <label for="redesfb" class="pl-3 my-4 inline cursor-pointer text-left ">
                {{ __('Facebook: Voto en Blanco MX') }}
                {!! Form::checkbox('redfb', null, null, ['class' => 'bg-gray-dark border-wine text-wine focus:ring-wine mr-2']) !!}
            </label>
        </div>
        <div class="border-2 border-wine rounded-sm py-3">
            <label for="redestw" class="pl-3 my-4 inline cursor-pointer text-left ">
                {{ __('Twitter: VB Noticias') }}
                {!! Form::checkbox('redtw', null, null, ['class' => 'bg-gray-dark border-wine text-wine focus:ring-wine mr-2']) !!}
            </label>
        </div>
        <div>
            {!! Form::textarea('social_text', null, [
                'class' => 'border-1 border-wine focus:border-wine focus:ring-wine rounded-md my-3 w-full block',
                'placeholder' => __('Copy'),
                'rows' => '2',
            ]) !!}
        </div>
    </div>
    @error('social_text')
        <span class="text-red-600 text-xs">{{ $message }}</span>
    @enderror
</div>
<div class="pb-3 border-2 border-wine my-2">
    {!! Form::label('posted', __('Publicar nota en votoenblanco.com.mx')) !!}
    {!! Form::date('date', null, []) !!}
    {!! Form::time('time', null, []) !!}
    {!! Form::label('port_now', 'Publicar ahora', []) !!}
    {!! Form::checkbox('post_now', null, true, []) !!}
    @error('date')
        <span class="text-red-600 text-xs">{{ $message }}</span>
    @enderror
    @error('time')
        <span class="text-red-600 text-xs">{{ $message }}</span>
    @enderror

</div>
<div class="pb-3 border-2 border-wine my-2">
    {!! Form::label('featured', __('Nota destacada')) !!}
    {!! Form::checkbox('featured', null, false, []) !!}
    @error('date')
        <span class="text-red-600 text-xs">{{ $message }}</span>
    @enderror
    @error('time')
        <span class="text-red-600 text-xs">{{ $message }}</span>
    @enderror

</div>

<div class="pb-3">
    <div>

        @if (isset($post) && $category->imagen_principal)
            <img src="{{ Storage::url($post->imagen_principal) }}" alt="{{ $post->title }}" class="w-20"
                id="img_category">
    </div>
@else
    <img src="{{ asset('img/no_category.jpg') }}" alt="No imagen" class="w-20" id="img_category">
</div>
@endif

<div>{!! Form::file('image_principal', [
    'id' => 'file',
    'class' => 'border-2 border-wine focus:border-wine rounded-md mt-1 block mx-auto',
    'placeholder' => __('Imagen principal'),
    'accept' => 'image/*',
]) !!}
    @error('image_principal')
        <small class=" text-red-600">{{ $message }}</small>
    @enderror
</div>
</div>

@section('jqueryui')
    <script>
        CKEDITOR.replace('body');
        var categorySelect = 0;
        var relatedSelect = 0;
        $(document).ready(function() {

            $("#categorySelect").on('change', function() {
                agrega_categoria($(this).val(), $("#categorySelect option:selected").text());

            })

            $("#textTitle").on('keyup', function(){
                hay = $(this).val().length;

                $("#counterTitle").html(250 - hay)
            })

            $("#textDescription").on('keyup', function(){
                hay = $(this).val().length;

                $("#counterDescription").html(250 - hay)
            })

        })

        $("#related_autocomplete").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{ route('services.related') }}",
                    type: 'GET',
                    dataType: 'JSON',
                    delay: 250,
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        console.log(data);
                        response($.map(data, function(item) {
                            return {
                                label: item.title,
                                value: item.id
                            }
                        }))
                    }
                })
            }
        })

        $("#related_autocomplete").on("autocompleteselect", function(event, ui) {
            console.log('limpiar el input');
            $(this).val('')
            agregar_relacionado(ui.item.label, ui.item.value);
        });


        function quitar_categoria(id) {
            $("#" + id).remove();
            categorySelect--;
            if (categorySelect < 4)
                $("#categorySelect").prop('disabled', false)
        }

        function quitar_related(id) {
            $("#" + id).remove();
            relatedSelect--;
            if (relatedSelect < 4)
                $("#related_selected").prop('disabled', false)
        }

        function agrega_categoria(id, value) {

            html = '<div id="category_selected' + id + '" class="flex py-2">';
            html += '   <div class="w-3/4">' + value;
            html += '       <input type="hidden" name="categories[]" value="' + id + '">';
            html += '   </div>';
            html +=
                '   <div class="cursor-pointer px-3 py-1 rounded-full bg-wine w-1/4 text-white" onclick=quitar_categoria("category_selected' +
                id +
                '")>Quitar</div>';
            html += '</div>';

            $("#categories").append(html);
            categorySelect++;

            if (categorySelect == 4)
                $("#categorySelect").prop('disabled', 'disabled')
        }

        function agregar_relacionado(value, id) {

            html = '<div id="related_selected' + id + '" class="flex py-2">';
            html += '   <div class="w-3/4">' + value;
            html += '       <input type="hidden" name="related[]" value="' + id + '">';
            html += '   </div>';
            html +=
                '   <div class="cursor-pointer px-3 py-1 rounded-full bg-wine w-1/4 text-white" onclick=quitar_categoria("related_selected' +
                id +
                '")>Quitar</div>';
            html += '</div>';

            $("#relateds").append(html);
            relatedSelect++;

            if (relatedSelect == 4)
                $("#related_autocomplete").prop('disabled', 'disabled')
        }
    </script>
@endsection
