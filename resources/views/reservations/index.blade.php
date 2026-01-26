<x-app-layout>
    <x-page-header 
        title="Table Reservations" 
        description="Manage restaurant table bookings and visitor requests."
        :breadcrumbs="[['label' => 'Reservations']]"
    />

    <x-table-container>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Date/Time</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Guest</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Size</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Phone</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($reservations as $reservation)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ \Carbon\Carbon::parse($reservation->date)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($reservation->time)->format('h:i A') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $reservation->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                {{ $reservation->guests }} Persons
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $reservation->phone }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('reservations.update', $reservation) }}" method="POST" x-data="{ open: false }">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()" class="text-xs font-bold py-1 pl-2 pr-8 rounded-full border-none shadow-sm cursor-pointer 
                                    {{ $reservation->status === 'confirmed' ? 'bg-green-100 text-green-800' : ($reservation->status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                    <option value="pending" {{ $reservation->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="confirmed" {{ $reservation->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="cancelled" {{ $reservation->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </form>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button @click="$dispatch('open-modal', 'view-reservation-{{ $reservation->id }}')" class="text-primary hover:text-primary/70 mr-4">Notes</button>
                            
                            <x-modal name="view-reservation-{{ $reservation->id }}" :show="false">
                                <div class="p-6">
                                    <h3 class="text-lg font-bold mb-4">Reservation Notes</h3>
                                    <p class="text-gray-600 bg-gray-50 p-4 rounded-xl border border-gray-100 italic">
                                        {{ $reservation->notes ?? 'No special notes provided.' }}
                                    </p>
                                    <div class="mt-6 flex justify-end">
                                        <x-secondary-button @click="$dispatch('close')">Close</x-secondary-button>
                                    </div>
                                </div>
                            </x-modal>

                            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-reservation-deletion-{{ $reservation->id }}')" class="text-red-600 hover:text-red-900">
                                Delete
                            </button>

                            <x-modal name="confirm-reservation-deletion-{{ $reservation->id }}" :show="false" focusable>
                                <form method="post" action="{{ route('reservations.destroy', $reservation) }}" class="p-6 text-left">
                                    @csrf
                                    @method('delete')
                                    <h2 class="text-lg font-medium text-gray-900">Delete Booking?</h2>
                                    <p class="mt-1 text-sm text-gray-600">Are you sure you want to delete this reservation?</p>
                                    <div class="mt-6 flex justify-end">
                                        <x-secondary-button x-on:click="$dispatch('close')">Cancel</x-secondary-button>
                                        <x-danger-button class="ms-3">Delete Forever</x-danger-button>
                                    </div>
                                </form>
                            </x-modal>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if($reservations->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $reservations->links() }}
            </div>
        @endif
    </x-table-container>
</x-app-layout>
