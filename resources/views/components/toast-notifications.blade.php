@if (session('success') || session('error') || session('warning') || session('info'))
    <div x-data="{ 
            show: true,
            message: '{{ session('success') ?? session('error') ?? session('warning') ?? session('info') }}',
            type: '{{ session('success') ? 'success' : (session('error') ? 'error' : (session('warning') ? 'warning' : 'info')) }}'
         }" 
         x-show="show" 
         x-init="setTimeout(() => show = false, 5000)"
         x-transition:enter="transform ease-out duration-500 transition"
         x-transition:enter-start="translate-y-12 opacity-0 sm:translate-y-0 sm:translate-x-12"
         x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         :class="{
            'bg-primary border-white/10 shadow-primary/20': type === 'success',
            'bg-red-600 border-red-500 shadow-red-200': type === 'error',
            'bg-yellow-500 border-yellow-400': type === 'warning',
            'bg-blue-600 border-blue-500': type === 'info'
         }"
         class="fixed bottom-6 right-6 z-[100] text-base px-8 py-5 rounded-2xl shadow-2xl border flex items-center gap-4 min-w-[320px] max-w-md">
        
        <div class="flex-shrink-0">
            <template x-if="type === 'success'">
                <div class="h-10 w-10 bg-white/10 rounded-full flex items-center justify-center">
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                </div>
            </template>
            <template x-if="type === 'error'">
                <div class="h-10 w-10 bg-white/10 rounded-full flex items-center justify-center">
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </div>
            </template>
        </div>

        <div class="flex-1">
            <h4 class="text-[10px] font-bold uppercase tracking-widest opacity-60 mb-0.5" x-text="type"></h4>
            <p x-text="message" class="text-sm font-bold leading-tight"></p>
        </div>

        <button @click="show = false" class="text-white/40 hover:text-white transition-colors bg-white/5 p-2 rounded-lg">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>
@endif
