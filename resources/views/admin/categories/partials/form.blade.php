<div class="col-span-6 sm:col-span-4 mt-3">
    {!! Form::text('nombre', null, ['class' => 'border-2 border-wine focus:border-wine rounded-md mt-1 block mx-auto', 'placeholder' => __('Nombre'), 'autofocus']) !!}

</div>
<div class="col-span-6 sm:col-span-4 mt-3">
    <span class=" text-red-500">Remplazar por categoria padre</span>
    {!! Form::text('orden', null, ['class' => 'border-2 border-wine focus:border-wine rounded-md mt-1 block mx-auto', 'placeholder' => __('Orden')]) !!}
</div>
<div class="col-span-6 sm:col-span-4 mt-3 flex">
    <div>
        @if (isset($category) && $category->imagen)
            <img src="{{Storage::url($category->imagen) }}" alt="{{$category->nombre}}" class="w-20" id="img_category"></div>    
        @else
            <img src="{{ asset('img/no_category.jpg') }}" alt="No imagen" class="w-20" id="img_category"></div>
        @endif
        
    <div>{!! Form::file('imagen', ['id' => 'file', 'class' => 'border-2 border-wine focus:border-wine rounded-md mt-1 block mx-auto', 'placeholder' => __('Imagen'), 'accept' => 'image/*']) !!}
    @error('imagen')
        <small class=" text-red-600">{{$message}}</small>
    @enderror
    </div>
</div>
<div class="col-span-6 sm:col-span-4 mt-3">
    {!! Form::select('visible', [__('Desactivado'), __('Activo')], null, ['class' => 'border-2 border-wine focus:border-wine rounded-md mt-1 block mx-auto']) !!}
</div>
@section('js')
    <script>
        document.getElementById("file").addEventListener("change", cambiarImagen);
        console.log('adx');

        function cambiarImagen(event) {
            var file = event.target.files[0];

            var render = new FileReader();
            reader.onload = (event) => {
                document.getElementById('img_category').setAttribute("src", event.taget.result);
            }

            reader.readAsDataURL(file);
        }
    </script>
@endsection
