<header x-data="{ scrolled: false, mobileOpen: false }" 
        @scroll.window="scrolled = (window.pageYOffset > 20)"
        class="fixed top-0 w-full z-50 transition-all duration-300"
        :class="scrolled ? 'bg-white shadow-md py-2' : 'bg-transparent py-4'">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            {{-- Logo --}}
            <a href="/" class="flex items-center">
                <x-application-logo class="h-12 md:h-14 w-auto transition-all" />
            </a>

            {{-- Desktop Navigation --}}
            <nav class="hidden md:flex items-center gap-8">
                <a href="{{ route('home') }}" 
                   class="text-sm font-medium transition-colors hover:text-primary {{ request()->routeIs('home') ? 'text-primary' : (isset($scrolled) && $scrolled ? 'text-gray-700' : 'text-gray-800') }}">
                   Home
                </a>
                <a href="{{ route('deals') }}" 
                   class="text-sm font-medium transition-colors hover:text-primary {{ request()->routeIs('deals') ? 'text-primary' : (isset($scrolled) && $scrolled ? 'text-gray-700' : 'text-gray-800') }}">
                   Deals
                </a>
                <a href="{{ route('menu') }}" 
                   class="text-sm font-medium transition-colors hover:text-primary {{ request()->routeIs('menu') ? 'text-primary' : (isset($scrolled) && $scrolled ? 'text-gray-700' : 'text-gray-800') }}">
                   Menu
                </a>
                <a href="{{ route('reservation') }}" 
                   class="text-sm font-medium transition-colors hover:text-primary {{ request()->routeIs('reservation') ? 'text-primary' : (isset($scrolled) && $scrolled ? 'text-gray-700' : 'text-gray-800') }}">
                   Reservations
                </a>
                <a href="{{ route('contact') }}" 
                   class="text-sm font-medium transition-colors hover:text-primary {{ request()->routeIs('contact') ? 'text-primary' : (isset($scrolled) && $scrolled ? 'text-gray-700' : 'text-gray-800') }}">
                   Contact
                </a>
            </nav>

            {{-- Right Side Actions --}}
            <div class="hidden md:flex items-center gap-4">
                 {{-- Cart Button (Disabled for External ordering) --}}
                 {{-- 
                 <button @click="$dispatch('open-cart')" class="relative p-2 text-gray-700 hover:text-primary transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    @if(session()->has('cart_' . auth('customer')->id()) && count(session('cart_' . auth('customer')->id())) > 0)
                        <span class="absolute top-0 right-0 bg-primary text-white text-[10px] font-bold h-4 w-4 flex items-center justify-center rounded-full">
                            {{ count(session('cart_' . auth('customer')->id())) }}
                        </span>
                    @endif
                </button>
                --}}

                <a href="https://medaan-middle-eastern-fusion-cuisine.deliverectdirect.com/pickup/medaan-middle-eastern-fusion-cuisine" 
                   target="_blank"
                   class="px-6 py-2.5 bg-primary text-white text-sm font-bold rounded-full hover:bg-primary/90 transition shadow-lg shadow-primary/20">
                    Order Now
                </a>
            </div>

            {{-- Mobile Menu Button --}}
            <button @click="mobileOpen = !mobileOpen" 
                    class="md:hidden p-2 text-gray-800 bg-white/50 backdrop-blur-sm rounded-lg shadow-sm border border-gray-100 hover:bg-white transition-colors"
                    :class="scrolled ? 'text-gray-900 bg-gray-50' : 'text-gray-800'">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="mobileOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="md:hidden absolute top-full left-0 w-full bg-white shadow-xl border-t border-gray-100 p-4 flex flex-col gap-4 z-50">
        <a href="{{ route('home') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 {{ request()->routeIs('home') ? 'bg-primary/5 text-primary font-bold' : 'text-gray-700 font-medium' }}">
            <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Home
        </a>
        <a href="{{ route('deals') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 {{ request()->routeIs('deals') ? 'bg-primary/5 text-primary font-bold' : 'text-gray-700 font-medium' }}">
            <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
            Deals
        </a>
        <a href="{{ route('menu') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 {{ request()->routeIs('menu') ? 'bg-primary/5 text-primary font-bold' : 'text-gray-700 font-medium' }}">
            <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            Menu
        </a>
        <a href="{{ route('reservation') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 {{ request()->routeIs('reservation') ? 'bg-primary/5 text-primary font-bold' : 'text-gray-700 font-medium' }}">
           <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            Reservations
        </a>
        <a href="{{ route('contact') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 {{ request()->routeIs('contact') ? 'bg-primary/5 text-primary font-bold' : 'text-gray-700 font-medium' }}">
             <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            Contact
        </a>
        
        <div class="border-t border-gray-100 pt-4 flex flex-col gap-3">
             <a href="https://medaan-middle-eastern-fusion-cuisine.deliverectdirect.com/pickup/medaan-middle-eastern-fusion-cuisine" 
                target="_blank"
                class="flex items-center justify-center gap-2 w-full px-6 py-3 bg-primary text-white text-sm font-bold rounded-xl hover:bg-primary/90 transition shadow-lg shadow-primary/20">
                <span>Order Now</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
             </a>
             <div class="text-center">
                 <span class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Powered by Deliverect</span>
             </div>
        </div>
    </div>
</header>