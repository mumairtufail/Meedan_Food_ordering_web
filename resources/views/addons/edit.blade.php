<x-app-layout>
    <x-page-header 
        title="Edit Addon" 
        description="Update {{ $addon->name }}."
        :breadcrumbs="[
            ['label' => 'Addons', 'url' => route('addons.index')],
            ['label' => 'Edit']
        ]"
    />

    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
            <form method="POST" action="{{ route('addons.update', $addon) }}" class="space-y-6">
                @csrf
                @method('PUT')
                
                {{-- Name --}}
                <x-text-input 
                    name="name" 
                    label="Addon Name" 
                    :value="$addon->name"
                    required 
                />

                {{-- Price --}}
                <x-text-input 
                    name="price" 
                    type="number" 
                    step="0.01" 
                    label="Price" 
                    :value="$addon->price"
                    required 
                />

                {{-- Active Status --}}
                <div class="flex items-center">
                    <input id="is_active" name="is_active" type="checkbox" value="1" {{ $addon->is_active ? 'checked' : '' }} class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                    <label for="is_active" class="ml-2 block text-sm text-gray-900">
                        Active (Available for purchase)
                    </label>
                </div>

                {{-- Actions --}}
                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <x-secondary-button tag="a" href="{{ route('addons.index') }}">
                        Cancel
                    </x-secondary-button>
                    <x-primary-button>
                        Update Addon
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>