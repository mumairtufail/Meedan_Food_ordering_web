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
            <button @click="mobileOpen = !mobileOpen" class="md:hidden p-2 text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="mobileOpen" 
         x-transition 
         class="md:hidden absolute top-full left-0 w-full bg-white shadow-lg border-t border-gray-100 p-4 flex flex-col gap-4">
        <a href="{{ route('home') }}" class="text-gray-700 font-medium">Home</a>
        <a href="{{ route('deals') }}" class="text-gray-700 font-medium">Deals</a>
        <a href="{{ route('menu') }}" class="text-gray-700 font-medium">Menu</a>
        <a href="{{ route('reservation') }}" class="text-gray-700 font-medium">Reservations</a>
        <a href="{{ route('contact') }}" class="text-gray-700 font-medium">Contact</a>
        <div class="border-t border-gray-100 pt-4 flex flex-col gap-2 font-bold uppercase tracking-widest text-[10px] text-gray-400">
            Powered by Deliverect
        </div>
    </div>
</header>