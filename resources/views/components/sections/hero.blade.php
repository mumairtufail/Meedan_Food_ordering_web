<section class="relative w-full min-h-screen overflow-hidden">
    <!-- Swiper -->
    <div class="swiper heroSwiper w-full h-screen">
        <div class="swiper-wrapper">
            @for($i = 1; $i <= 3; $i++)
            {{-- Slide {{ $i }} --}}
            <div class="swiper-slide relative">
                <img src="{{ $settings['hero_slide_'.$i.'_image'] }}" 
                     alt="Hero Slide {{ $i }}" 
                     class="absolute inset-0 w-full h-full object-cover scale-105 transition-transform duration-[12s] ease-out">
                <div class="absolute inset-0 bg-black/40"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-black/30 opacity-90"></div>
                
                <div class="absolute inset-0 flex items-center justify-center text-center p-8">
                    <div class="max-w-5xl space-y-8">
                        @if($settings['hero_slide_'.$i.'_badge'])
                        <span class="inline-block px-4 py-1.5 bg-base/10 backdrop-blur-sm text-base text-sm font-medium rounded-full border border-base/20 opacity-0 banner-badge">
                            {!! $settings['hero_slide_'.$i.'_badge'] !!}
                        </span>
                        @endif
                        <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-bold text-base tracking-tight leading-[1.05] opacity-0 banner-title">
                            {!! $settings['hero_slide_'.$i.'_title'] !!}
                        </h1>
                        <p class="text-lg md:text-xl lg:text-2xl font-light text-base/80 max-w-2xl mx-auto leading-relaxed opacity-0 banner-subtitle">
                            {{ $settings['hero_slide_'.$i.'_subtitle'] }}
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center opacity-0 banner-btn">
                            <a href="{{ route('menu') }}" class="inline-flex items-center gap-2 bg-base text-primary px-8 py-4 rounded-full font-semibold text-lg hover:scale-105 hover:shadow-2xl transition-all duration-300">
                                Explore Menu
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                            <a href="https://medaan-middle-eastern-fusion-cuisine.deliverectdirect.com/pickup/medaan-middle-eastern-fusion-cuisine" target="_blank" class="inline-flex items-center gap-2 bg-transparent border-2 border-base/50 text-base px-8 py-4 rounded-full font-medium text-lg hover:bg-base/10 hover:border-base transition-all duration-300">
                                Order Online
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endfor
        </div>
        
        {{-- Navigation --}}
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-20 flex items-center gap-6">
            <div class="swiper-pagination-custom flex gap-2"></div>
        </div>
        
        <div class="hidden lg:flex swiper-button-next !text-base !w-14 !h-14 !bg-white/10 !backdrop-blur-sm !rounded-full after:!text-xl hover:!bg-white/20 transition-all !right-8"></div>
        <div class="hidden lg:flex swiper-button-prev !text-base !w-14 !h-14 !bg-white/10 !backdrop-blur-sm !rounded-full after:!text-xl hover:!bg-white/20 transition-all !left-8"></div>
        
        {{-- Scroll Indicator --}}
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 hidden md:flex flex-col items-center gap-2 text-base/50 text-xs text-white">
            <span class="tracking-widest uppercase">Scroll</span>
            <div class="w-px h-8 bg-base/30 animate-pulse"></div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Swiper(".heroSwiper", {
            speed: 1200,
            loop: true,
            autoplay: {
                delay: 7000,
                disableOnInteraction: false,
            },
            effect: "fade",
            fadeEffect: { crossFade: true },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            pagination: {
                el: ".swiper-pagination-custom",
                clickable: true,
                bulletClass: "w-2 h-2 rounded-full bg-base/30 cursor-pointer transition-all duration-300",
                bulletActiveClass: "!w-8 !bg-base",
            },
            on: {
                slideChangeTransitionStart: function() {
                    // Trigger zoom effect on active slide image
                    document.querySelectorAll('.swiper-slide img').forEach(img => {
                        img.style.transform = 'scale(1.05)';
                    });
                    document.querySelector('.swiper-slide-active img').style.transform = 'scale(1.15)';
                }
            }
        });
    });
</script>

<style>
    /* Keyframe for fade-up */
    @keyframes fade-up {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    /* Trigger Animations on Active Slide */
    .swiper-slide-active .banner-badge {
        animation: fade-up 0.6s ease-out forwards 0.2s;
    }
    .swiper-slide-active .banner-title {
        animation: fade-up 0.8s ease-out forwards 0.4s;
    }
    .swiper-slide-active .banner-subtitle {
        animation: fade-up 0.8s ease-out forwards 0.6s;
    }
    .swiper-slide-active .banner-btn {
        animation: fade-up 0.8s ease-out forwards 0.8s;
    }
    
    /* Revert for non-active slides */
    .swiper-slide:not(.swiper-slide-active) .banner-badge,
    .swiper-slide:not(.swiper-slide-active) .banner-title,
    .swiper-slide:not(.swiper-slide-active) .banner-subtitle,
    .swiper-slide:not(.swiper-slide-active) .banner-btn {
        opacity: 0;
        transform: translateY(30px);
    }
</style>