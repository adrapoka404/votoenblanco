@props(['active'])

@php
$classes = ($active ?? false)
            ? 'uppercase inline-flex items-center px-1 pt-1 text-2xl font-medium leading-5 focus:outline-none focus:border-indigo-700 transition'
            : 'uppercase inline-flex items-center px-1 pt-1 text-2xl font-medium leading-5 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
