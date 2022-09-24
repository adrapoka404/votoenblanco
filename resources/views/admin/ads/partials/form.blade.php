<div class="flex flex-row">
    <div class="flex-1">
        {!! Form::label('name', __('Titulo'), ['class' => 'text-2xl font-semibold text-black mb-3']) !!}
        <div>
            @error('name')
                <x-has-error>{{ $message }}</x-has-error>
            @enderror
        </div>
    </div>
    <div class="flex-1">
        {!! Form::text('name', old('name') ? old('name') : (isset($ad) ? $ad->name : ''), [
            'class' => 'border-1 border-wine focus:border-wine focus:ring-wine rounded-md my-3 w-full block',
            'placeholder' => __('Título del anuncio'),
            'autofocus',
            'id' => 'textTitle',
        ]) !!}
    </div>
</div>
<div class="flex flex-row">
    <div class="flex-1">
        {!! Form::label('body', __('Cuerpo del anuncio'), ['class' => 'text-2xl font-semibold text-black mb-3 w-full']) !!}
        <div>
            @error('body')
                <span class="text-red-600 text-xs">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="flex-1">
        {!! Form::textarea('body', old('body') ? old('body') : (isset($ad) ? $ad->body : ''), [
            'id' => 'body',
            'class' => 'border-1 border-wine focus:border-wine focus:ring-wine rounded-md my-3 w-full block',
            'placeholder' => __('Cuerpo del anuncio'),
        ]) !!}
    </div>
</div>
<div class="flex flex-row">
    <div class="flex-1">
        {!! Form::label('status', __('Estado'), ['class' => 'text-2xl font-semibold text-black mb-3']) !!}
        <div>
            @error('status')
                <span class="text-red-600 text-xs">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="flex-1">
        {!! Form::select('status', ['0' => __('Desactivado'), '1' => __('Activo')], 1, [
            'class' => 'border-2 border-wine focus:border-wine rounded-md mt-1 ',
        ]) !!}
    </div>
</div>
<div class="flex flex-row">
    <div class="flex-1">
        {!! Form::label('orden', __('Orden'), ['class' => 'text-2xl font-semibold text-black mb-3']) !!}
        <div>
            @error('orden')
                <x-has-error>{{ $message }}</x-has-error>
            @enderror
        </div>
    </div>
    <div class="flex-1">
        {!! Form::text('orden', old('orden') ? old('orden') : (isset($ad) ? $ad->orden : ''), [
            'class' => 'border-1 border-wine focus:border-wine focus:ring-wine rounded-md my-3 w-2/3 block',
            'placeholder' => __('Orden'),
            'id' => 'textOrden',
        ]) !!}

    </div>
</div>

<div class="flex flex-row">
    <div class="flex-1">
        {!! Form::label('start', __('Fecha inicio'), ['class' => 'text-2xl font-semibold text-black mb-3']) !!}
        <div>
            @error('start')
                <x-has-error>{{ $message }}</x-has-error>
            @enderror
        </div>
    </div>
    <div class="flex-1">
        {!! Form::date('start', old('start') ? old('start') : (isset($ad) ? $ad->start : ''), [
            'class' => 'border-1 border-wine focus:border-wine focus:ring-wine rounded-md my-3 w-2/3 block',
            'placeholder' => __('Fecha inicio'),
            'id' => 'textstart',
        ]) !!}

    </div>
</div>

<div class="flex flex-row">
    <div class="flex-1">
        {!! Form::label('end', __('Fecha fin'), ['class' => 'text-2xl font-semibold text-black mb-3']) !!}
        <div>
            @error('end')
                <x-has-error>{{ $message }}</x-has-error>
            @enderror
        </div>
    </div>
    <div class="flex-1">
        {!! Form::date('end', old('end') ? old('end') : (isset($ad) ? $ad->end : ''), [
            'class' => 'border-1 border-wine focus:border-wine focus:ring-wine rounded-md my-3 w-2/3 block',
            'placeholder' => __('Fecha fin'),
            'id' => 'textend',
        ]) !!}
    </div>
</div>

<div class="flex flex-row">
    <div class="flex-1">
        {!! Form::label('sections', __('Secciones'), ['class' => 'text-2xl font-semibold text-black mb-3']) !!}
        <div>
            @error('sections')
                <x-has-error>{{ $message }}</x-has-error>
            @enderror
        </div>
    </div>
    <div class="flex-1">
        <div>
            <label for="home_lateral">
                {!! Form::checkbox('sections[]', 'home_lateral', old('sections') ? in_array('home_lateral', old('sections')) : (isset($ad) ? in_array('home_lateral', $ad->sections) : 0), [
                    'class' => 'bg-gray-dark border-wine text-wine focus:ring-wine mr-2',
                    'id' => 'home_lateral',
                ]) !!}
                Home - barra lateral
            </label>
        </div>
        <div>
            <label for="home_local">
                {!! Form::checkbox('sections[]', 'home_local', old('sections') ? in_array('home_local', old('sections')) : (isset($ad) ? in_array('home_local', $ad->sections) : 0), [
                    'class' => 'bg-gray-dark border-wine text-wine focus:ring-wine mr-2',
                    'id' => 'home_local',
                ]) !!}
                Home - sección local
            </label>
        </div>
        <div>
            <label for="view_category">
                {!! Form::checkbox('sections[]', 'view_category', old('sections') ? in_array('view_category', old('sections')) : (isset($ad) ? in_array('view_category', $ad->sections) : 0), [
                    'class' => 'bg-gray-dark border-wine text-wine focus:ring-wine mr-2',
                    'id' => 'view_category',
                ]) !!}
                Vista - Categorías
            </label>
        </div>

        <div>
            <label for="view_nota_lateral">
                {!! Form::checkbox('sections[]', 'view_nota_lateral', old('sections') ? in_array('view_nota_lateral', old('sections')) : (isset($ad) ? in_array('view_nota_lateral', $ad->sections) : 0), [
                    'class' => 'bg-gray-dark border-wine text-wine focus:ring-wine mr-2',
                    'id' => 'view_nota_lateral',
                ]) !!}
                Vista - Nota - Lateral
            </label>
        </div>
        <div>
            <label for="view_nota_fin">
                {!! Form::checkbox('sections[]', 'view_nota_fin', old('sections') ? in_array('view_nota_fin', old('sections')) : (isset($ad) ? in_array('view_nota_fin', $ad->sections) : 0), [
                    'class' => 'bg-gray-dark border-wine text-wine focus:ring-wine mr-2',
                    'id' => 'view_nota_fin',
                ]) !!}
                Home - Nota -Fin
            </label>
        </div>
    </div>
