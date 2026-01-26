<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-base">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Medaan') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased h-full text-gray-900">
        
        <x-ui.layout>
            <x-ui.sidebar>
                <x-slot:brand>
                     <x-ui.brand href="{{ route('dashboard') }}">
                        <x-slot:logo>
                           <x-application-logo class="w-8 h-8 text-primary" />
                        </x-slot:logo>
                    </x-ui.brand>
                </x-slot:brand>

                <x-ui.navlist>
                    <x-ui.navlist.item 
                        label="Dashboard"
                        icon="home"
                        href="{{ route('dashboard') }}"
                        :active="request()->routeIs('dashboard')"
                    />
                    
                     <div class="px-3 pt-4 pb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                        Management
                    </div>

                    <x-ui.navlist.item 
                        label="Categories"
                        icon="ticket"
                        href="{{ route('categories.index') }}"
                        :active="request()->routeIs('categories.*')"
                    />

                    <x-ui.navlist.item 
                        label="Dishes"
                        icon="shopping-bag"
                        href="{{ route('products.index') }}"
                        :active="request()->routeIs('products.*')"
                    />

                    <x-ui.navlist.item 
                        label="Deals"
                        icon="shopping-bag"
                        href="{{ route('deals.index') }}"
                        :active="request()->routeIs('deals.*')"
                    />

                    <x-ui.navlist.item 
                        label="Addons"
                        icon="shopping-bag"
                        href="{{ route('addons.index') }}"
                        :active="request()->routeIs('addons.*')"
                    />

                    <x-ui.navlist.item 
                        label="Orders"
                        icon="clipboard-list"
                        href="{{ route('orders.index') }}"
                        :active="request()->routeIs('orders.*')"
                        badge="Soon"
                    />

                    <x-ui.navlist.item 
                        label="Customers"
                        icon="users"
                        href="{{ route('customers.index') }}"
                        :active="request()->routeIs('customers.*')"
                    />

                    <x-ui.navlist.item 
                        label="Contacts"
                        icon="chat-bubble-left-right"
                        href="{{ route('contacts.index') }}"
                        :active="request()->routeIs('contacts.*')"
                    />


                    <x-ui.navlist.item 
                        label="Reservations"
                        icon="calendar"
                        href="{{ route('reservations.index') }}"
                        :active="request()->routeIs('reservations.*')"
                    />

                    <x-ui.navlist.item 
                        label="Settings"
                        icon="cog-6-tooth"
                        href="{{ route('settings.index') }}"
                        :active="request()->routeIs('settings.*')"
                    />
                </x-ui.navlist>

                <x-ui.sidebar.push />

            </x-ui.sidebar>

            <x-ui.layout.main>
                <x-ui.layout.header>
                    <x-ui.sidebar.toggle />
                    
                    <div class="flex-1 px-4 text-lg font-semibold text-gray-900">
                        {{ $header ?? '' }}
                    </div>

                    {{-- Right side header items --}}
                    <div class="flex items-center gap-4">
                         <button class="p-2 text-gray-400 hover:text-gray-500 relative">
                            <span class="absolute top-2 right-2 block h-2 w-2 rounded-full ring-2 ring-white bg-red-500"></span>
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </button>

                         <!-- Profile Dropdown -->
                        <x-ui.dropdown class="w-56 right-0 origin-top-right">
                            <x-slot:button>
                                <button class="flex items-center gap-2 pl-2 pr-1 py-1 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary/20 transition-all">
                                    <div class="h-8 w-8 rounded-full bg-primary flex items-center justify-center text-white shadow-sm">
                                        <span class="text-xs font-bold">{{ substr(Auth::user()->name ?? 'A', 0, 1) }}</span>
                                    </div>
                                    <div class="hidden md:flex flex-col items-start mr-1">
                                         <span class="text-xs font-bold text-gray-900 leading-none">{{ Auth::user()->name ?? 'Admin' }}</span>
                                         <span class="text-[10px] text-gray-500 leading-none mt-0.5">Administrator</span>
                                    </div>
                                    <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                            </x-slot:button>
                            
                            <x-slot:menu>
                                <div class="px-4 py-3 border-b border-gray-100 bg-gray-50/50 rounded-t-md">
                                    <p class="text-sm leading-5 font-bold text-gray-900 truncate">{{ Auth::user()->name ?? 'Admin' }}</p>
                                    <p class="text-xs leading-5 text-gray-500 truncate font-mono">{{ Auth::user()->email ?? 'admin@example.com' }}</p>
                                </div>
                                
                                <div class="py-1">
                                    <x-ui.dropdown.item href="{{ route('profile.edit') }}" icon="user-circle">
                                        Profile
                                    </x-ui.dropdown.item>
                                    <x-ui.dropdown.item href="#" icon="adjustments-horizontal">
                                        Settings
                                    </x-ui.dropdown.item>
                                </div>
                                
                                <div class="border-t border-gray-100"></div>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-ui.dropdown.item as="button" type="submit" icon="logout" variant="danger">
                                        Log Out
                                    </x-ui.dropdown.item>
                                </form>
                            </x-slot:menu>
                        </x-ui.dropdown>
                    </div>
                </x-ui.layout.header>

                <main class="flex-1 overflow-y-auto p-4 md:p-8">
                    {{ $slot }}
                </main>
            </x-ui.layout.main>
        </x-ui.layout>
        
        <x-toast-notifications />
    </body>
</html>
