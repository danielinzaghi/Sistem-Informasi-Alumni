<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama')" class="text-[#1e40af] font-semibold" />
            <x-text-input id="name"
                class="block mt-1 w-full border-gray-300 focus:border-[#1e40af] focus:ring-[#1e40af] rounded-lg"
                type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-[#1e40af] font-semibold" />
            <x-text-input id="email"
                class="block mt-1 w-full border-gray-300 focus:border-[#1e40af] focus:ring-[#1e40af] rounded-lg"
                type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-[#1e40af] font-semibold" />
            <x-text-input id="password"
                class="block mt-1 w-full border-gray-300 focus:border-[#1e40af] focus:ring-[#1e40af] rounded-lg"
                type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-[#1e40af] font-semibold" />
            <x-text-input id="password_confirmation"
                class="block mt-1 w-full border-gray-300 focus:border-[#1e40af] focus:ring-[#1e40af] rounded-lg"
                type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-col items-center justify-center space-y-4">
            <button type="submit" class="w-full bg-[#1e40af] hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                {{ __('Daftar') }}
            </button>
            
            <p class="text-sm text-gray-600">
                {{ __('Sudah punya akun?') }}
                <a href="{{ route('login') }}" class="text-blue-800 font-semibold hover:underline">
                    {{ __('Login') }}
                </a>
            </p>

        </div>
    </form>
</x-guest-layout>
