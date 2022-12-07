<div class="col-span-6 sm:col-span-4 mt-3">
    {!! Form::text('nombre', null, ['class' => 'border-2 border-wine focus:border-wine rounded-md mt-1 block mx-auto ring-1 ring-wine', 'placeholder' => __('Nombre'), 'autofocus']) !!}

</div>
<div class="col-span-6 sm:col-span-4 mt-3">
    {!! Form::textarea('description', old('description') ? old('description') : (isset($category) ?$category->description:'') , ['class' => 'border-2 border-wine focus:border-wine rounded-md mt-1 block mx-auto ring-1 ring-wine', 'placeholder' => __('Descripción general'), 'row' => 2]) !!}

</div>
<div class="col-span-6 sm:col-span-4 mt-3">
    {!! Form::textarea('description_video', old('description_video') ? old('description_video') : (isset($category) ?$category->description_video:''), ['class' => 'border-2 border-wine focus:border-wine rounded-md mt-1 block mx-auto ring-1 ring-wine', 'placeholder' => __('Descripción para video'), 'row'=>2]) !!}

</div>
<div class="col-span-6 sm:col-span-4 mt-3">
    <input type="hidden" name="orden" value="1">
    <select name="patern_id" id="" class="border-2 border-wine focus:border-wine rounded-md mt-1 block mx-auto ring-wine">
        <option >{{__('Categoría padre')}}</option>
    @foreach ($categories as $cat)
    @if (isset($category) && $category->patern_id == $cat->id)
    <option value="{{$cat->id}}" selected>{{$cat->nombre}}</option> 
        
    @else
    <option value="{{$cat->id}}">{{$cat->nombre}}</option> 
    @endif 
    @endforeach
</select>
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

