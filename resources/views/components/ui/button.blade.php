@props(['variant' => 'primary'])

@php
$classes = $variant === 'primary'
    ? 'bg-primary text-base hover:bg-primary/90'
    : 'border border-primary text-primary hover:bg-primary hover:text-base';
@endphp

<button {{ $attributes->merge(['class' => "$classes px-4 py-2 rounded-lg transition duration-200 font-medium"]) }}>
    {{ $slot }}
</button>
