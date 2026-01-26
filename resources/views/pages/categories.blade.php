<x-layouts.app>
    <div class="bg-base min-h-screen pt-8 pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h4 class="text-sm font-bold uppercase tracking-[0.2em] text-primary/60 mb-2">The Medaan Standard</h4>
                <h1 class="text-4xl md:text-5xl font-bold text-primary tracking-tight mb-6">Explore Our Categories.</h1>
                <p class="text-lg text-primary/70 leading-relaxed max-w-2xl mx-auto">
                    From bold wraps to soul-warming bowls, discover the flavors that define us.
                </p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($categories as $category)
                    <a href="{{ route('menu', ['category' => $category->slug]) }}" class="group relative flex flex-col bg-white rounded-2xl border border-primary/5 hover:border-primary/20 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 overflow-hidden shadow-sm">
                        <div class="w-full aspect-[4/3] overflow-hidden relative">
                            <img src="{{ $category->image ? asset('storage/' . $category->image) : 'https://placehold.co/600x400?text=' . $category->name }}" 
                                 alt="{{ $category->name }}"
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-primary/20 to-transparent opacity-60 group-hover:opacity-40 transition-opacity"></div>
                            
                            <div class="absolute bottom-6 left-6 right-6">
                                <h3 class="text-2xl font-bold text-white mb-1">{{ $category->name }}</h3>
                                <p class="text-white/80 text-sm line-clamp-1">{{ $category->description ?? 'Explore ' . $category->name }}</p>
                            </div>
                        </div>
                        <div class="p-6 flex items-center justify-between bg-white">
                            <span class="text-primary font-semibold">View Menu</span>
                            <div class="w-10 h-10 rounded-full bg-primary/5 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-layouts.app>
