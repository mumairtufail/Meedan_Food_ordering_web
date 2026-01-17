<section class="py-24 bg-base overflow-hidden" x-data="{ shown: false }" x-intersect.threshold.20="shown = true">
    <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8">
        
        <div class="mb-16 md:flex md:items-end justify-between">
            <div class="max-w-xl">
                 <h4 class="text-sm font-bold uppercase tracking-[0.2em] text-primary/60 mb-2">Crowd Favorites</h4>
                 <h2 class="text-4xl md:text-5xl font-bold text-primary tracking-tight">Signatures.</h2>
            </div>
            <a href="/menu" class="hidden md:inline-block text-primary font-medium hover:underline decoration-2 underlin-offset-4">View All &rarr;</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            {{-- Dish 1: Brisket Bowl --}}
            <div class="group cursor-pointer">
                <div class="relative overflow-hidden rounded-2xl aspect-[4/5] mb-6 bg-primary/5 shadow-sm transition-all duration-500 group-hover:-translate-y-3 group-hover:shadow-2xl">
                    <img src="https://images.pexels.com/photos/5836352/pexels-photo-5836352.jpeg?auto=compress&cs=tinysrgb&w=800" 
                         alt="Smokey Brisket Bowl"
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                         loading="lazy">
                    <div class="absolute inset-0 bg-gradient-to-t from-primary via-primary/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                        <span class="text-base font-semibold text-lg">Order Now →</span>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-primary">Smokey Brisket Bowl</h3>
                <p class="text-primary/60 text-sm mt-2 leading-relaxed">12-hour smoked beef, jasmine rice, garlic sauce. Silence in a bowl.</p>
            </div>

            {{-- Dish 2: Gyro Poutine --}}
             <div class="group cursor-pointer">
                <div class="relative overflow-hidden rounded-2xl aspect-[4/5] mb-6 bg-primary/5 shadow-sm transition-all duration-500 group-hover:-translate-y-3 group-hover:shadow-2xl">
                    <img src="https://images.pexels.com/photos/1893556/pexels-photo-1893556.jpeg?auto=compress&cs=tinysrgb&w=800" 
                         alt="Gyro Poutine"
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                         loading="lazy">
                     <div class="absolute inset-0 bg-gradient-to-t from-primary via-primary/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                        <span class="text-base font-semibold text-lg">Order Now →</span>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-primary">Gyro Poutine</h3>
                <p class="text-primary/60 text-sm mt-2 leading-relaxed">Quebec meets the Middle East. Crispy, savory, unforgettable.</p>
            </div>

            {{-- Dish 3: Mojito --}}
             <div class="group cursor-pointer">
                <div class="relative overflow-hidden rounded-2xl aspect-[4/5] mb-6 bg-primary/5 shadow-sm transition-all duration-500 group-hover:-translate-y-3 group-hover:shadow-2xl">
                    <img src="https://images.pexels.com/photos/4021983/pexels-photo-4021983.jpeg?auto=compress&cs=tinysrgb&w=800" 
                         alt="Mint Mojito"
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                         loading="lazy">
                     <div class="absolute inset-0 bg-gradient-to-t from-primary via-primary/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                        <span class="text-base font-semibold text-lg">Order Now →</span>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-primary">Mint Mojito</h3>
                <p class="text-primary/60 text-sm mt-2 leading-relaxed">Crushed mint, fresh lime, pure cool. A sip of paradise.</p>
            </div>

             {{-- Dish 4: Baklava --}}
             <div class="group cursor-pointer">
                <div class="relative overflow-hidden rounded-2xl aspect-[4/5] mb-6 bg-primary/5 shadow-sm transition-all duration-500 group-hover:-translate-y-3 group-hover:shadow-2xl">
                    <img src="https://images.pexels.com/photos/4553031/pexels-photo-4553031.jpeg?auto=compress&cs=tinysrgb&w=800" 
                         alt="Classic Baklava"
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                         loading="lazy">
                     <div class="absolute inset-0 bg-gradient-to-t from-primary via-primary/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                        <span class="text-base font-semibold text-lg">Order Now →</span>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-primary">Classic Baklava</h3>
                <p class="text-primary/60 text-sm mt-2 leading-relaxed">Layers of history. Honey, nuts, and crisp phyllo pastry.</p>
            </div>
        </div>
        
        <div class="mt-12 text-center md:hidden">
            <a href="/menu" class="text-primary font-medium hover:underline decoration-2 underlin-offset-4">View All &rarr;</a>
        </div>
    </div>
</section>