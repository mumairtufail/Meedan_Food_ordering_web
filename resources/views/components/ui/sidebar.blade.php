@props(['brand' => null])

<!-- Desktop Sidebar -->
<aside class="hidden lg:flex flex-col w-64 bg-white border-r border-primary/10 transition-all duration-300"
       :class="sidebarOpen ? 'w-64' : 'w-20'"
>
    <!-- Brand -->
    @if($brand)
        <div class="h-16 flex items-center px-4 border-b border-gray-100/50">
             {{ $brand }}
        </div>
    @endif

    <!-- Nav -->
    <div class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
        {{ $slot }}
    </div>
</aside>

<!-- Mobile Sidebar -->
<div class="fixed inset-0 z-40 lg:hidden" x-show="sidebarOpen" style="display: none;">
    <!-- Overlay -->
    <div class="fixed inset-0 bg-gray-600 bg-opacity-75 transition-opacity" 
         @click="sidebarOpen = false"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
    </div>

    <!-- Sidebar Panel -->
    <div class="relative flex-1 flex flex-col max-w-xs w-full bg-white h-full transition ease-in-out duration-300 transform"
         x-transition:enter="translate-x-[-100%]"
         x-transition:enter-start="translate-x-[-100%]"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="translate-x-0"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="translate-x-[-100%]"
    >
        @if($brand)
            <div class="h-16 flex items-center px-4 border-b border-gray-100/50">
                {{ $brand }}
            </div>
        @endif
        
        <div class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
            {{ $slot }}
        </div>
    </div>
</div>
