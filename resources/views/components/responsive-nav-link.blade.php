@props(['active'])

@php
    $classes =
        $active ?? false
            ? // 1. ACTIVE STATE (The page you are currently on)
            // Changed: indigo -> gray/black
            'block w-full ps-3 pe-4 py-2 border-l-4 border-black text-start text-base font-bold text-black bg-gray-100 transition duration-150 ease-in-out'
            : // 2. INACTIVE STATE (Other pages)
            // Changed: text-gray-600 -> text-gray-700, and hover effects
            'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-black hover:bg-gray-50 hover:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