</div>



@section('jqueryui')
    <script>
        CKEDITOR.replace('body');
        var categorySelect = $(".categoryold").length
        var relatedSelect = $(".relatedold").length


        $(document).ready(function() {
            $("#btnModalImgs").on('click', function() {
                /*
                                $("#uploadButton").on('click', function() {
                                    console.log('click en el boton para subir imagen');
                                    $("#uploadFile").click();
                                })
                */

                $.ajax({
                    url: "{{ route('services.popup_images') }}",
                    type: 'GET',
                    dataType: 'HTML',
                    success: function(data) {
                        $("#contentPop").html(data)
                        getDirectoriesAndImage()
                        console.log('ir por las imagenes y mandar el data al content')
                    }
                })
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

        function actionUploadImage() {

            var formData = new FormData();
            var subida = '';

            formData.append('image', $("#uploadFile")[0].files[0])
            formData.append('_token', $("[name='_token']").val())
            //formData.append('uploadIn', $("[name='_token']").val())
            formData.append('uploadIn', $("#uploadIn").val())

            $form = $("#formUploadImages")
            $.ajax({
                url: '{{ route('services.imagen_upload') }}' + '?' + $form.serialize(),
                'method': 'post',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.success)
                        select_image(data.to, data.img)
                },
                beforeSend: function() {
                    $("#popup_images").html(
                        '<div class="text-blue animate-pulse ml-12 font-semibold" > Subiendo... </div>');
                },
                error: function(error) {

                    if (error.responseJSON.errors.image) {
                        errores = error.responseJSON.errors.image
                        htmlError = '';
                        $.each(error.responseJSON.errors.image, function(v, txt) {
                            htmlError += "<div class='text-red-200 text-xs'>" + txt + "</div>";
                        })
                        $("#upload_errors").append(htmlError)
                    }

                }
            })
        }

        function getDirectoriesAndImage() {
            $.ajax({
                url: "{{ route('services.data') }}",
                type: 'GET',
                dataType: 'JSON',
                success: function(data) {
                    directories_show(data.directories, data.in)
                    images_show(data.images)
                    $("#modalImages").show();
                }
            })
        }

        function update_images(directory) {
            $.ajax({
                url: "{{ route('services.data') }}?directory=" + directory,
                type: 'GET',
                dataType: 'JSON',
                success: function(data) {
                    directories_show(data.directories, data.in)
                    images_show(data.images)
                    $("#modalImages").show();
                },
                error: function() {
                    console.log('error pariente!!');
                }
            })
        }

        function directories_show(directories, inD) {

            var content_directory = "<ul>"
            $.each(directories, function(i, v) {
                content_directory += '<li class="w-full inline md:block ' + (v == inD ? 'bg-gray-dark' :
                        'bg-white') +
                    ' hover:bg-gray-dark cursor-pointer px-3 font-semibold text-sm py-2" onclick="update_images(\'' +
                    v + '\')" >' + v + '</li>'
            })
            content_directory += "</ul>"
            $("#uploadIn").val(inD)
            $("#popup_directories").html(content_directory)
        }

        function images_show(images) {
            content_images = '';
            $.each(images, function(i, v) {
                content_images += '<div class="w-56 h-60 mx-2 border-2 border-gray-light rounded-lg">';
                content_images += '     <div class="bg-gray-light rounded-lg">';
                content_images +=
                    '         <div class=" bg-center bg-contain bg-no-repeat w-52 h-52 p-2 rounded-lg" style="background-image: url(' +
                    v.img_to + ')"></div>';
                content_images += '     </div>';
                content_images += '     <div class="w-full text-center">';
                content_images +=
                    '     <div class="w-1/2 inline cursor-pointer bg-red-200 px-2 py-1 rounded-full text-red-500 hover:text-white hover:bg-red-500">Eliminar</div>';
                content_images +=
                    '     <div class="w-1/2 inline cursor-pointer bg-blue px-2 py-1 rounded-full text-teal-600 hover:text-white hover:bg-teal-600" onclick = "select_image(\'' +
                    v.img_to + '\', \'' + v.img + '\')" >Elegir</div>';
                content_images += '     </div>';
                content_images += '</div>';
            })

            $("#popup_images").html(content_images);
        }

        function select_image(img_to, img) {
            $("#img_category").attr('src', img_to);
            $("#image_principal").val(img);
            $("#image_principal_to").val(img_to);
            $("#modalImages").hide();

        }

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
