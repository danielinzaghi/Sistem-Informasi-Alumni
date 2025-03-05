<x-guest-layout>
    <div class="mb-4 text-sm text-gray-700 text-center px-4">
        {{ __('Lupa kata sandi? Tidak masalah. Masukkan alamat email Anda, dan kami akan mengirimkan tautan untuk mereset kata sandi Anda.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-[#047857] font-semibold" />
            <x-text-input id="email" class="block mt-1 w-full border-gray-300 focus:border-[#047857] focus:ring-[#047857] rounded-lg" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex flex-col items-center justify-center space-y-4">
            <button type="submit" class="w-full bg-[#047857] hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                {{ __('Kirim Tautan Reset Password') }}
            </button>
        </div>
    </form>
</x-guest-layout>
