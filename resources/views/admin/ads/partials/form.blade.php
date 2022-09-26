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
        {!! Form::label('body', __('Publicidad Vista LG'), ['class' => 'text-2xl font-semibold text-black mb-3 w-full']) !!}
        <div>
            @error('body')
                <span class="text-red-600 text-xs">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="flex-1">
        {!! Form::file('body', ['id' => 'file', 'class' => 'border-2 border-wine focus:border-wine rounded-md mt-1 block mx-auto', 'placeholder' => __('Publicidad tamaño LG'), 'accept' => 'image/*']) !!}
    </div>
</div>
<div class="flex flex-row">
    <div class="flex-1">
        {!! Form::label('body_2', __('Publicidad Vista MD'), ['class' => 'text-2xl font-semibold text-black mb-3 w-full']) !!}
        <div>
            @error('body_2')
                <span class="text-red-600 text-xs">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="flex-1">
        {!! Form::file('body_2', ['id' => 'file_2', 'class' => 'border-2 border-wine focus:border-wine rounded-md mt-1 block mx-auto', 'placeholder' => __('Publicidad tamaño MD'), 'accept' => 'image/*']) !!}
    </div>
</div>
<div class="flex flex-row">
    <div class="flex-1">
        {!! Form::label('body_3', __('Publicidad Vista SM'), ['class' => 'text-2xl font-semibold text-black mb-3 w-full']) !!}
        <div>
            @error('body_3')
                <span class="text-red-600 text-xs">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="flex-1">
        {!! Form::file('body_3', ['id' => 'file_3', 'class' => 'border-2 border-wine focus:border-wine rounded-md mt-1 block mx-auto', 'placeholder' => __('Publicidad tamaño SM'), 'accept' => 'image/*']) !!}
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