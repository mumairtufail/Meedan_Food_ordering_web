<section class="py-24 bg-base overflow-hidden" x-data="{ shown: false }" x-intersect.threshold.20="shown = true">
    <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8">
        
        <div class="mb-16 md:flex md:items-end justify-between">
            <div class="max-w-xl">
                 <h4 class="text-sm font-bold uppercase tracking-[0.2em] text-primary/60 mb-2">Crowd Favorites</h4>
                 <h2 class="text-4xl md:text-5xl font-bold text-primary tracking-tight">Signatures.</h2>
            </div>
            <a href="{{ route('menu') }}" class="hidden md:inline-block text-primary font-medium hover:underline decoration-2 underlin-offset-4">View All &rarr;</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($products as $product)
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
                <div class="group cursor-pointer" @click="$dispatch('open-product-modal', {{ json_encode($productData) }})">
                    <div class="relative overflow-hidden rounded-2xl aspect-[4/5] mb-6 bg-primary/5 shadow-sm transition-all duration-500 group-hover:-translate-y-3 group-hover:shadow-2xl">
                        <img src="{{ $imageUrl }}" 
                             alt="{{ $product->name }}"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                             loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-primary via-primary/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                            <span class="text-base font-semibold text-lg text-white">View Details →</span>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-primary">{{ $product->name }}</h3>
                    <p class="text-primary/60 text-sm mt-2 leading-relaxed line-clamp-2">{{ $product->description }}</p>
                </div>
            @endforeach
        </div>
        
        <div class="mt-12 text-center md:hidden">
            <a href="/menu" class="text-primary font-medium hover:underline decoration-2 underlin-offset-4">View All &rarr;</a>
        </div>
    </div>
</section>