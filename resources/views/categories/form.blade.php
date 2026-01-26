<x-app-layout>
    <x-page-header 
        :title="$category->exists ? 'Edit Category' : 'Create Category'"
        :description="$category->exists ? 'Update category details.' : 'Add a new category to the menu.'"
        :breadcrumbs="[
            ['label' => 'Categories', 'url' => route('categories.index')],
            ['label' => $category->exists ? 'Edit' : 'Create']
        ]"
    />

    <div class="max-w-3xl">
        <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
            <form action="{{ $category->exists ? route('categories.update', $category) : route('categories.store') }}" method="POST" enctype="multipart/form-data" x-data="{ loading: false }" @submit="loading = true">
                @csrf
                @if($category->exists)
                    @method('PUT')
                @endif

                <x-text-input 
                    name="name" 
                    label="Name" 
                    :value="old('name', $category->name)" 
                    required 
                    autofocus 
                    placeholder="e.g. Snacks, Main Course"
                />

                <div class="mb-4">
                    <label class="block text-sm font-medium text-primary mb-1">Category Image</label>
                    <div class="mt-1 flex items-center gap-4">
                        @if($category->image)
                            <div class="relative h-20 w-20 rounded-lg overflow-hidden border border-gray-200">
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="h-full w-full object-cover">
                            </div>
                        @endif
                        <input type="file" name="image" class="block w-full text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-semibold
                            file:bg-primary/10 file:text-primary
                            hover:file:bg-primary/20
                        "/>
                        @error('image') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-primary mb-1">Description</label>
                    <textarea 
                        id="description" 
                        name="description" 
                        rows="4" 
                        class="w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring-primary sm:text-sm"
                    >{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="block mb-6">
                    <label for="is_active" class="inline-flex items-center">
                        <input id="is_active" type="hidden" name="is_active" value="0">
                        <input id="is_active" type="checkbox" class="rounded border-gray-300 text-primary shadow-sm focus:ring-primary" name="is_active" value="1" {{ old('is_active', $category->is_active ?? true) ? 'checked' : '' }}>
                        <span class="ms-2 text-sm text-gray-600">{{ __('Active') }}</span>
                    </label>
                </div>

                <div class="flex items-center gap-4">
                    <x-primary-button class="relative" ::disabled="loading">
                         <span :class="{ 'invisible': loading }">{{ $category->exists ? 'Update Category' : 'Create Category' }}</span>
                        <span x-show="loading" class="absolute inset-0 flex items-center justify-center" style="display: none;">
                            <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </span>
                    </x-primary-button>
                    <a href="{{ route('categories.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>