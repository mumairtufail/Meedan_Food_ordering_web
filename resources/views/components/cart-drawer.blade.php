@props(['show' => false])

<div 
    x-data="{ show: false }"
    @open-cart.window="show = true"
    @keydown.escape.window="show = false"
    class="relative z-50" 
    aria-labelledby="slide-over-title" 
    role="dialog" 
    aria-modal="true"
    style="display: none;"
    x-show="show"
>
    <div 
        x-show="show"
        x-transition:enter="ease-in-out duration-500"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in-out duration-500"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" 
        @click="show = false"
    ></div>

    <div class="fixed inset-0 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                <div 
                    x-show="show"
                    x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                    x-transition:enter-start="translate-x-full"
                    x-transition:enter-end="translate-x-0"
                    x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                    x-transition:leave-start="translate-x-0"
                    x-transition:leave-end="translate-x-full"
                    class="pointer-events-auto w-screen max-w-md"
                >
                    <div class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
                        <div class="flex-1 overflow-y-auto px-4 py-6 sm:px-6">
                            <div class="flex items-start justify-between">
                                <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">Shopping Cart</h2>
                                <div class="ml-3 flex h-7 items-center">
                                    <button type="button" @click="show = false" class="relative -m-2 p-2 text-gray-400 hover:text-gray-500">
                                        <span class="absolute -inset-0.5"></span>
                                        <span class="sr-only">Close panel</span>
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="mt-8">
                                <div class="flow-root">
                                    @if(Auth::guard('customer')->check() && session()->has('cart_' . Auth::guard('customer')->id()) && count(session('cart_' . Auth::guard('customer')->id())) > 0)
                                        <ul role="list" class="-my-6 divide-y divide-gray-200">
                                            @foreach(session('cart_' . Auth::guard('customer')->id()) as $key => $item)
                                                <li class="flex py-6">
                                                    <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                                                        <img src="{{ isset($item['image']) ? asset('storage/' . $item['image']) : 'https://placehold.co/100x100' }}" alt="{{ $item['name'] }}" class="h-full w-full object-cover object-center">
                                                    </div>

                                                    <div class="ml-4 flex flex-1 flex-col">
                                                        <div>
                                                            <div class="flex justify-between text-base font-medium text-gray-900">
                                                                <h3>
                                                                    <a href="#">{{ $item['name'] }}</a>
                                                                </h3>
                                                                <p class="ml-4">${{ number_format($item['price'], 2) }}</p>
                                                            </div>
                                                            @if(!empty($item['addons']))
                                                                <p class="mt-1 text-sm text-gray-500">{{ count($item['addons']) }} addons selected</p>
                                                            @endif
                                                        </div>
                                                        <div class="flex flex-1 items-end justify-between text-sm">
                                                            <p class="text-gray-500">Qty {{ $item['quantity'] }}</p>

                                                            <div class="flex">
                                                                <button type="button" class="font-medium text-primary hover:text-primary/80">Remove</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <div class="text-center py-12">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                            </svg>
                                            <h3 class="mt-2 text-sm font-semibold text-gray-900">Cart is empty</h3>
                                            <p class="mt-1 text-sm text-gray-500">Start adding some delicious items!</p>
                                            <div class="mt-6">
                                                <button @click="show = false" class="inline-flex items-center rounded-md bg-primary px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary/80 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary">
                                                    Browse Menu
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if(Auth::guard('customer')->check() && session()->has('cart_' . Auth::guard('customer')->id()) && count(session('cart_' . Auth::guard('customer')->id())) > 0)
                            <div class="border-t border-gray-200 px-4 py-6 sm:px-6">
                                <div class="flex justify-between text-base font-medium text-gray-900">
                                    <p>Subtotal</p>
                                    @php
                                        $total = 0;
                                        foreach(session('cart_' . Auth::guard('customer')->id()) as $item) {
                                            $total += $item['price'] * $item['quantity'];
                                            // Addons are missing price in cart session in basic implementation
                                        }
                                    @endphp
                                    <p>${{ number_format($total, 2) }}</p>
                                </div>
                                <p class="mt-0.5 text-sm text-gray-500">Shipping and taxes calculated at checkout.</p>
                                <div class="mt-6">
                                    <a href="#" class="flex items-center justify-center rounded-md border border-transparent bg-primary px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-primary/90">Checkout</a>
                                </div>
                                <div class="mt-6 flex justify-center text-center text-sm text-gray-500">
                                    <p>
                                        or
                                        <button type="button" class="font-medium text-primary hover:text-primary/80" @click="show = false">
                                            Continue Ordering
                                            <span aria-hidden="true"> &rarr;</span>
                                        </button>
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
