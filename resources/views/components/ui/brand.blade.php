@props(['name' => null, 'href' => '#'])

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'flex items-center gap-3 group w-full ' . ($name ? 'justify-start' : 'justify-center')]) }}>
    @if(isset($logo))
        <div class="text-primary flex items-center justify-center shrink-0">
            {{ $logo }}
        </div>
    @endif
    @if($name)
        <span class="font-bold text-lg text-primary tracking-tight transition-opacity duration-200 group-[:has([data-collapsed]_&)]:hidden">
            {{ $name }}
        </span>
    @endif
</a>
