<x-layouts.app>
    <div class="bg-base min-h-screen pt-10 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-24 items-start">
                
                {{-- Reservation Info --}}
                <div class="space-y-12 top-24 sticky">
                    <div>
                        <h4 class="text-sm font-bold uppercase tracking-[0.2em] text-primary/60 mb-2">Book a Table</h4>
                        <h1 class="text-4xl md:text-5xl font-bold text-primary mb-6">Reservation.</h1>
                        <p class="text-lg text-gray-600 leading-relaxed">
                            Join us for an unforgettable dining experience. Reserve your spot today and let us prepare for your visit.
                        </p>
                    </div>

                    <div class="space-y-8">
                        <div class="flex items-start">
                            <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary shrink-0 mr-6">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-1">Opening Hours</h3>
                                <p class="text-gray-600">Mon - Fri: 11:00 AM - 10:00 PM<br>Sat - Sun: 10:00 AM - 11:00 PM</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                             <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary shrink-0 mr-6">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-1">Large Groups</h3>
                                <p class="text-gray-600">For parties larger than 10, please call us directly for special arrangements.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Reservation Form --}}
                <div class="bg-white p-8 md:p-10 rounded-3xl shadow-xl border border-primary/10" x-data="{ loading: false }">
                    <form action="{{ route('reservation.store') }}" method="POST" @submit="loading = true" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-bold text-primary mb-2 uppercase tracking-widest">Full Name</label>
                                <input type="text" name="name" id="name" required value="{{ old('name') }}"
                                    class="w-full px-5 py-4 rounded-xl border-primary/10 focus:border-primary focus:ring-primary/20 bg-base/50 placeholder:text-gray-400" 
                                    placeholder="John Doe">
                                @error('name') <p class="mt-2 text-xs font-bold text-red-500 uppercase tracking-widest">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-bold text-primary mb-2 uppercase tracking-widest">Phone Number</label>
                                <input type="tel" name="phone" id="phone" required value="{{ old('phone') }}"
                                    pattern="[0-9xX\s\-\(\)\+]*"
                                    title="Please enter a valid phone number"
                                    class="w-full px-5 py-4 rounded-xl border-primary/10 focus:border-primary focus:ring-primary/20 bg-base/50 placeholder:text-gray-400" 
                                    placeholder="+1 (555) 000-0000">
                                @error('phone') <p class="mt-2 text-xs font-bold text-red-500 uppercase tracking-widest">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="guests" class="block text-sm font-bold text-primary mb-2 uppercase tracking-widest">Guests</label>
                                <input type="number" name="guests" id="guests" required min="1" max="50" value="{{ old('guests', 2) }}"
                                    class="w-full px-5 py-4 rounded-xl border-primary/10 focus:border-primary focus:ring-primary/20 bg-base/50">
                                @error('guests') <p class="mt-2 text-xs font-bold text-red-500 uppercase tracking-widest">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="date" class="block text-sm font-bold text-primary mb-2 uppercase tracking-widest">Select Date</label>
                                <div class="relative">
                                    <input type="text" name="date" id="reservation_date" required readonly value="{{ old('date') }}"
                                        class="w-full px-5 py-4 rounded-xl border-primary/10 focus:border-primary focus:ring-primary/20 bg-base/50 cursor-pointer"
                                        placeholder="Pick Date">
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                    </div>
                                </div>
                                @error('date') <p class="mt-2 text-xs font-bold text-red-500 uppercase tracking-widest">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="time" class="block text-sm font-bold text-primary mb-2 uppercase tracking-widest">Select Time</label>
                                <div class="relative">
                                    <input type="text" name="time" id="reservation_time" required readonly value="{{ old('time') }}"
                                        class="w-full px-5 py-4 rounded-xl border-primary/10 focus:border-primary focus:ring-primary/20 bg-base/50 cursor-pointer"
                                        placeholder="Pick Time">
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    </div>
                                </div>
                                @error('time') <p class="mt-2 text-xs font-bold text-red-500 uppercase tracking-widest">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div>
                            <label for="notes" class="block text-sm font-bold text-primary mb-2 uppercase tracking-widest">Special Notes (Optional)</label>
                            <textarea name="notes" id="notes" rows="3" 
                                class="w-full px-5 py-4 rounded-xl border-primary/10 focus:border-primary focus:ring-primary/20 bg-base/50 placeholder:text-gray-400" 
                                placeholder="Any allergies or special requests?">{{ old('notes') }}</textarea>
                            @error('notes') <p class="mt-2 text-xs font-bold text-red-500 uppercase tracking-widest">{{ $message }}</p> @enderror
                        </div>

                        <button type="submit" 
                            :disabled="loading"
                            class="w-full bg-primary text-white font-bold py-5 rounded-2xl hover:bg-primary/95 transition-all shadow-xl shadow-primary/20 flex items-center justify-center gap-3 disabled:opacity-70 disabled:cursor-not-allowed">
                            <span x-show="!loading">Confirm Booking</span>
                            <span x-show="loading" style="display: none;" class="flex items-center gap-2">
                                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Booking Your Spot...
                            </span>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#reservation_date", {
                minDate: "today",
                dateFormat: "Y-m-d",
                monthSelectorType: "dropdown",
                yearSelectorType: "dropdown",
            });

            flatpickr("#reservation_time", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                altInput: true,
                altFormat: "h:i K",
                minuteIncrement: 15,
                time_24hr: false
            });
        });
    </script>
</x-layouts.app>
