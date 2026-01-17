<section class="py-24 bg-base relative overflow-hidden">
    {{-- Background Map or Abstract --}}
    <div class="absolute inset-0 opacity-5 pointer-events-none" style="background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/e/ec/World_map_blank_without_borders.svg/2000px-World_map_blank_without_borders.svg.png'); background-size: cover; filter: grayscale(100%);"></div>

    <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-16 items-start relative z-10">
        
        {{-- Location Info --}}
        <div class="bg-white p-10 md:p-12 rounded-3xl shadow-xl border border-primary/5">
            <h4 class="text-sm font-bold uppercase tracking-widest text-primary/60 mb-4">Visit Us</h4>
            <h2 class="text-3xl md:text-4xl font-bold text-primary mb-6">Your Favorite Neighborhood Spot in Calgary</h2>
            <p class="text-lg text-primary/70 leading-relaxed mb-8">
                Whether you’re a Nolan Hill local or visiting from across the city, Medaan is ready for you. We serve up fresh, fast Middle Eastern soul food with attitude. Dine in for the comfort, take out for the convenience, or get flavor delivered straight to your door. Culinary excellence is right around the corner.
            </p>
            
            <div class="flex items-start gap-4 mb-8">
                <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center text-primary flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                    </svg>
                </div>
                <div>
                    <h5 class="font-bold text-primary text-xl">Nolan Hill</h5>
                    <p class="text-primary/70 mt-1">750 Nolan Hill Blvd, NW, Unit 140<br>Calgary, AB T3R1Y1</p>
                </div>
            </div>

            <a href="https://maps.google.com" target="_blank" class="w-full block text-center bg-primary text-base px-6 py-4 rounded-xl font-bold hover:bg-primary/90 transition">
                Get Directions / Find Us on Maps
            </a>
        </div>

        {{-- Delivery & Rewards --}}
        <div class="lg:pt-10">
            <h4 class="text-sm font-bold uppercase tracking-widest text-primary/60 mb-4">Convenience</h4>
            <h2 class="text-3xl md:text-4xl font-bold text-primary mb-6">Get Rewarded for Every Crave</h2>
            <p class="text-lg text-primary/70 leading-relaxed mb-10">
                Flavor this good should be easy to get. Order through our delivery partners to earn points and enjoy Medaan from the comfort of your couch. Whether it's a family platter for the crew or a late-night wrap for yourself, we've got you covered.
            </p>

            <div class="grid grid-cols-3 gap-6 opacity-80 grayscale hover:grayscale-0 transition-all duration-500">
                <div class="bg-white p-4 rounded-xl shadow-md flex items-center justify-center aspect-video">
                    {{-- SkipTheDishes Mockup Text --}}
                    <span class="font-bold text-xl text-primary">Skip</span>
                </div>
                <div class="bg-white p-4 rounded-xl shadow-md flex items-center justify-center aspect-video">
                    {{-- UberEats Mockup Text --}}
                     <span class="font-bold text-xl text-primary">Uber<span class="text-green-500">Eats</span></span>
                </div>
                <div class="bg-white p-4 rounded-xl shadow-md flex items-center justify-center aspect-video">
                     {{-- DoorDash Mockup Text --}}
                     <span class="font-bold text-xl text-primary text-red-500">DoorDash</span>
                </div>
            </div>
        </div>
    </div>
</section>
