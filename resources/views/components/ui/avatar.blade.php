@props(['src', 'size' => 'md', 'circle' => false])
<img src="{{ $src }}" class="{{ $circle ? 'rounded-full' : 'rounded-lg' }} {{ $size === 'sm' ? 'w-8 h-8' : 'w-10 h-10' }} object-cover border border-primary/10">
