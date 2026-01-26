<x-app-layout>
    <x-page-header 
        title="Contact Inquiries" 
        description="View and manage messages from your website visitors."
        :breadcrumbs="[['label' => 'Contacts']]"
    />

    <x-table-container>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Subject</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($contacts as $contact)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $contact->created_at->format('M d, Y H:i') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $contact->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $contact->email }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">{{ $contact->subject ?? 'No Subject' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2.5 py-0.5 inline-flex text-xs leading-4 font-semibold rounded-full {{ $contact->status === 'read' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800 shadow-sm' }}">
                                {{ ucfirst($contact->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button @click="$dispatch('open-modal', 'view-contact-{{ $contact->id }}')" class="text-primary hover:text-primary/70 mr-4">View</button>
                            
                            <x-modal name="view-contact-{{ $contact->id }}" :show="false">
                                <div class="p-6">
                                    <div class="flex justify-between items-start mb-6">
                                        <h2 class="text-2xl font-bold text-gray-900">Message from {{ $contact->name }}</h2>
                                        <button @click="$dispatch('close')" class="text-gray-400 hover:text-gray-500">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </button>
                                    </div>
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Sent At</label>
                                            <p class="text-gray-900">{{ $contact->created_at->format('F d, Y @ H:i') }}</p>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Email</label>
                                            <p class="text-gray-900">{{ $contact->email }}</p>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Subject</label>
                                            <p class="text-gray-900 font-bold group-hover:text-primary">{{ $contact->subject ?? 'No Subject' }}</p>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Message</label>
                                            <div class="p-4 bg-gray-50 rounded-xl border border-gray-100 text-gray-700 leading-relaxed whitespace-pre-wrap mt-1">
                                                {{ $contact->message }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-8 flex justify-end">
                                        <x-secondary-button @click="$dispatch('close')">Close</x-secondary-button>
                                    </div>
                                </div>
                            </x-modal>

                            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-contact-deletion-{{ $contact->id }}')" class="text-red-600 hover:text-red-900">
                                Delete
                            </button>

                            <x-modal name="confirm-contact-deletion-{{ $contact->id }}" :show="false" focusable>
                                <form method="post" action="{{ route('contacts.destroy', $contact) }}" class="p-6 text-left">
                                    @csrf
                                    @method('delete')
                                    <h2 class="text-lg font-medium text-gray-900">Delete Inquiry?</h2>
                                    <p class="mt-1 text-sm text-gray-600">Are you sure you want to delete this inquiry?</p>
                                    <div class="mt-6 flex justify-end">
                                        <x-secondary-button x-on:click="$dispatch('close')">Cancel</x-secondary-button>
                                        <x-danger-button class="ms-3">Delete Permanent</x-danger-button>
                                    </div>
                                </form>
                            </x-modal>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if($contacts->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $contacts->links() }}
            </div>
        @endif
    </x-table-container>
</x-app-layout>
