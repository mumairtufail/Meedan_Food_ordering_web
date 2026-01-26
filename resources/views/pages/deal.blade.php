<x-layouts.app>
    <div class="bg-gray-50 py-12 md:py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <x-page-header 
                :title="$deal->name" 
                titleClass="text-2xl md:text-3xl"
                :breadcrumbs="[
                    ['label' => 'Deals', 'url' => route('deals')],
                    ['label' => $deal->name]
                ]"
            />

            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 mt-8">
                {{-- Deal Hero --}}
                <div class="relative h-64 md:h-80 overflow-hidden">
                    <img src="{{ $deal->image ? asset('storage/' . $deal->image) : 'https://placehold.co/800x600' }}" 
                         alt="{{ $deal->name }}" 
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 text-white">
                        <span class="bg-primary px-3 py-1 rounded-full text-sm font-bold mb-2 inline-block">Limited Time Offer</span>
                        <div class="flex items-baseline gap-2">
                             <span class="text-3xl font-bold">${{ number_format($deal->price, 2) }}</span>
                        </div>
                    </div>
                </div>

                <div class="p-6 md:p-8">
                    <p class="text-gray-600 text-lg mb-8 leading-relaxed">{{ $deal->description }}</p>

                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        What's Included
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                        @foreach($deal->products as $product)
                            <a href="{{ route('product.show', $product) }}" class="flex items-center gap-4 p-4 rounded-xl border border-gray-100 hover:border-primary/30 hover:shadow-md transition-all group bg-gray-50/50 hover:bg-white">
                                <div class="w-16 h-16 rounded-lg overflow-hidden shrink-0 bg-gray-200">
                                    @php
                                        $pImg = $product->images->sortBy('sort_order')->first();
                                    @endphp
                                    <img src="{{ $pImg ? asset('storage/' . $pImg->image_path) : 'https://placehold.co/100' }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 group-hover:text-primary transition-colors">{{ $product->name }}</h4>
                                    <p class="text-sm text-gray-500 line-clamp-1">{{ $product->description }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 border-t border-gray-100 pt-6">
                         <form action="{{ route('cart.add-deal', $deal) }}" method="POST" class="flex-1">
                             @csrf
                             <button type="submit" class="w-full bg-primary text-white font-bold py-4 rounded-xl hover:bg-primary/90 transition-all flex items-center justify-center gap-2 shadow-lg shadow-primary/20">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                                Add Deal to Order
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
