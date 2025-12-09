@props(['active'])

@php

    // this component for one just common use case: navigation links in a nav bar
    $commonClasses =
        'group relative inline-flex items-center px-2 py-1 text-sm font-medium transition-colors duration-300 ease-in-out focus:outline-none';

    // this one is for active state: Indigo text and bold font
    $activeClasses = 'text-indigo-600 dark:text-black-400 font-bold';

    // 3. Inactive State: Gray text, turns Color on hover
    $inactiveClasses = 'text-gray-800 dark:text-gray-800 ';
@endphp

<a {{ $attributes->class([$commonClasses, $activeClasses => $active, $inactiveClasses => !$active]) }}>
    <!-- The Text -->
    {{ $slot }}

    <!-- The Animated Line -->
    <span
        class="{{ $active ? 'w-full' : 'w-0 group-hover:w-full' }} absolute bottom-0 left-0 h-0.5 rounded-full bg-indigo-600 transition-all duration-300 ease-out dark:bg-indigo-400">
    </span>
</a>
