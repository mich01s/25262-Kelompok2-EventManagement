<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-lg font-medium">{{ $user->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $user->email }}</p>
                        </div>
                        <div>
                            <p><strong>Role:</strong> {{ $user->role ?? 'User' }}</p>
                            <p><strong>Terdaftar sejak:</strong> {{ $user->created_at->format('d M Y') }}</p>
                        </div>
                        <div>
                            <a href="{{ route('profile.edit') }}" class="underline text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
