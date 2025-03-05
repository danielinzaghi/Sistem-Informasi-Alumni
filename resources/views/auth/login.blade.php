<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-[#047857] font-semibold" />
            <x-text-input id="email" class="block mt-1 w-full border-gray-300 focus:border-[#047857] focus:ring-[#047857] rounded-lg" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-[#047857] font-semibold" />
            <x-text-input id="password" class="block mt-1 w-full border-gray-300 focus:border-[#047857] focus:ring-[#047857] rounded-lg"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-[#047857] shadow-sm focus:ring-[#047857]" name="remember">
            <label for="remember_me" class="ml-2 text-sm text-gray-700">{{ __('Ingat Saya') }}</label>
        </div>

        <div class="flex flex-col items-center justify-center space-y-4">
            @if (Route::has('password.request'))
                <a class="text-sm text-[#047857] hover:underline" href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
            @endif

            <button type="submit" class="w-full bg-[#047857] hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                {{ __('Log in') }}
            </button>

            <!-- Link ke Halaman Register -->
            <p class="text-sm text-gray-600">
                {{ __('Belum punya akun?') }}
                <a href="{{ route('register') }}" class="text-[#047857] font-semibold hover:underline">
                    {{ __('Daftar') }}
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
