<x-layouts.app>
    <div class="bg-primary pt-12 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Exclusive Deals</h1>
            <p class="text-xl opacity-90 max-w-2xl mx-auto">Get the best value with our carefully curated meal bundles.</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 pb-24">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($deals as $deal)
                @php
                    $image = $deal->image ? asset('storage/' . $deal->image) : 'https://placehold.co/800x600?text=' . urlencode($deal->name);
                @endphp
                <div class="group bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col h-full border border-primary/5">
                    {{-- Compact Image Header --}}
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ $image }}" alt="{{ $deal->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
                        <div class="absolute bottom-3 left-4">
                            <span class="bg-primary text-white text-sm font-bold px-3 py-1 rounded-full shadow-lg">
                                ${{ number_format($deal->price, 2) }}
                            </span>
                        </div>
                    </div>
                    
                    {{-- Compact Content --}}
                    <div class="p-5 flex-1 flex flex-col">
                        <div class="mb-4 flex-1">
                            <h3 class="text-lg font-bold text-gray-900 mb-1 group-hover:text-primary transition-colors line-clamp-1">{{ $deal->name }}</h3>
                            <p class="text-gray-500 text-xs leading-relaxed line-clamp-2">{{ $deal->description }}</p>
                        </div>
                        
                        @if($deal->products->count() > 0)
                            <div class="mb-4 flex flex-wrap gap-1.5">
                                @foreach($deal->products->take(2) as $product)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-base border border-primary/10 text-primary/70">
                                        {{ $product->name }}
                                    </span>
                                @endforeach
                                @if($deal->products->count() > 2)
                                    <span class="text-[10px] font-bold text-gray-400 mt-0.5 ml-1">+{{ $deal->products->count() - 2 }} more</span>
                                @endif
                            </div>
                        @endif

                        <div class="grid grid-cols-2 gap-2">
                            <a href="https://medaan-middle-eastern-fusion-cuisine.deliverectdirect.com/pickup/medaan-middle-eastern-fusion-cuisine" 
                               target="_blank"
                               class="inline-flex items-center justify-center gap-1.5 bg-primary text-white text-xs font-bold py-3 rounded-xl hover:bg-primary/90 transition-all">
                                <span>Order Now</span>
                            </a>
                            <a href="{{ route('reservation') }}" 
                               class="inline-flex items-center justify-center gap-1.5 bg-base border border-primary/20 text-primary text-xs font-bold py-3 rounded-xl hover:bg-primary/5 transition-all">
                                <span>Reserve</span>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center bg-white rounded-3xl border border-dashed border-primary/10">
                    <p class="text-gray-500 font-medium">No active deals found.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $deals->links() }}
        </div>
    </div>
</x-layouts.app>
