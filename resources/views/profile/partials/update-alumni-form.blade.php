<section>
    <header>
        <h2 class="text-lg font-semibold text-[#00593b]">
            {{ __('Alumni Profile') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Informasi profil alumni.') }}
        </p>
    </header>

    <div x-data="{ editMode: false }">
        <!-- Tampilan Informasi Alumni -->
        <div x-show="!editMode" class="mt-4 bg-gray-100 p-4 rounded-md">
            <p class="text-sm text-gray-800"><strong>{{ __('Nama') }}:</strong> {{ $user->name ?? '-' }}</p>
            <p class="text-sm text-gray-800"><strong>{{ __('Tahun Lulus') }}:</strong> {{ $alumni->tahun_lulus ?? '-' }}</p>
            <p class="text-sm text-gray-800"><strong>{{ __('Pekerjaan') }}:</strong> {{ $alumni->pekerjaan ?? '-' }}</p>
            <p class="text-sm text-gray-800"><strong>{{ __('Instansi') }}:</strong> {{ $alumni->instansi ?? '-' }}</p>
            <p class="text-sm text-gray-800"><strong>{{ __('NIK') }}:</strong> {{ $alumni->nik ?? '-' }}</p>
            <p class="text-sm text-gray-800"><strong>{{ __('NPWP') }}:</strong> {{ $alumni->npwp ?? '-' }}</p>
        </div>

        <!-- Tombol Edit -->
        <div class="mt-4">
            <x-primary-button @click="editMode = true"
                class="bg-[#00593b] text-white hover:bg-[#00432e] focus:ring-[#00593b]">
                {{ __('Edit Profile') }}
            </x-primary-button>
        </div>

        <!-- Form Edit Alumni -->
        <form x-show="editMode" x-transition method="post" action="{{ route('profile.update', $alumni->id) }}"
            class="mt-6 space-y-6 bg-white p-6 rounded-lg shadow">

            @csrf
            @method('patch')

            <div>
                <x-input-label for="name" :value="__('Nama')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" 
                    :value="old('name', $user->name)" required autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="tahun_lulus" :value="__('Tahun Lulus')" />
                <x-text-input id="tahun_lulus" name="tahun_lulus" type="number" class="mt-1 block w-full"
                    :value="old('tahun_lulus', $alumni->tahun_lulus)" required autocomplete="tahun_lulus" />
                <x-input-error class="mt-2" :messages="$errors->get('tahun_lulus')" />
            </div>

            <div>
                <x-input-label for="pekerjaan" :value="__('Pekerjaan')" />
                <x-text-input id="pekerjaan" name="pekerjaan" type="text" class="mt-1 block w-full" 
                    :value="old('pekerjaan', $alumni->pekerjaan)" required autocomplete="pekerjaan" />
                <x-input-error class="mt-2" :messages="$errors->get('pekerjaan')" />
            </div>

            <div>
                <x-input-label for="instansi" :value="__('Instansi')" />
                <x-text-input id="instansi" name="instansi" type="text" class="mt-1 block w-full" 
                    :value="old('instansi', $alumni->instansi)" required autocomplete="instansi" />
                <x-input-error class="mt-2" :messages="$errors->get('instansi')" />
            </div>

            <div>
                <x-input-label for="nik" :value="__('NIK')" />
                <x-text-input id="nik" name="nik" type="number" class="mt-1 block w-full"
                    :value="old('nik', $alumni->nik)" required autocomplete="nik" />
                <x-input-error class="mt-2" :messages="$errors->get('nik')" />
            </div>

            <div>
                <x-input-label for="npwp" :value="__('NPWP')" />
                <x-text-input id="npwp" name="npwp" type="number" class="mt-1 block w-full"
                    :value="old('npwp', $alumni->npwp)" required autocomplete="npwp" />
                <x-input-error class="mt-2" :messages="$errors->get('npwp')" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button class="bg-[#00593b] text-white hover:bg-[#00432e] focus:ring-[#00593b]">
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
                            <path d="M14.348 5.652a1 1 0 010 1.414L11.414 10l2.934 2.934a1 1 0 01-1.414 1.414L10 11.414l-2.934 2.934a1 1 0 01-1.414-1.414L8.586 10 5.652 7.066a1 1 0 111.414-1.414L10 8.586l2.934-2.934a1 1 0 011.414 0z" />
                        </svg>
                    </button>
                </div>
            @endif
        </form>
    </div>
</section>
