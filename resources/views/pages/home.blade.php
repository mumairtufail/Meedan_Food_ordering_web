
<x-layouts.app>
   {{-- 1. Hero / Carousel --}}
   <x-sections.hero />

   {{-- 2. Menu Highlights --}}
   <x-sections.menu-highlights :categories="$categories" />

   {{-- 3. Signature Dishes --}}
   <x-sections.signature-dishes :products="$products" />

   {{-- 4. Mission / Story --}}
   <x-sections.mission />

   {{-- 5. Location --}}
   <x-sections.location />

   {{-- 6. Delivery Partners --}}
   <x-sections.delivery />

   {{-- 7. Marquee --}}
   <x-sections.marquee />

   {{-- 8. Newsletter --}}
   <x-sections.newsletter />
</x-layouts.app>
