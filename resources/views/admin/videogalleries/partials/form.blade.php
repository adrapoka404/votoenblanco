<div class="pb-3">
    {!! Form::label('name', __('Nombre'), ['class' => 'text-2xl font-semibold text-black mb-3']) !!}
    <x-help-form>No mayor de 50 caracteres</x-help-form>
    {!! Form::text('name', old('name') ? old('name') : (isset($vgallery) ? $vgallery->name : ''), [
        'class' => 'border-1 border-wine focus:border-wine focus:ring-wine rounded-md my-3 w-2/3 block',
        'placeholder' => __('Nobre de video'),
        'autofocus',
        'id' => 'textTitle',
    ]) !!}
    <div><small id="counterTitle" class=" text-xs text-red-500 top-0    ">0 de 50</small></div>
    @error('name')
        <x-has-error>{{ $message }}</x-has-error>
    @enderror
</div>
<div class="pb-3">
    {!! Form::label('url', __('URL'), ['class' => 'text-2xl font-semibold text-black mb-3']) !!}
    {!! Form::text('url', old('url') ? old('url') : (isset($vgallery) ? $vgallery->url : ''), [
        'class' => 'border-1 border-wine focus:border-wine focus:ring-wine rounded-md my-3 w-2/3 block',
        'placeholder' => __('https://www.youtube.com/embed/xPBfBicWHak'),
    ]) !!}
    <x-help-form>{{__("Verifique que la url sea obtenida en la opción de 'compartir->incorporar' de YT")}}</x-help-form>
    @error('url')
        <x-has-error>{{ $message }}</x-has-error>
    @enderror
</div>
<div class="pb-3">
    {!! Form::label('description', __('iFrame del video'), ['class' => 'text-2xl font-semibold text-black mb-3']) !!}
    {!! Form::textarea(
        'description',
        old('description') ? old('description') : (isset($vgallery) ? $vgallery->description : ''),
        [
            'class' => 'border-1 border-wine focus:border-wine focus:ring-wine rounded-md my-3 w-full block',
            'placeholder' => __("<iframe width='208'  src='https://www.youtube.com/embed/xPBfBicWHak' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>"),
            'rows' => '5',
            'id' => 'textDescription',
        ],
    ) !!}
    <div><small id="counterDescription" class=" text-xs text-red-500 top-0">0 de 160</small></div>
    @error('description')
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
            @else
                @if (isset($vgallery))
                    @foreach ($vgallery->related as $oldrelated)
                        <div id="related_selected{{ $oldrelated['id'] }}" class="flex py-2 relatedold">
                            <div class="w-3/4">{{ $oldrelated['title'] }}
                                <input type="hidden" name="related[{{ $oldrelated['id'] }}]"
                                    value="{{ $oldrelated['title'] }}">
                            </div>
                            <div class="cursor-pointer px-3 py-1 rounded-full bg-wine w-1/4 text-white"
                                onclick='quitar_related("related_selected{{ $oldrelated['id'] }}")'>
                                Quitar
                            </div>
                        </div>
                    @endforeach
                @endif
            @endif
        </div>
    </div>
    @error('relateds')
        <span class="text-red-600 text-xs">{{ $message }}</span>
    @enderror
</div>

@section('jqueryui')
    <script>
        var relatedSelect = $(".relatedold").length
        

        $(document).ready(function() {
            $("#textTitle").on('keyup', function() {
                contarTitle()
            })

            $("#textDescription").on('keyup', function() {
                contarDescrition()
            })
            contarTitle()
            contarDescrition()
            
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

            if (hay > 10 && hay < 50) {
                $("#counterDescription").removeClass('text-red-500');
                $("#counterDescription").addClass('text-green');
            } else {
                $("#counterDescription").addClass('text-red-500');
                $("#counterDescription").removeClass('text-green');
            }

            $("#counterDescription").html(hay + ' de ' + 50)
        }

        function contarTitle() {
            hay = $("#textTitle").val().length;

            if (hay > 5 && hay < 50) {
                $("#counterTitle").removeClass('text-red-500');
                $("#counterTitle").addClass('text-green');
            } else {
                $("#counterTitle").addClass('text-red-500');
                $("#counterTitle").removeClass('text-green');
            }

            $("#counterTitle").html(hay + ' de ' + 50)
        }

        function quitar_related(id) {
            $("#" + id).remove()
            isAllRelated()
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
