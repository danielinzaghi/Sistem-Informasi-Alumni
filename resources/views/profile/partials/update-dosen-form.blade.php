<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Dosen Profile') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Informasi profil dosen.') }}
        </p>
    </header>

    <div class="mt-6 space-y-6">
        <div>
            <x-input-label for="name" :value="__('Nama')" />
            <p class="mt-1 text-gray-800 dark:text-gray-200">{{ $user->name ?? '-' }}</p>
        </div>

        <div>
            <x-input-label for="nidn" :value="__('NIDN')" />
            <p class="mt-1 text-gray-800 dark:text-gray-200">{{ $dosen->nidn ?? '-' }}</p>
        </div>
    </div>
</section>
