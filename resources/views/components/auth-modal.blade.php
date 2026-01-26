@props(['name' => null])

{{-- Login Modal --}}
<x-modal name="auth-login" :show="session('open_login')">
    <div class="p-6">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-primary">Welcome Back</h2>
            <p class="text-gray-500 text-sm">Please log in to continue</p>
            @if(session('error'))
                 <div class="mt-2 text-sm text-red-600 bg-red-50 p-2 rounded">
                    {{ session('error') }}
                 </div>
            @endif
        </div>

        <form method="POST" action="{{ route('customer.login') }}">
            @csrf
            
            <div class="space-y-4">
                <x-text-input name="email" label="Email" type="email" required placeholder="you@example.com" />
                <x-text-input name="password" label="Password" type="password" required />
            </div>

            <div class="mt-4 flex justify-between items-center text-sm">
                <label class="flex items-center text-gray-600">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-primary shadow-sm focus:ring-primary">
                    <span class="ml-2">Remember me</span>
                </label>
                <a href="#" class="text-primary hover:underline">Forgot password?</a>
            </div>

            <button type="submit" class="w-full mt-6 bg-primary text-white font-bold py-3 rounded-lg hover:opacity-90 transition shadow-lg shadow-primary/30">
                Log In
            </button>
        </form>

        <div class="mt-6 text-center text-sm text-gray-500">
            Don't have an account? 
            <button @click="$dispatch('close'); setTimeout(() => $dispatch('open-modal', 'auth-register'), 300)" class="text-primary font-bold hover:underline">Sign up</button>
        </div>
    </div>
</x-modal>

{{-- Register Modal --}}
<x-modal name="auth-register">
    <div class="p-6">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-primary">Create Account</h2>
            <p class="text-gray-500 text-sm">Join us for delicious food</p>
        </div>

        <form method="POST" action="{{ route('customer.register') }}">
            @csrf
            
            <div class="space-y-4">
                <x-text-input name="name" label="Full Name" type="text" required placeholder="John Doe" />
                <x-text-input name="email" label="Email" type="email" required placeholder="you@example.com" />
                <x-text-input name="phone" label="Phone Number" type="tel" required placeholder="+1234567890" />
                <x-text-input name="password" label="Password" type="password" required />
                <x-text-input name="password_confirmation" label="Confirm Password" type="password" required />
            </div>

            <button type="submit" class="w-full mt-6 bg-primary text-white font-bold py-3 rounded-lg hover:opacity-90 transition shadow-lg shadow-primary/30">
                Sign Up
            </button>
        </form>

        <div class="mt-6 text-center text-sm text-gray-500">
            Already have an account? 
            <button @click="$dispatch('close'); setTimeout(() => $dispatch('open-modal', 'auth-login'), 300)" class="text-primary font-bold hover:underline">Log in</button>
        </div>
    </div>
</x-modal>