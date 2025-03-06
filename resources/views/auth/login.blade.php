<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-[#1e40af] font-semibold" />
            <x-text-input id="email" class="block mt-1 w-full border-gray-300 focus:border-green focus:ring-[#1e40af] rounded-lg" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-blue-800 font-semibold" />
            <x-text-input id="password" class="block mt-1 w-full border-gray-300 text-blue-800 focus:ring-[#1e40af] rounded-lg"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-800  shadow-sm focus:ring-[#1e40af]" name="remember">
            <label for="remember_me" class="ml-2 text-sm text-gray-700">{{ __('Ingat Saya') }}</label>
        </div>

        <div class="flex flex-col items-center justify-center space-y-4">
            @if (Route::has('password.request'))
                <a class="text-sm text-blue-800 hover:underline" href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
            @endif

            <button type="submit" class="w-full bg-[#1e40af] hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                {{ __('Log in') }}
            </button>
        </div>
    </form>
</x-guest-layout>
