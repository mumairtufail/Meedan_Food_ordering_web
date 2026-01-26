<x-app-layout>
    <x-page-header 
        :title="$deal->exists ? 'Edit Deal' : 'Create Deal'"
        :description="$deal->exists ? 'Update deal details.' : 'Add a new deal or combo.'"
        :breadcrumbs="[
            ['label' => 'Deals', 'url' => route('deals.index')],
            ['label' => $deal->exists ? 'Edit' : 'Create']
        ]"
    />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <form action="{{ $deal->exists ? route('deals.update', $deal) : route('deals.store') }}" method="POST" enctype="multipart/form-data" x-data="{ loading: false }" @submit="loading = true">
            @csrf
            @if($deal->exists)
                @method('PUT')
            @endif
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    {{-- Left Column: Details (2 spans) --}}
                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-gray-50/50 p-6 rounded-xl border border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                Deal Information
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                <x-text-input name="name" label="Deal Name" :value="old('name', $deal->name)" required placeholder="e.g. Family Combo" class="h-10 col-span-2" />
                                
                                <x-text-input name="price" label="Price ($)" type="number" step="0.01" :value="old('price', $deal->price)" required placeholder="0.00" class="h-10" />
                                
                                <div class="col-span-2">
                                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                    <textarea id="description" name="description" rows="4" class="w-full rounded-lg shadow-sm border-gray-300 focus:border-primary focus:ring-primary sm:text-sm" placeholder="Describe the deal...">{{ old('description', $deal->description) }}</textarea>
                                    @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                         {{-- Products Section --}}
                        <div class="bg-gray-50/50 p-6 rounded-xl border border-gray-100">
                             <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                Included Dishes
                             </h3>
                             
                             <div class="max-h-64 overflow-y-auto border border-gray-200 rounded-lg bg-white p-2">
                                <input type="hidden" name="products" value=""> 
                                @if($products->isEmpty())
                                    <p class="text-sm text-gray-500 text-center py-4">No dishes available. <a href="{{ route('products.create') }}" class="text-primary hover:underline font-medium">Create New Dish</a></p>
                                @else
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                        @foreach($products as $product)
                                            <label class="flex items-center space-x-3 p-3 hover:bg-gray-50 rounded-lg border border-transparent hover:border-gray-200 cursor-pointer transition-all">
                                                <input type="checkbox" name="products[]" value="{{ $product->id }}" 
                                                    class="rounded border-gray-300 text-primary focus:ring-primary h-4 w-4"
                                                    {{ in_array($product->id, old('products', $deal->products->pluck('id')->toArray())) ? 'checked' : '' }}
                                                >
                                                <div class="flex-1 flex justify-between items-center">
                                                    <span class="text-sm font-medium text-gray-900">{{ $product->name }}</span>
                                                    <span class="text-xs font-bold text-gray-500">${{ number_format($product->price, 2) }}</span>
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>
                                @endif
                             </div>
                        </div>
                    </div>

                     {{-- Right Column: Media (1 span) --}}
                    <div class="space-y-6">
                        <div class="bg-gray-50/50 p-6 rounded-xl border border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                Deal Image
                            </h3>

                             {{-- Single Image Input --}}
                             <div class="space-y-4">
                                @if($deal->image)
                                    <div class="aspect-video w-full rounded-lg overflow-hidden border border-gray-200">
                                        <img src="{{ asset('storage/' . $deal->image) }}" class="object-cover w-full h-full">
                                    </div>
                                @endif
                                
                                <input type="file" name="image" class="block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-full file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-primary/10 file:text-primary
                                    hover:file:bg-primary/20
                                "/>
                                <p class="text-xs text-gray-500">Only one main image for the deal.</p>
                             </div>
                        </div>

                         <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                            <label for="is_active" class="flex items-start gap-4 cursor-pointer">
                                <div class="flex items-center h-5">
                                    <input id="is_active" type="checkbox" class="rounded border-gray-300 text-primary shadow-sm focus:ring-primary h-5 w-5" name="is_active" value="1" {{ old('is_active', $deal->is_active ?? true) ? 'checked' : '' }}>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-sm font-medium text-gray-900">Active Status</span>
                                    <span class="text-xs text-gray-500">Visible to customers.</span>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-100">
                    <a href="{{ route('deals.index') }}" class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition shadow-sm">Cancel</a>
                    <button type="submit" :disabled="loading" class="relative px-6 py-2.5 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/90 transition shadow-md shadow-primary/20 disabled:opacity-75 disabled:cursor-not-allowed">
                        <span :class="{ 'invisible': loading }">{{ $deal->exists ? 'Update Deal' : 'Create Deal' }}</span>
                        <span x-show="loading" class="absolute inset-0 flex items-center justify-center" style="display: none;">
                            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </span>
                    </button>
                </div>
            </form>
    </div>
</x-app-layout>
