<x-layouts.app>
    <div class="bg-white py-12 md:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <x-page-header 
                :title="$product->name" 
                :description="$product->category->name"
                :breadcrumbs="[
                    ['label' => 'Menu', 'url' => route('menu')],
                    ['label' => $product->name]
                ]"
            />

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 mt-8">
                
                {{-- Left Column: Images --}}
                <div class="space-y-4" x-data="{ activeImage: '{{ $product->images->sortBy('sort_order')->first() ? asset('storage/' . $product->images->sortBy('sort_order')->first()->image_path) : asset('storage/products/default.jpg') }}' }">
                    {{-- Main Image --}}
                    <div class="aspect-square bg-gray-50 rounded-2xl overflow-hidden border border-gray-100 relative group">
                        <img :src="activeImage" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    </div>

                    {{-- Thumbnails --}}
                    @if($product->images->count() > 1)
                        <div class="grid grid-cols-4 sm:grid-cols-5 gap-4">
                            @foreach($product->images->sortBy('sort_order') as $image)
                                <button 
                                    @click="activeImage = '{{ asset('storage/' . $image->image_path) }}'" 
                                    class="aspect-square rounded-xl overflow-hidden border-2 transition-all hover:border-primary focus:border-primary focus:outline-none"
                                    :class="activeImage === '{{ asset('storage/' . $image->image_path) }}' ? 'border-primary ring-2 ring-primary/20' : 'border-transparent ring-1 ring-gray-100'"
                                >
                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Right Column: Details --}}
                <div class="flex flex-col">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>
                    <div class="flex items-center gap-4 mb-6">
                        <p class="text-2xl font-bold text-primary">${{ number_format($product->price, 2) }}</p>
                        @if($product->category)
                            <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm font-medium">
                                {{ $product->category->name }}
                            </span>
                        @endif
                    </div>

                    <div class="prose prose-gray max-w-none text-gray-600 mb-8">
                        <p>{{ $product->description }}</p>
                    </div>

                    <form action="{{ route('cart.add') }}" method="POST" class="space-y-8 mt-auto">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        @if($product->addons->isNotEmpty())
                            <div class="border-t border-gray-100 pt-8">
                                <h3 class="text-lg font-bold text-gray-900 mb-4">Customize your order</h3>
                                <div class="space-y-3">
                                    @foreach($product->addons as $addon)
                                        <label class="flex items-center justify-between p-4 bg-gray-50 rounded-xl cursor-pointer hover:bg-gray-100 transition-colors border border-transparent hover:border-gray-200">
                                            <div class="flex items-center">
                                                <input type="checkbox" name="addons[]" value="{{ $addon->id }}" class="w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary">
                                                <span class="ml-3 font-medium text-gray-900">{{ $addon->name }}</span>
                                            </div>
                                            <span class="text-gray-600 font-medium">+${{ number_format($addon->price, 2) }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Action Buttons --}}
                        <div class="flex flex-col sm:flex-row gap-4 pt-4 border-t border-gray-100">
                             {{-- Quantity --}}
                            <div class="flex items-center border border-gray-200 rounded-xl w-32" x-data="{ qty: 1 }">
                                <button type="button" @click="qty > 1 ? qty-- : null" class="w-10 h-10 flex items-center justify-center text-gray-500 hover:text-primary transition-colors hover:bg-gray-50 rounded-l-xl">-</button>
                                <input type="number" name="quantity" x-model="qty" class="w-12 h-10 text-center border-none text-gray-900 font-bold focus:ring-0 p-0" min="1">
                                <button type="button" @click="qty++" class="w-10 h-10 flex items-center justify-center text-gray-500 hover:text-primary transition-colors hover:bg-gray-50 rounded-r-xl">+</button>
                            </div>

                            <button type="submit" class="flex-1 bg-primary text-white font-bold py-3.5 px-8 rounded-xl hover:bg-primary/90 transition-all flex items-center justify-center gap-2 shadow-lg shadow-primary/20 hover:-translate-y-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                                Add to Order
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Related Products --}}
            @if($relatedProducts->isNotEmpty())
                <div class="mt-24 border-t border-gray-100 pt-16">
                    <h2 class="text-2xl font-bold text-gray-900 mb-8">You might also like</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                        @foreach($relatedProducts as $related)
                            <a href="{{ route('product.show', $related) }}" class="group block">
                                <div class="aspect-[4/5] bg-gray-50 rounded-2xl overflow-hidden mb-4 relative">
                                    @php
                                        $relImage = $related->images->sortBy('sort_order')->first();
                                        $relImgSrc = $relImage ? asset('storage/' . $relImage->image_path) : asset('storage/products/default.jpg');
                                    @endphp
                                    <img src="{{ $relImgSrc }}" alt="{{ $related->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                </div>
                                <h3 class="font-bold text-gray-900 group-hover:text-primary transition-colors">{{ $related->name }}</h3>
                                <p class="text-gray-500">${{ number_format($related->price, 2) }}</p>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-layouts.app>
