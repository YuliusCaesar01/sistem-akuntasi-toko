@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-4 py-2 bg-gray-100 border-l-4 border-blue-500 text-gray-900 font-medium leading-5 text-sm focus:outline-none transition'
            : 'inline-flex items-center px-4 py-2 border-l-4 border-transparent text-gray-600 font-medium leading-5 text-sm hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:bg-gray-50 focus:border-gray-300 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
