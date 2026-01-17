{{-- Announcement Bar (Fixed at very top) --}}
<div x-data="{ show: true }" x-show="show" class="bg-primary text-base text-[11px] md:text-xs font-medium text-center py-2.5 relative z-[60]">
    <div class="max-w-7xl mx-auto px-4 flex items-center justify-center gap-2">
        <span>🔥 Experience the Soul of the Middle East in Calgary.</span>
        <a href="https://www.medaan.ca/menu/" class="underline font-bold hover:text-white/80 transition">Order Now</a>
    </div>
</div>

<header x-data="{ scrolled: false, mobileOpen: false }" 
        @scroll.window="scrolled = (window.pageYOffset > 50)"
        class="sticky top-0 z-50 transition-all duration-300"
        :class="scrolled ? 'bg-base shadow-xl py-3' : 'bg-base/90 py-4'">

    <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8 flex items-center justify-between relative">
        {{-- Logo --}}
        <a href="/" class="flex-shrink-0 relative z-10 block">
           <img src="https://www.medaan.ca/wp-content/uploads/2023/06/mmer.png" alt="Medaan Logo" class="h-12 md:h-14 w-auto object-contain">
        </a>

        {{-- Desktop Menu --}}
        <nav class="hidden lg:flex items-center gap-x-8 absolute left-1/2 transform -translate-x-1/2">
            <x-ui.navbar.item label="Home" href="/" />
            <x-ui.navbar.item label="Full Menu" href="/menu" />
            <x-ui.navbar.item label="About the Soul" href="/about" />
            <x-ui.navbar.item label="Flavor Stories" href="/stories" />
            <x-ui.navbar.item label="Contact Us" href="/contact" />
        </nav>

        {{-- CTA Button --}}
        <div class="hidden lg:flex items-center gap-4">
            <a href="/order" class="bg-primary hover:bg-primary/90 text-base px-6 py-2.5 rounded-full text-sm font-semibold transition-all hover:scale-105 duration-200 shadow-md">
                Get in Touch / Order Online
            </a>
        </div>

        {{-- Mobile Menu Button (Stub) --}}
        <button class="lg:hidden text-primary p-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9h16.5m-16.5 6.75h16.5" />
            </svg>
        </button>
    </div>
</header>
