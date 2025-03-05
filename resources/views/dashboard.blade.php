<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 min-h-screen bg-gray-200 dark:bg-gray-900 p-4">
            <ul>
                <li class="mb-2"><a href="#" class="block p-2 text-gray-800 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-700 rounded">Dashboard</a></li>
                <li class="mb-2"><a href="{{ route('admin.CategoryIndex') }}" class="block p-2 text-gray-800 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-700 rounded">Kategori</a></li>
                <li class="mb-2"><a href="#" class="block p-2 text-gray-800 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-700 rounded">Artikel</a></li>
                <li class="mb-2"><a href="#" class="block p-2 text-gray-800 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-700 rounded">Tracer Studi</a></li>
                <li class="mb-2"><a href="#" class="block p-2 text-gray-800 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-700 rounded">Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-1 py-12 px-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __("You're logged in!") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>