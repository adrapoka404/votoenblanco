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
<div class="flex flex-col my-5">
    <div class="flex-1">
        <span class=" text-blue text-xs">
            A continuación debe agregar una imagen que será visible en las diferentes secciones del sitio web. 
            <br>
            Si no desea que la publicidad sea visible en alguna sección bastará con dejar el campo vacio. 
            <br>
            ¡¡¡Fierroo!!!
        </span>
    </div>
</div>
<div class="flex flex-row">
    <div class="flex-1">
        {!! Form::label('add[local]', __('Sección local del home'), ['class' => 'text-2xl font-semibold text-black mb-3 w-full']) !!}
        <div>
            <span class=" text-blue text-xs">Si desea que la publicidad sea visible en la sección local del home. Agregue una imagen de 600px * 600px</span>
            @error('add.local')
                <span class="text-red-600 text-xs">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="flex-1">
        {!! Form::file('add[local]', ['id' => 'file_add_local', 'class' => 'border-2 border-wine focus:border-wine rounded-md mt-1 block mx-auto', 'placeholder' => __('Sección local del home'), 'accept' => 'image/*']) !!}
    </div>
</div>
<div class="flex flex-row">
    <div class="flex-1">
        {!! Form::label('add[hlateral]', __('Sección lateral del home'), ['class' => 'text-2xl font-semibold text-black mb-3 w-full']) !!}
        <div>
            <span class=" text-blue text-xs">Si desea que la publicidad sea visible en la sección lateral del home. Agregue una imagen de 400px * 700px</span>
            @error('add.hlateral')
                <span class="text-red-600 text-xs">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="flex-1">
        {!! Form::file('add[hlateral]', ['id' => 'file_add_hlateral', 'class' => 'border-2 border-wine focus:border-wine rounded-md mt-1 block mx-auto', 'placeholder' => __('Sección lateral del home'), 'accept' => 'image/*']) !!}
    </div>
</div>
<div class="flex flex-row">
    <div class="flex-1">
        {!! Form::label('add[category]', __('Sección de categorías'), ['class' => 'text-2xl font-semibold text-black mb-3 w-full']) !!}
        <div>
            <span class=" text-blue text-xs">Si desea que la publicidad sea visible en la sección de categorías. Agregue una imagen de 900px * 200px</span>
            @error('add.category')
                <span class="text-red-600 text-xs">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="flex-1">
        {!! Form::file('add[category]', ['id' => 'file_add_category', 'class' => 'border-2 border-wine focus:border-wine rounded-md mt-1 block mx-auto', 'placeholder' => __('Sección de categoría'), 'accept' => 'image/*']) !!}
    </div>
</div>
<div class="flex flex-row">
    <div class="flex-1">
        {!! Form::label('add[postbody]', __('Sección cuerpo de nota'), ['class' => 'text-2xl font-semibold text-black mb-3 w-full']) !!}
        <div>
            <span class=" text-blue text-xs">Si desea que la publicidad sea visible despues del cuerpo de la nota. Agregue una imagen de 1400px * 400px</span>
            @error('add.postbody')
                <span class="text-red-600 text-xs">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="flex-1">
        {!! Form::file('add[postbody]', ['id' => 'file_add_postbody', 'class' => 'border-2 border-wine focus:border-wine rounded-md mt-1 block mx-auto', 'placeholder' => __('Sección final de nota'), 'accept' => 'image/*']) !!}
    </div>
</div>

<div class="flex flex-row">
    <div class="flex-1">
        {!! Form::label('add[postlateral]', __('Sección lateral de nota'), ['class' => 'text-2xl font-semibold text-black mb-3 w-full']) !!}
        <div>
            <span class=" text-blue text-xs">Si desea que la publicidad sea visible en la barra lateral de la nota. Agregue una imagen de 400px * 700px</span>
            @error('add.postlateral')
                <span class="text-red-600 text-xs">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="flex-1">
        {!! Form::file('add[postlateral]', ['id' => 'file_add_postlateral', 'class' => 'border-2 border-wine focus:border-wine rounded-md mt-1 block mx-auto', 'placeholder' => __('Sección lateral de nota'), 'accept' => 'image/*']) !!}
    </div>
</div>
