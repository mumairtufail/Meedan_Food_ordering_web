<x-layouts.app>
    <div class="bg-base min-h-screen pt-8 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h1 class="text-4xl font-bold text-primary mb-2">Our Menu</h1>
                <p class="text-gray-600 max-w-2xl mx-auto">Authentic flavors prepared with passion.</p>
            </div>
            
            <div class="lg:grid lg:grid-cols-4 lg:gap-8">
                {{-- Sidebar Filters --}}
                <div class="hidden lg:block space-y-8">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 sticky top-24">
                        <h3 class="font-semibold text-gray-900 mb-4 text-lg border-b pb-2">Categories</h3>
                        <ul class="space-y-1">
                             <li>
                                <a href="{{ route('menu') }}" class="block px-3 py-2 rounded-lg text-sm transition-colors {{ !request('category') ? 'bg-primary text-white font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                                    All Items
                                </a>
                            </li>
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('menu', ['category' => $category->slug]) }}" 
                                       class="block px-3 py-2 rounded-lg text-sm transition-colors {{ request('category') == $category->slug ? 'bg-primary text-white font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                {{-- Mobile Categories --}}
                <div class="lg:hidden mb-8 overflow-x-auto pb-2 scrollbar-hide">
                    <div class="flex space-x-2 px-1">
                         <a href="{{ route('menu') }}" class="whitespace-nowrap px-4 py-2 rounded-full text-sm font-medium border transition-colors {{ !request('category') ? 'bg-primary text-white border-primary shadow-md' : 'bg-white border-gray-200 text-gray-700' }}">
                            All
                        </a>
                        @foreach($categories as $category)
                            <a href="{{ route('menu', ['category' => $category->slug]) }}" 
                               class="whitespace-nowrap px-4 py-2 rounded-full text-sm font-medium border transition-colors {{ request('category') == $category->slug ? 'bg-primary text-white border-primary shadow-md' : 'bg-white border-gray-200 text-gray-700' }}">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Product Grid --}}
                <div class="lg:col-span-3">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($products as $product)
                            @php
                                $productImage = $product->images()
                                    ->orderBy('sort_order', 'asc')
                                    ->first();
                                $imageUrl = $productImage ? asset('storage/' . $productImage->image_path) : 'https://placehold.co/600x400';
                                
                                // Prepare data for modal
                                $productData = [
                                    'id' => $product->id,
                                    'name' => $product->name,
                                    'price' => $product->price,
                                    'description' => $product->description,
                                    'image_url' => $imageUrl,
                                    'addons' => $product->addons
                                ];
                            @endphp
                             <div class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col h-full relative" x-data>
                                <div class="relative h-56 overflow-hidden bg-gray-100 cursor-pointer" @click="$dispatch('open-product-modal', {{ json_encode($productData) }})">
                                    <img src="{{ $imageUrl }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full font-bold text-gray-900 shadow-sm border border-gray-100">
                                        ${{ number_format($product->price, 2) }}
                                    </div>
                                </div>
                                <div class="p-5 flex-1 flex flex-col">
                                    <div class="mb-4">
                                        <div class="flex justify-between items-center mb-1">
                                            @if($product->category)
                                                <a href="{{ route('menu', ['category' => $product->category->slug]) }}" class="text-xs font-bold uppercase tracking-wider text-primary opacity-60 hover:opacity-100 transition-opacity">
                                                    {{ $product->category->name }}
                                                </a>
                                            @endif
                                        </div>
                                        <h3 class="text-lg font-bold text-gray-900 mb-2 leading-tight cursor-pointer hover:text-primary transition-colors" @click="$dispatch('open-product-modal', {{ json_encode($productData) }})">{{ $product->name }}</h3>
                                        <p class="text-sm text-gray-500 line-clamp-2 leading-relaxed">{{ $product->description }}</p>
                                    </div>
                                    
                                    <div class="mt-auto">
                                        <button 
                                            @click="$dispatch('open-product-modal', {{ json_encode($productData) }} )"
                                            class="w-full bg-gray-50 text-gray-900 font-bold py-3 rounded-xl hover:bg-primary hover:text-white transition-all flex items-center justify-center gap-2 group-hover:bg-primary group-hover:text-white"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            View Details
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full py-20 text-center bg-white rounded-2xl border border-dashed border-gray-300">
                                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-gray-500 text-lg">No dishes found in this category.</p>
                                <a href="{{ route('menu') }}" class="text-primary hover:underline mt-2 inline-block font-medium">View all items</a>
                            </div>
                        @endforelse
                    </div>
                    
                    <div class="mt-12">
                         {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
