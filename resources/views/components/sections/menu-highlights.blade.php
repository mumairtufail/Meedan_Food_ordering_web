<section class="py-24 bg-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8">
        
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto mb-20 space-y-6">
            <h4 class="text-sm font-bold uppercase tracking-[0.2em] text-primary/60">The Medaan Standard</h4>
            <h2 class="text-4xl md:text-5xl font-bold text-primary tracking-tight">Bold Flavors. Zero Compromise.</h2>
            <p class="text-lg text-primary/70 leading-relaxed max-w-2xl mx-auto">
                We don’t play it safe. Every bite is packed with bold spices, fresh ingredients, and a fusion that dares to be different.
            </p>
        </div>

        {{-- Categories Grid --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 lg:gap-8">
            @foreach($categories as $category)
                <a href="{{ route('menu', ['category' => $category->slug]) }}" class="group relative flex flex-col items-center justify-center p-6 bg-base rounded-xl border border-primary/5 hover:border-primary/20 hover:shadow-xl transition-all duration-500 hover:-translate-y-2 overflow-hidden">
                    <div class="w-full aspect-square mb-6 rounded-lg overflow-hidden relative">
                        <img src="{{ $category->image ? asset('storage/' . $category->image) : 'https://placehold.co/400x400?text=' . $category->name }}" 
                             alt="{{ $category->name }}"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-primary/10 group-hover:bg-transparent transition-colors"></div>
                    </div>
                    <h3 class="text-xl font-semibold text-primary mb-2 text-center">{{ $category->name }}</h3>
                    <span class="text-sm text-primary/50 group-hover:text-primary/80 transition-colors">See Options &rarr;</span>
                </a>
            @endforeach
        </div>

        {{-- Strong CTA --}}
             {{-- Strong CTA --}}
        <div class="mt-16 text-center">
            <a href="{{ route('categories') }}" class="group inline-flex items-center justify-center gap-4 bg-primary text-base px-16 py-6 rounded-2xl font-semibold shadow-lg hover:shadow-2xl hover:shadow-primary/30 hover:scale-105 transition-all duration-300 overflow-hidden relative">
                <span class="relative z-10">Explore All Categories</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="relative z-10 w-5 h-5 transition-transform duration-300 group-hover:translate-x-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                </svg>
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
            </a>
        </div>
    </div>
</section>