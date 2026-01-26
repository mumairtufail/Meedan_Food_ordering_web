@props(['href' => '#', 'icon' => null, 'variant' => 'default', 'as' => 'a'])

@php
    $baseClasses = "group flex items-center px-4 py-2 text-sm w-full text-left transition-colors duration-150";
    $variants = [
        'default' => 'text-gray-700 hover:bg-gray-100 hover:text-gray-900',
        'danger' => 'text-red-700 hover:bg-red-50 hover:text-red-900',
    ];
    
    // Icon mapping (simplified - duplicate of navlist/item.blade.php for demo)
    $icons = [
        'home' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />',
        'user-circle' => '<path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />',
        'logout' => '<path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />',
        'adjustments-horizontal' => '<path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />',
    ];
@endphp

@if($as === 'button')
    <button {{ $attributes->merge(['class' => "$baseClasses " . $variants[$variant]]) }}>
         @if($icon)
            <svg class="mr-3 h-5 w-5 opacity-70 group-hover:opacity-100" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                {!! $icons[$icon] ?? '' !!}
            </svg>
        @endif
        {{ $slot }}
    </button>
@else
    <a href="{{ $href }}" {{ $attributes->merge(['class' => "$baseClasses " . $variants[$variant]]) }}>
        @if($icon)
            <svg class="mr-3 h-5 w-5 opacity-70 group-hover:opacity-100" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                {!! $icons[$icon] ?? '' !!}
            </svg>
        @endif
        {{ $slot }}
    </a>
@endif
