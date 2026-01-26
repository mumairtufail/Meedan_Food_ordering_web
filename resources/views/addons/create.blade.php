<x-app-layout>
    <x-page-header 
        title="Create Addon" 
        description="Add a new extra item."
        :breadcrumbs="[
            ['label' => 'Addons', 'url' => route('addons.index')],
            ['label' => 'Create']
        ]"
    />

    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
            <form method="POST" action="{{ route('addons.store') }}" class="space-y-6" x-data="{ loading: false }" @submit="loading = true">
                @csrf
                
                {{-- Name --}}
                <x-text-input 
                    name="name" 
                    label="Addon Name" 
                    placeholder="e.g. Extra Cheese" 
                    required 
                />

                {{-- Price --}}
                <x-text-input 
                    name="price" 
                    type="number" 
                    step="0.01" 
                    label="Price" 
                    placeholder="0.00" 
                    required 
                />

                {{-- Active Status --}}
                <div class="flex items-center">
                    <input id="is_active" name="is_active" type="checkbox" value="1" checked class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                    <label for="is_active" class="ml-2 block text-sm text-gray-900">
                        Active (Available for purchase)
                    </label>
                </div>

                {{-- Actions --}}
                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <x-secondary-button tag="a" href="{{ route('addons.index') }}">
                        Cancel
                    </x-secondary-button>
                    <x-primary-button class="relative" ::disabled="loading">
                        <span :class="{ 'invisible': loading }">Create Addon</span>
                        <span x-show="loading" class="absolute inset-0 flex items-center justify-center" style="display: none;">
                            <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </span>
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>