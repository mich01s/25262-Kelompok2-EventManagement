<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-6xl rounded-[40px] overflow-hidden shadow-[0_35px_120px_-40px_rgba(35,0,77,0.35)] bg-white">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <div class="relative overflow-hidden bg-gradient-to-br from-rose-500 to-orange-500 text-white p-10 sm:p-14 xl:p-16">
                    <div class="absolute inset-x-0 top-0 h-40 bg-white/10 blur-3xl"></div>
                    <div class="relative z-10 flex h-full flex-col justify-between">
                        <div>
                            <h2 class="text-4xl font-extrabold">Welcome Back!</h2>
                            <p class="mt-4 text-base leading-relaxed text-white/90">To keep connected with us please login with your personal info.</p>
                        </div>
                        <div class="mt-10">
                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-full border border-white/80 bg-white/10 px-7 py-3 text-sm font-semibold text-white transition hover:bg-white/20">Sign In</a>
                        </div>
                    </div>
                </div>

                <div class="p-10 sm:p-14 xl:p-16">
                    <div class="mb-8">
                        <h1 class="text-4xl font-extrabold text-slate-900">Create Account</h1>
                        <p class="mt-3 text-sm text-slate-500">Use your email for registration. Already have an account? <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">Sign in</a></p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="space-y-5">
                        @csrf

                        <div>
                            <label for="username" class="block text-sm font-medium text-slate-700">Username</label>
                            <x-text-input id="username" class="mt-3 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 focus:border-indigo-500 focus:ring-indigo-500" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('username')" class="mt-2 text-sm text-red-600" />
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                            <x-text-input id="email" class="mt-3 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 focus:border-indigo-500 focus:ring-indigo-500" type="email" name="email" :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                            <x-text-input id="password" class="mt-3 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 focus:border-indigo-500 focus:ring-indigo-500" type="password" name="password" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-slate-700">Confirm Password</label>
                            <x-text-input id="password_confirmation" class="mt-3 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 focus:border-indigo-500 focus:ring-indigo-500" type="password" name="password_confirmation" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-600" />
                        </div>

                        <div>
                            <label for="role" class="block text-sm font-medium text-slate-700">Role</label>
                            <select id="role" name="role" class="mt-3 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="">Select role</option>
                                <option value="user">User</option>
                                <option value="event_organizer">Event Organizer</option>
                                <option value="admin">Admin</option>
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-2 text-sm text-red-600" />
                        </div>

                        <div>
                            <x-primary-button class="w-full rounded-3xl bg-slate-900 py-3 text-sm font-semibold text-white hover:bg-slate-800">
                                {{ __('Register') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
