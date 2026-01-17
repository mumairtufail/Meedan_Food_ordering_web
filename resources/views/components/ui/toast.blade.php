<div x-data="{ show: false, message: '' }" 
     x-on:notify.window="show = true; message = $event.detail; setTimeout(() => show = false, 3000)" 
     x-show="show" 
     style="display: none;"
     x-transition
     class="fixed bottom-5 right-5 bg-primary text-base px-5 py-3 rounded-lg shadow-lg z-50 flex items-center gap-3">
    <span x-text="message" class="font-medium"></span>
</div>
