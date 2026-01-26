<x-layouts.app>
    <div class="bg-base min-h-screen pt-10 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-24 items-start">
                
                {{-- Contact Info --}}
                <div class="space-y-12 top-24 sticky">
                    <div>
                        <h1 class="text-4xl md:text-5xl font-bold text-primary mb-6">Get in touch.</h1>
                        <p class="text-lg text-gray-600 leading-relaxed">
                            Have a question about our menu, hosting a private event, or just want to say hello? Drop us a line!
                        </p>
                    </div>

                    <div class="space-y-8">
                        <div class="flex items-start">
                            <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary shrink-0 mr-6">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-1">Visit Us</h3>
                                <p class="text-gray-600">123 Culinary Avenue<br>Food District, FD 90210</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                             <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary shrink-0 mr-6">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-1">Email Us</h3>
                                <p class="text-gray-600">hello@meedan.com</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                             <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary shrink-0 mr-6">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-1">Call Us</h3>
                                <p class="text-gray-600">+1 (555) 123-4567</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Contact Form --}}
                <div class="bg-white p-8 md:p-10 rounded-3xl shadow-xl border border-primary/10" x-data="{ loading: false }">
                    <form action="{{ route('contact.store') }}" method="POST" @submit="loading = true" class="space-y-6">
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
                                <label for="email" class="block text-sm font-bold text-primary mb-2 uppercase tracking-widest">Email Address</label>
                                <input type="email" name="email" id="email" required value="{{ old('email') }}"
                                    class="w-full px-5 py-4 rounded-xl border-primary/10 focus:border-primary focus:ring-primary/20 bg-base/50 placeholder:text-gray-400" 
                                    placeholder="john@example.com">
                                @error('email') <p class="mt-2 text-xs font-bold text-red-500 uppercase tracking-widest">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div>
                            <label for="subject" class="block text-sm font-bold text-primary mb-2 uppercase tracking-widest">Subject</label>
                            <input type="text" name="subject" id="subject" value="{{ old('subject') }}"
                                class="w-full px-5 py-4 rounded-xl border-primary/10 focus:border-primary focus:ring-primary/20 bg-base/50 placeholder:text-gray-400" 
                                placeholder="General Inquiry">
                            @error('subject') <p class="mt-2 text-xs font-bold text-red-500 uppercase tracking-widest">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-bold text-primary mb-2 uppercase tracking-widest">Message</label>
                            <textarea name="message" id="message" rows="5" required
                                class="w-full px-5 py-4 rounded-xl border-primary/10 focus:border-primary focus:ring-primary/20 bg-base/50 placeholder:text-gray-400" 
                                placeholder="How can we help?">{{ old('message') }}</textarea>
                            @error('message') <p class="mt-2 text-xs font-bold text-red-500 uppercase tracking-widest">{{ $message }}</p> @enderror
                        </div>
                        <button type="submit" 
                            :disabled="loading"
                            class="w-full bg-primary text-white font-bold py-5 rounded-2xl hover:bg-primary/95 transition-all shadow-xl shadow-primary/20 flex items-center justify-center gap-3 disabled:opacity-70 disabled:cursor-not-allowed">
                            <span x-show="!loading">Send Message</span>
                            <span x-show="loading" style="display: none;" class="flex items-center gap-2">
                                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Processing...
                            </span>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-layouts.app>
