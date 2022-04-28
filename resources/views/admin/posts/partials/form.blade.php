<div class="pb-3">
    {!! Form::label('title', __('Encabezado'), ['class' => 'text-2xl font-semibold text-black mb-3']) !!}
    <x-help-form>No mayor de 10 palabras</x-help-form>
    {!! Form::text('title', null, ['class' => 'border-1 border-wine focus:border-wine focus:ring-wine rounded-md my-3 w-2/3 block', 'placeholder' => __('Título de la nota'), 'autofocus']) !!}

    @error('title')
        <span class="text-red-600 text-xs">{{ $message }}</span>
    @enderror
</div>
<div class="pb-3">
    {!! Form::label('body', __('Cuerpo de la nota'), ['class' => 'text-2xl font-semibold text-black mb-3']) !!}
    {!! Form::textarea('body', null, ['id' => 'body', 'class' => 'border-1 border-wine focus:border-wine focus:ring-wine rounded-md my-3 w-2/3 block', 'placeholder' => __('Cuerpo de la nota')]) !!}
    @error('body')
        <span class="text-red-600 text-xs">{{ $message }}</span>
    @enderror
</div>
<div class="pb-3">
    {!! Form::label('description', __('Meta descripción'), ['class' => 'text-2xl font-semibold text-black mb-3']) !!}
    {!! Form::textarea('description', null, ['class' => 'border-1 border-wine focus:border-wine focus:ring-wine rounded-md my-3 w-full block', 'placeholder' => __('Meta description'),  'rows' => '2']) !!}
    @error('description')
        <span class="text-red-600 text-xs">{{ $message }}</span>
    @enderror
</div>
<div class="pb-3">
    {!! Form::label('tags', __('Tags'), ['class' => 'text-2xl font-semibold text-black mb-3']) !!}
    {!! Form::textarea('tags', null, ['class' => 'border-1 border-wine focus:border-wine focus:ring-wine rounded-md my-3 w-full block', 'placeholder' => __('Tags'), 'rows' => '3']) !!}
    @error('tags')
        <span class="text-red-600 text-xs">{{ $message }}</span>
    @enderror
</div>
<div class="pb-3">
    {!! Form::label('keywords', __('keywords'), ['class' => 'text-2xl font-semibold text-black mb-3']) !!}
    {!! Form::textarea('keywords', null, ['class' => 'border-1 border-wine focus:border-wine focus:ring-wine rounded-md my-3 w-full block', 'placeholder' => __('Keywords'), 'rows' => '4']) !!}
    @error('keywords')
        <span class="text-red-600 text-xs">{{ $message }}</span>
    @enderror
</div>
<div class="pb-3">
    {!! Form::label('categories', __('Categorias'), ['class' => 'text-2xl font-semibold text-black mb-3']) !!}
    <div class="grid grid-cols-2 w-full">
        @foreach ($categories as $category)
            <div class="border-2 border-wine rounded-sm py-3">
                <label class="pl-3 my-4 inline cursor-pointer capitalize">
                    {!! Form::checkbox('categories[]', $category->id, null, ['class' => 'bg-gray-dark border-wine text-wine focus:ring-wine mr-2']) !!}
                    {{ $category->nombre }}
                </label>
            </div>
        @endforeach

    </div>
    @error('categories')
        <span class="text-red-600 text-xs">{{ $message }}</span>
    @enderror
</div>
<div class="pb-3">
    {!! Form::label('tags', __('Programación en redes'), ['class' => 'text-2xl font-semibold text-black mb-3']) !!}
    <div class="grid grid-cols-1 w-full">
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
            {!! Form::textarea('social_text', null, ['class' => 'border-1 border-wine focus:border-wine focus:ring-wine rounded-md my-3 w-full block', 'placeholder' => __('Copy'), 'rows' => '4']) !!}
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

<div>{!! Form::file('image_principal', ['id' => 'file', 'class' => 'border-2 border-wine focus:border-wine rounded-md mt-1 block mx-auto', 'placeholder' => __('Imagen principal'), 'accept' => 'image/*']) !!}
    @error('image_principal')
        <small class=" text-red-600">{{ $message }}</small>
    @enderror
</div>
</div>
