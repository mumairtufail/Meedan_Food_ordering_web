<x-ui.layout.main>
    <div class="flex flex-col min-h-screen">
        <x-ui.layout.header />
        <main class="flex-grow">
            {{ $slot }}
        </main>
        <x-ui.footer />
    </div>
    <x-ui.toast />
</x-ui.layout.main>
