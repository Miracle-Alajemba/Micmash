@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent
       text-start text-base font-medium text-black
       md:text-indigo-700 md:bg-indigo-50
       md:group-hover:text-white
       transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent
       text-start text-base font-medium text-black
       md:text-gray-600
       md:hover:text-white
       md:group-hover:text-white
       transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
