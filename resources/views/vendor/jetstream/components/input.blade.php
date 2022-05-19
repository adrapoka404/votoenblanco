@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-2 border-red-800 focus:border-red-800 focus:bg-red-200 focus:ring-wine rounded-md']) !!}>
