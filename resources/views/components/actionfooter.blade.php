@props(['active'])

@php
$classes = ($active ?? false)
            ? 'uppercase px-1 pt-4 text-white font-light font-serif tracking-widest'
            : 'uppercase px-1 pt-4 text-white font-light font-serif tracking-widest';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
