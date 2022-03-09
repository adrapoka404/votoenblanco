@props(['active'])

@php
$classes = ($active ?? false)
            ? 'uppercase px-1 pt-4 text-white '
            : 'uppercase px-1 pt-4 text-white ';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
