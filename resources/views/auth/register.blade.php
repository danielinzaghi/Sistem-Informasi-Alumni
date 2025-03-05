<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama')" class="text-[#047857] font-semibold" />
            <x-text-input id="name"
                class="block mt-1 w-full border-gray-300 focus:border-[#047857] focus:ring-[#047857] rounded-lg"
                type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-[#047857] font-semibold" />
            <x-text-input id="email"
                class="block mt-1 w-full border-gray-300 focus:border-[#047857] focus:ring-[#047857] rounded-lg"
                type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-[#047857] font-semibold" />
            <x-text-input id="password"
                class="block mt-1 w-full border-gray-300 focus:border-[#047857] focus:ring-[#047857] rounded-lg"
                type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-[#047857] font-semibold" />
            <x-text-input id="password_confirmation"
                class="block mt-1 w-full border-gray-300 focus:border-[#047857] focus:ring-[#047857] rounded-lg"
                type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-col sm:flex-row items-center justify-between">
            <a class="text-sm text-gray-600 hover:text-[#047857] transition duration-200" href="{{ route('login') }}">
                {{ __('Sudah punya akun?') }}
            </a>

            <button type="submit"
                class="mt-4 sm:mt-0 w-full sm:w-auto bg-[#047857] hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-200">
                {{ __('Daftar') }}
            </button>
        </div>
    </form>
</x-guest-layout>
