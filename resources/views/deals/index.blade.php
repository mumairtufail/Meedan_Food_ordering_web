<x-app-layout>
    <x-page-header 
        title="Deals" 
        description="Manage special offers and combos."
        :breadcrumbs="[['label' => 'Deals']]"
    >
        <x-slot:actions>
            <x-primary-button tag="a" href="{{ route('deals.create') }}">
                Create Deal
            </x-primary-button>
        </x-slot:actions>
    </x-page-header>

    <x-table-container>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($deals as $deal)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $deal->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            ${{ number_format($deal->price, 2) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('deals.toggle-status', $deal) }}" method="POST" class="inline-block" x-data="{ loading: false }" @submit="loading = true">
                                @csrf
                                @method('PATCH')
                                <button type="submit" :disabled="loading" class="relative min-w-[60px] text-center px-2.5 py-0.5 inline-flex items-center justify-center text-xs leading-4 font-semibold rounded-full {{ $deal->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} hover:opacity-80 cursor-pointer transition-opacity disabled:opacity-50">
                                    <span :class="{ 'invisible': loading }">{{ $deal->is_active ? 'Active' : 'Inactive' }}</span>
                                    <span x-show="loading" class="absolute inset-0 flex items-center justify-center" style="display: none;">
                                        <svg class="animate-spin h-3 w-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                    </span>
                                </button>
                            </form>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('deals.edit', $deal) }}" class="text-primary hover:text-primary/70 mr-4">Edit</a>
                            
                             <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-deal-deletion-{{ $deal->id }}')" class="text-red-600 hover:text-red-900">
                                Delete
                            </button>

                            <x-modal name="confirm-deal-deletion-{{ $deal->id }}" :show="false" focusable>
                                <form method="post" action="{{ route('deals.destroy', $deal) }}" class="p-6 text-left">
                                    @csrf
                                    @method('delete')

                                    <h2 class="text-lg font-medium text-gray-900">
                                        {{ __('Delete Deal?') }}
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-600">
                                        {{ __('Are you sure you want to delete this deal? This action cannot be undone.') }}
                                    </p>

                                    <div class="mt-6 flex justify-end">
                                        <x-secondary-button x-on:click="$dispatch('close')">
                                            {{ __('Cancel') }}
                                        </x-secondary-button>

                                        <x-danger-button class="ms-3">
                                            {{ __('Delete Deal') }}
                                        </x-danger-button>
                                    </div>
                                </form>
                            </x-modal>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
         @if($deals->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $deals->links() }}
            </div>
        @endif
    </x-table-container>
</x-app-layout>