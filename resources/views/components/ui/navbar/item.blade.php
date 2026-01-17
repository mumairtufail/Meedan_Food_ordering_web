@props(['icon' => null, 'label', 'href'])

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'flex items-center gap-x-1 text-sm font-semibold transition-colors duration-200 ' . (request()->fullUrlIs(url($href)) ? 'text-primary' : 'text-primary/70 hover:text-primary')]) }}>
    @if($icon)
        {{-- Icon Rendering --}}
        <span><!-- {{ $icon }} --></span>
    @endif
    <span>{{ $label }}</span>
    
    @if($attributes->has('hasDropdown'))
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 opacity-50">
        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
    </svg>
    @endif
</a>
