<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-text-input 
                id="update_password_current_password" 
                name="current_password" 
                label="{{ __('Current Password') }}"
                type="password" 
                class="mb-1 block w-full" 
                autocomplete="current-password" 
            />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mb-3" />
        </div>

        <div>
            <x-text-input 
                id="update_password_password" 
                name="password" 
                label="{{ __('New Password') }}"
                type="password" 
                class="mb-1 block w-full" 
                autocomplete="new-password" 
            />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mb-3" />
        </div>

        <div>
            <x-text-input 
                id="update_password_password_confirmation" 
                name="password_confirmation" 
                label="{{ __('Confirm Password') }}"
                type="password" 
                class="mb-1 block w-full" 
                autocomplete="new-password" 
            />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mb-3" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
