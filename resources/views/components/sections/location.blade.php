<section class="py-24 bg-white border-t border-primary/5">
    <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
        
        {{-- Map / Image --}}
        <div class="relative h-[400px] w-full rounded-2xl overflow-hidden shadow-lg group">
             {{-- Using a static map image for production feel --}}
             <img src="https://images.unsplash.com/photo-1524661135-423995f22d0b?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 opacity-80 group-hover:opacity-100">
             <div class="absolute inset-0 bg-primary/20 group-hover:bg-transparent transition-colors duration-500"></div>
             
             <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                <div class="bg-base text-primary px-6 py-3 rounded-full font-bold shadow-xl flex items-center gap-2 transform translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                    </svg>
                    View on Maps
                </div>
             </div>
        </div>

        {{-- Location Info --}}
        <div class="space-y-8">
            <h4 class="text-sm font-bold uppercase tracking-[0.2em] text-primary/60">Local Roots</h4>
            <h2 class="text-4xl md:text-5xl font-bold text-primary tracking-tight">Nolan Hill, We Are Here.</h2>
            <p class="text-lg text-primary/70 leading-relaxed">
                Whether you’re a local or visiting from across the city, Medaan is your neighborhood spot for authentic flavor. Validated parking, warm atmosphere, and the best service in Calgary.
            </p>
            
            <div class="flex items-start gap-4 p-6 bg-base rounded-2xl border border-primary/5 hover:border-primary/20 transition-colors">
                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-primary flex-shrink-0 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                    </svg>
                </div>
                <div>
                    <h5 class="font-bold text-primary text-xl">Medaan Restaurant</h5>
                    <p class="text-primary/70 mt-1 font-light">750 Nolan Hill Blvd, NW, Unit 140<br>Calgary, AB T3R1Y1</p>
                    <div class="mt-4 flex gap-4 text-sm font-medium text-primary/80">
                        <span>Mon-Sun: 11am - 10pm</span>
                    </div>
                </div>
            </div>

            <a href="https://maps.google.com" target="_blank" class="inline-block text-primary font-medium hover:underline decoration-2 underlin-offset-4">
                Get Directions &rarr;
            </a>
        </div>

    </div>
</section>