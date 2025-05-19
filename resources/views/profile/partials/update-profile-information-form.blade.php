<section>
    <header>
        <h2 class="text-lg font-semibold text-[#1e40af]">
            {{ __('Profile Information') }}
        </h2>

    </header>

    <div x-data="{ editMode: false }">
        <!-- Tampilan Informasi Profil -->
        <div x-show="!editMode" class="mt-4 bg-gray-100  p-4 rounded-md">
            <p class="text-sm text-gray-800">
                <strong>{{ __('Name') }}:</strong> {{ $user->name }}
            </p>
            <p class="text-sm text-gray-800">
                <strong>{{ __('Email') }}:</strong> {{ $user->email }}
            </p>

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <p class="text-sm mt-2 text-gray-700">
                    {{ __('Your email address is unverified.') }}
                    <button form="send-verification" class="underline text-sm text-gray-500 hover:text-gray-700">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>

        <!-- Tombol Edit -->
        <div class="mt-4">
            <x-primary-button @click="editMode = true"
                class="bg-[#1e40af] text-white hover:bg-[#5079ff] focus:ring-[#1e40af]">
                {{ __('Edit Profile') }}
            </x-primary-button>
        </div>

        <!-- Form Edit Profil -->
        <form x-show="editMode" x-transition method="post" action="{{ route('profile.update') }}"
            class="mt-6 space-y-6 bg-white  p-6 rounded-lg shadow">

            @csrf
            @method('patch')

            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                    required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                    required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button class="bg-[#1e40af] text-white hover:bg-[#5079ff] focus:ring-[#1e40af]">
                    {{ __('Save') }}
                </x-primary-button>

                <x-secondary-button @click="editMode = false"
                    class="text-gray-500 border border-gray-300 bg-white hover:bg-gray-100 hover:text-gray-700">
                    {{ __('Cancel') }}
                </x-secondary-button>

            </div>

            @if (session('status') === 'profile-updated')
                <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                    class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4"
                    role="alert">
                    <strong class="font-bold">Success! </strong>
                    <span class="block sm:inline">{{ __('Profile updated successfully.') }}</span>
                    <button @click="show = false" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-green-500" role="button"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <title>Close</title>
                            <path
                                d="M14.348 5.652a1 1 0 010 1.414L11.414 10l2.934 2.934a1 1 0 01-1.414 1.414L10 11.414l-2.934 2.934a1 1 0 01-1.414-1.414L8.586 10 5.652 7.066a1 1 0 111.414-1.414L10 8.586l2.934-2.934a1 1 0 011.414 0z" />
                        </svg>
                    </button>
                </div>
            @endif
                
        </form>

    </div>
</section>
