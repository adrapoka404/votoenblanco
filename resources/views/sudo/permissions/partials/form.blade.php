<div class="pb-3">
    {!! Form::label('name', __('Nombre'), ['class' => 'text-2xl font-semibold text-black mb-3']) !!}
    {!! Form::text('name', old('name') ? old('name') : (isset($permission) ? $permission->name : ''), [
        'class' => 'border-1 border-wine focus:border-wine focus:ring-wine rounded-md my-3 w-2/3 block',
        'placeholder' => __('sudo.permissions.index'),
        'autofocus',
    ]) !!}
    @error('name')
        <x-has-error>{{ $message }}</x-has-error>
    @enderror
</div>
