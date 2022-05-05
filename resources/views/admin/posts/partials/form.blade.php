<div class="pb-3">
    {!! Form::label('title', __('Encabezado'), ['class' => 'text-2xl font-semibold text-black mb-3']) !!}
    <x-help-form>No mayor de 10 palabras</x-help-form>
    {!! Form::text('title', null, ['class' => 'border-1 border-wine focus:border-wine focus:ring-wine rounded-md my-3 w-2/3 block', 'placeholder' => __('Título de la nota'), 'autofocus', 'wire:model' => 'title']) !!}

    @error('title')
        <span class="text-red-600 text-xs">{{ $message }}</span>
    @enderror
</div>
<div class="pb-3">
    {!! Form::label('body', __('Cuerpo de la nota'), ['class' => 'text-2xl font-semibold text-black mb-3']) !!}
    {!! Form::textarea('body', null, ['id' => 'body', 'class' => 'border-1 border-wine focus:border-wine focus:ring-wine rounded-md my-3 w-full block', 'placeholder' => __('Cuerpo de la nota'), 'wire:model' => 'body']) !!}
    @error('body')
        <span class="text-red-600 text-xs">{{ $message }}</span>
    @enderror
</div>
<div class="pb-3">
    {!! Form::label('description', __('Meta descripción'), ['class' => 'text-2xl font-semibold text-black mb-3']) !!}
    {!! Form::textarea('description', null, ['class' => 'border-1 border-wine focus:border-wine focus:ring-wine rounded-md my-3 w-full block', 'placeholder' => __('Meta description'), 'rows' => '2']) !!}
    @error('description')
        <span class="text-red-600 text-xs">{{ $message }}</span>
    @enderror
</div>
<div class="pb-3">
    {!! Form::label('tags', __('Tags'), ['class' => 'text-2xl font-semibold text-black mb-3']) !!}
    {!! Form::textarea('tags', null, ['class' => 'border-1 border-wine focus:border-wine focus:ring-wine rounded-md my-3 w-full block', 'placeholder' => __('Tags'), 'rows' => '2']) !!}
    @error('tags')
        <span class="text-red-600 text-xs">{{ $message }}</span>
    @enderror
</div>
<div class="pb-3">
    {!! Form::label('keywords', __('keywords'), ['class' => 'text-2xl font-semibold text-black mb-3']) !!}
    {!! Form::textarea('keywords', null, ['class' => 'border-1 border-wine focus:border-wine focus:ring-wine rounded-md my-3 w-full block', 'placeholder' => __('Keywords'), 'rows' => '2']) !!}
    @error('keywords')
        <span class="text-red-600 text-xs">{{ $message }}</span>
    @enderror
</div>
<div class="pb-3">

    {!! Form::label('categories', __('Categorias'), ['class' => 'text-2xl font-semibold text-black mb-3']) !!}
    <div class="grid grid-cols-1 w-full">
        <input wire:model='buscar' wire:keydown.enter="asignarPrimero()" type="text" id="buscar"
            class="border-1 border-wine focus:border-wine focus:ring-wine rounded-md my-3 w-1/2 block  @if (count($selected) == 3) bg-gray  @endif"
            @if (count($selected) == 3) 
            disabled placeholder="Máximo tres categorías relacionadas" @endif>
        @error('buscar')
            <small class="form-text text-red-500">{{ $message }}</small>
        @else
            @if (count($categories) > 0)
                @if (!$picked)
                    <div class="shadow rounded px-3 pt-3 pb-0">
                        @foreach ($categories as $category)
                            <div style="cursor: pointer;">
                                <a wire:click="asignarCategory('{{ $category->id }}')">
                                    {{ $category->nombre }}
                                </a>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                @endif
            @else
                <small class="form-text text-muted">Comienza a teclear para que aparezcan los resultados</small>
            @endif
        @enderror


    </div>
    <div class="w-full">
        @foreach ($selected as $select)
            <div class="grid grid-cols-2  my-2 py-2 shadow-md shadow-gray-dark">
                <div class="ml-3">
                    {{ $select['nombre'] }}
                </div>
                <div class=" text-right mr-3">
                    {!! Form::hidden('categories[]', $select['id'], []) !!}
                    <a wire:click="quitarCategory('{{ $select['id'] }}')"
                        class="cursor-pointer bg-red-500 rounded-full ml-2 px-2 font-black text-white">-</a>
                </div>
            </div>
        @endforeach
    </div>
    @error('categories')
        <span class="text-red-600 text-xs">{{ $message }}</span>
    @enderror
</div>

<div class="pb-3">

    {!! Form::label('relate', __('Relacionadas'), ['class' => 'text-2xl font-semibold text-black mb-3']) !!}
    <div class="grid grid-cols-1 w-full">
        <input wire:model='buscapost' wire:keydown.enter="asignarPost()" type="text" id="buscapost"
            class="border-1 border-wine focus:border-wine focus:ring-wine rounded-md my-3 w-1/2 block"
            @if (count($selectedpost) == 3) disabled @endif>
        @error('buscapost')
            <small class="form-text text-red-500">{{ $message }}</small>
        @else
            @if (count($posts) > 0)
                @if (!$picked2)
                    <div class="shadow rounded px-3 pt-3 pb-0">
                        @foreach ($posts as $related)
                            <div style="cursor: pointer;">
                                {!! Form::hidden('related[]', $related->id) !!}
                                <a wire:click="asignarPosts('{{ $related->id }}')">
                                    {{ $related->title }}
                                </a>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                @endif
            @else
                <small class="form-text text-muted">Comienza a teclear para que aparezcan los resultados</small>
            @endif
        @enderror


    </div>
    <div class="w-full">
        @foreach ($selectedpost as $select)
            <div class="grid grid-cols-1  my-2 py-2 shadow-md shadow-gray-dark">
                <div class="ml-3">
                    {{ $select['title'] }}
                </div>
                <div class=" text-right mr-3">
                    {!! Form::hidden('related[]', $select['id'], []) !!}
                    <a wire:click="quitarPost('{{ $select['id'] }}')"
                        class="cursor-pointer bg-red-500 rounded-full ml-2 px-2 font-black text-white">-</a>
                </div>
            </div>
        @endforeach
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
            {!! Form::textarea('social_text', null, ['class' => 'border-1 border-wine focus:border-wine focus:ring-wine rounded-md my-3 w-full block', 'placeholder' => __('Copy'), 'rows' => '2']) !!}
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
