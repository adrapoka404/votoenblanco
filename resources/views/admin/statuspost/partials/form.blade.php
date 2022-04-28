<div class="col-span-6 sm:col-span-4 mt-3">
    {!! Form::text('name', null, ["class" => "border-2 border-wine focus:border-wine rounded-md mt-1 block mx-auto", "placeholder" => __('Nombre'), "autofocus"]) !!}
</div>

<div class="col-span-6 sm:col-span-4 mt-3">
    {!! Form::text('description', null, ["class" => "border-2 border-wine focus:border-wine rounded-md mt-1 block mx-auto", "placeholder" => __('Descripción')]) !!}
</div>
<div class="col-span-6 sm:col-span-4 mt-3">
    {!! Form::select('status', [__('Desactivado'),  __('Activo')], null, ["class" => "border-2 border-wine focus:border-wine rounded-md mt-1 block mx-auto"]) !!}
</div>
