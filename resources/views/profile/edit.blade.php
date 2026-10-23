<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 leading-tight">
                {{ __('Profile') }}
            </h2>
            <p class="text-sm text-gray-500 mt-0.5">Manage your account information and security.</p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Profile Summary -->
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-indigo-600 to-indigo-800 p-8 text-white shadow-lg">
                <div class="absolute -top-16 -right-16 h-56 w-56 rounded-full bg-white/10"></div>
                <div class="absolute -bottom-20 right-28 h-40 w-40 rounded-full bg-white/5"></div>

                <div class="relative flex items-center gap-5">
                    <span class="flex items-center justify-center h-20 w-20 rounded-full bg-white/20 ring-4 ring-white/30 text-3xl font-bold">
                        {{ strtoupper(mb_substr(Auth::user()->name, 0, 1)) }}
                    </span>
                    <div class="min-w-0">
                        <h3 class="text-2xl font-bold truncate">{{ Auth::user()->name }}</h3>
                        <p class="text-indigo-100 truncate">{{ Auth::user()->email }}</p>
                        <span class="inline-block mt-2 px-3 py-0.5 rounded-full bg-white/20 text-xs font-medium capitalize">
                            {{ Auth::user()->role }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Profile Information -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account -->
            <div class="bg-white rounded-2xl border border-red-100 shadow-sm p-6 sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
