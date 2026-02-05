<x-app-layout>
    <x-page-header 
        :title="$product->exists ? 'Edit Product' : 'Create Product'"
        :description="$product->exists ? 'Update product details.' : 'Add a new product to the menu.'"
        :breadcrumbs="[
            ['label' => 'Products', 'url' => route('products.index')],
            ['label' => $product->exists ? 'Edit' : 'Create']
        ]"
    />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <form action="{{ $product->exists ? route('products.update', $product) : route('products.store') }}" method="POST" enctype="multipart/form-data" x-data="{ loading: false }" @submit="loading = true">
            @csrf
            @if($product->exists)
                @method('PUT')
            @endif
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    {{-- Left Column: Details (2 spans) --}}
                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-gray-50/50 p-6 rounded-xl border border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                Basic Information
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="col-span-2">
                                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category <span class="text-red-500">*</span></label>
                                    <select id="category_id" name="category_id" class="w-full rounded-lg shadow-sm border-gray-300 focus:border-primary focus:ring-primary sm:text-sm h-10" required>
                                        <option value="">Select a Category</option>
                                        @foreach($categories as $id => $name)
                                            <option value="{{ $id }}" {{ old('category_id', $product->category_id) == $id ? 'selected' : '' }}>
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>

                                <x-text-input name="name" label="Dish Name" :value="old('name', $product->name)" required placeholder="e.g. Classic Burger" class="h-10" />
                                
                                <x-text-input name="price" label="Price ($)" type="number" step="0.01" :value="old('price', $product->price)" required placeholder="0.00" class="h-10" />
                                
                                <div class="col-span-2">
                                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                    <textarea id="description" name="description" rows="4" class="w-full rounded-lg shadow-sm border-gray-300 focus:border-primary focus:ring-primary sm:text-sm" placeholder="Describe the dish...">{{ old('description', $product->description) }}</textarea>
                                    @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                         {{-- Addons Section in Main Column for better spacing --}}
                        <div class="bg-gray-50/50 p-6 rounded-xl border border-gray-100">
                             <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                Add-ons & Extras
                             </h3>
                             
                             <div class="max-h-64 overflow-y-auto border border-gray-200 rounded-lg bg-white p-2">
                                @if($addons->isEmpty())
                                    <p class="text-sm text-gray-500 text-center py-4">No addons available. <a href="{{ route('addons.create') }}" class="text-primary hover:underline font-medium">Create New Addon</a></p>
                                @else
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                        @foreach($addons as $addon)
                                            <label class="flex items-center space-x-3 p-3 hover:bg-gray-50 rounded-lg border border-transparent hover:border-gray-200 cursor-pointer transition-all">
                                                <input type="checkbox" name="addons[]" value="{{ $addon->id }}" 
                                                    class="rounded border-gray-300 text-primary focus:ring-primary h-4 w-4"
                                                    {{ in_array($addon->id, (array) old('addons', $product->addons->pluck('id')->toArray())) ? 'checked' : '' }}
                                                >
                                                <div class="flex-1 flex justify-between items-center">
                                                    <span class="text-sm font-medium text-gray-900">{{ $addon->name }}</span>
                                                    <span class="text-xs font-bold text-green-600 bg-green-50 px-2 py-1 rounded-full">+${{ number_format($addon->price, 2) }}</span>
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>
                                @endif
                             </div>
                             @error('addons') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>

                     {{-- Right Column: Media (1 span) --}}
                    <div class="space-y-6">
                        <div class="bg-gray-50/50 p-6 rounded-xl border border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                Dish Images
                            </h3>

                            <div x-data="{ 
                                files: [],
                                handleFileSelect(event) {
                                    this.files = [...event.target.files].map((file, index) => ({
                                        file: file,
                                        url: URL.createObjectURL(file),
                                        name: file.name,
                                        size: (file.size / 1024).toFixed(1) + ' KB'
                                    }));
                                }
                            }" class="space-y-4">
                                {{-- Drag Drop Zone --}}
                                <div class="relative border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:bg-white hover:border-primary transition-colors bg-white group">
                                    <input type="file" name="images[]" multiple 
                                           class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                                           @change="handleFileSelect($event)">
                                    
                                    <div x-show="files.length === 0" class="space-y-2">
                                        <div class="mx-auto h-12 w-12 text-gray-400 group-hover:text-primary transition-colors">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                        </div>
                                        <div class="text-sm text-gray-600">
                                            <span class="font-semibold text-primary">Click to upload</span> or drag and drop
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG up to 2MB</p>
                                    </div>

                                    <div x-show="files.length > 0" class="text-center" style="display: none;">
                                        <p class="text-sm text-primary font-medium" x-text="files.length + ' new file(s) selected'"></p>
                                        <p class="text-xs text-gray-500 mt-1">Click to change selection</p>
                                    </div>
                                </div>
                                
                                {{-- New Files Preview --}}
                                <template x-if="files.length > 0">
                                    <div class="space-y-2">
                                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">New Uploads</label>
                                        <div class="grid grid-cols-2 gap-3">
                                            <template x-for="(file, index) in files" :key="index">
                                                <div class="relative group aspect-square rounded-lg overflow-hidden border border-gray-200 bg-gray-50">
                                                    <img :src="file.url" class="object-cover w-full h-full">
                                                    <div class="absolute inset-0 bg-black/40 flex items-end justify-center pb-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                                        <span class="text-xs text-white bg-black/50 px-2 py-1 rounded" x-text="'Index: ' + ({{ $product->images->count() }} + index)"></span>
                                                    </div>
                                                    <div class="absolute top-1 right-1 bg-primary text-white text-[10px] px-1.5 py-0.5 rounded shadow">New</div>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </template>

                                {{-- Existing Images --}}
                                @if($product->exists && $product->images->count() > 0)
                                    <div class="space-y-4 pt-4 border-t border-gray-100">
                                        <div class="flex items-center justify-between">
                                            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Current Images</label>
                                            <span class="text-xs text-gray-400">Update sort order to rearrange</span>
                                        </div>
                                        
                                        <div class="space-y-3">
                                            @foreach($product->images->sortBy('sort_order') as $image)
                                                <div class="flex items-center gap-4 p-3 bg-white border border-gray-200 rounded-lg shadow-sm">
                                                    <div class="h-16 w-16 flex-shrink-0 rounded-md overflow-hidden bg-gray-100 border border-gray-200">
                                                        <img src="{{ asset('storage/' . $image->image_path) }}" class="h-full w-full object-cover">
                                                    </div>
                                                    
                                                    <div class="flex-1 min-w-0 grid grid-cols-2 gap-4">
                                                        <div>
                                                            <label class="block text-xs font-medium text-gray-700 mb-1">Sort Order</label>
                                                            <input type="number" 
                                                                   name="existing_images[{{ $image->id }}][sort_order]" 
                                                                   value="{{ $image->sort_order }}" 
                                                                   class="block w-20 rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm h-8"
                                                            >
                                                        </div>
                                                        <div class="flex items-center justify-end">
                                                            <label class="flex items-center gap-2 cursor-pointer text-sm text-red-600 hover:text-red-700">
                                                                <input type="checkbox" name="delete_images[]" value="{{ $image->id }}" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                                                                <span>Delete</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                         <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                            <label for="is_active" class="flex items-start gap-4 cursor-pointer">
                                <div class="flex items-center h-5">
                                    <input id="is_active" type="checkbox" class="rounded border-gray-300 text-primary shadow-sm focus:ring-primary h-5 w-5" name="is_active" value="1" {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-sm font-medium text-gray-900">Active Status</span>
                                    <span class="text-xs text-gray-500">Visible to customers on the menu.</span>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-100">
                    <a href="{{ route('products.index') }}" class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition shadow-sm">Cancel</a>
                    <button type="submit" :disabled="loading" class="relative px-6 py-2.5 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/90 transition shadow-md shadow-primary/20 disabled:opacity-75 disabled:cursor-not-allowed">
                        <span :class="{ 'invisible': loading }">{{ $product->exists ? 'Update Dish' : 'Create Dish' }}</span>
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