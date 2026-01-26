<img {{ $attributes->merge(['class' => 'h-10 w-auto max-w-full object-contain mx-auto']) }} 
     src="{{ $settings['site_logo'] ?? 'https://deliverect.imgix.net/static/9ecd49df-d109-4bbf-b472-0cb96ad459e0/assets/image-1748157162.png?w=1100&fit=crop&crop=top&auto=compress,format&cs=srgb' }}" 
     alt="{{ config('app.name', 'Meedan') }} Logo">
