@props(['title', 'description'])

<div class="bg-base border border-primary/10 rounded-xl p-5 shadow-sm hover:shadow-md transition-shadow duration-300">
    <h3 class="text-primary font-semibold text-lg">{{ $title }}</h3>
    <p class="text-primary/70 text-sm mt-2">{{ $description }}</p>
    {{ $slot }}
</div>
