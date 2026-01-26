<x-app-layout>
    <x-page-header 
        title="Site Settings" 
        description="Customize your website logo, hero banners, and brand content."
        :breadcrumbs="[['label' => 'Settings']]"
    />

    <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8 pb-20">
        @csrf
        @method('PATCH')

        {{-- Branding Section --}}
        <div class="bg-white rounded-3xl shadow-sm border border-primary/10 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                <h3 class="text-lg font-bold text-primary">Global Branding</h3>
                <p class="text-sm text-gray-500">Manage your restaurant identity.</p>
            </div>
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
                    <div>
                        <label class="block text-sm font-bold text-primary mb-4 uppercase tracking-widest">Site Logo</label>
                        <div class="flex items-center gap-8">
                            <div class="h-24 w-48 bg-base rounded-2xl border-2 border-dashed border-primary/20 flex items-center justify-center overflow-hidden p-4">
                                <img src="{{ $settings['site_logo'] }}" alt="Current Logo" class="max-h-full max-w-full object-contain">
                            </div>
                    <div class="flex-1 space-y-6">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Method 1: Upload File</label>
                            <input type="file" name="site_logo" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-primary file:text-white hover:file:bg-primary/90 transition-all cursor-pointer">
                        </div>
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                <div class="w-full border-t border-gray-100"></div>
                            </div>
                            <div class="relative flex justify-center text-xs uppercase font-bold text-gray-300">
                                <span class="bg-white px-3 mt-[-2px]">OR</span>
                            </div>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Method 2: Direct Link (URL)</label>
                            <input type="url" name="site_logo_url" value="{{ $settings['site_logo'] }}" class="w-full px-4 py-3 rounded-xl border-primary/10 focus:border-primary focus:ring-primary/20 bg-base/30 text-xs font-mono" placeholder="https://example.com/logo.png">
                            <p class="mt-2 text-[10px] text-gray-400 uppercase font-bold tracking-widest">Pasting a URL will override the current logo unless a file is uploaded above.</p>
                        </div>
                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Hero Slides Section --}}
        <div class="space-y-6">
            <div class="flex items-end justify-between px-2">
                <div>
                    <h3 class="text-2xl font-bold text-primary">Hero Banners</h3>
                    <p class="text-sm text-gray-500">Configure the three main slides on your home page.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-8">
                @for($i = 1; $i <= 3; $i++)
                    <div class="bg-white rounded-3xl shadow-sm border border-primary/10 overflow-hidden">
                        <div class="p-6 border-b border-gray-100 bg-primary/5 flex flex-col sm:flex-row justify-between sm:items-center gap-4">
                            <div class="flex items-center gap-3">
                                <span class="h-8 w-8 rounded-full bg-primary text-white flex items-center justify-center text-xs font-bold leading-none">#{{ $i }}</span>
                                <h4 class="font-bold text-primary uppercase tracking-widest text-sm">Banner Slide {{ $i }}</h4>
                            </div>
                            <div class="h-24 w-40 rounded-xl overflow-hidden border border-white shadow-sm">
                                <img src="{{ $settings['hero_slide_'.$i.'_image'] }}" class="w-full h-full object-cover">
                            </div>
                        </div>
                        
                        <div class="p-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
                            <div class="lg:col-span-1 border-r border-gray-100 pr-8">
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Change Background Image</label>
                                <input type="file" name="hero_slide_{{ $i }}_image" class="block w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-bold file:bg-gray-100 file:text-primary hover:file:bg-gray-200 transition-all cursor-pointer">
                            </div>

                            {{-- Text Content --}}
                            <div class="lg:col-span-2 space-y-6">
                                <div>
                                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Badge Text</label>
                                    <input type="text" name="hero_slide_{{ $i }}_badge" value="{{ $settings['hero_slide_'.$i.'_badge'] }}" class="w-full px-4 py-3 rounded-xl border-primary/10 focus:border-primary focus:ring-primary/20 bg-base/30 text-sm">
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Headline (Supports HTML)</label>
                                        <textarea name="hero_slide_{{ $i }}_title" rows="2" class="w-full px-4 py-3 rounded-xl border-primary/10 focus:border-primary focus:ring-primary/20 bg-base/30 text-sm font-bold">{{ $settings['hero_slide_'.$i.'_title'] }}</textarea>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Subtitle / Description</label>
                                        <textarea name="hero_slide_{{ $i }}_subtitle" rows="2" class="w-full px-4 py-3 rounded-xl border-primary/10 focus:border-primary focus:ring-primary/20 bg-base/30 text-sm leading-relaxed">{{ $settings['hero_slide_'.$i.'_subtitle'] }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>

        {{-- Floating Action Bar --}}
        <div class="fixed bottom-8 right-8 z-40">
            <button type="submit" class="inline-flex items-center gap-3 bg-primary text-white px-8 py-4 rounded-2xl font-bold shadow-2xl shadow-primary/40 hover:scale-105 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                <span>Save All Changes</span>
            </button>
        </div>
    </form>
</x-app-layout>
