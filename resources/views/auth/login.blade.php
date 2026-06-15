<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-6xl rounded-[40px] overflow-hidden shadow-[0_35px_120px_-40px_rgba(35,0,77,0.35)] bg-white">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <div class="p-10 sm:p-14 xl:p-16">
                    <div class="mb-8">
                        <h1 class="text-4xl font-extrabold text-slate-900">Sign in</h1>
                        <p class="mt-3 text-sm text-slate-500">or use your account</p>
                    </div>

                    <div class="flex gap-3 mb-8">
                        <a href="#" class="flex h-11 w-11 items-center justify-center rounded-full border border-slate-200 text-slate-700 hover:border-slate-300">
                            F
                        </a>
                        <a href="#" class="flex h-11 w-11 items-center justify-center rounded-full border border-slate-200 text-slate-700 hover:border-slate-300">
                            G+
                        </a>
                        <a href="#" class="flex h-11 w-11 items-center justify-center rounded-full border border-slate-200 text-slate-700 hover:border-slate-300">
                            in
                        </a>
                    </div>

                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                            <x-text-input id="email" class="mt-3 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 focus:border-indigo-500 focus:ring-indigo-500" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                            <x-text-input id="password" class="mt-3 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-900 focus:border-indigo-500 focus:ring-indigo-500" type="password" name="password" required autocomplete="current-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
                        </div>

                        <div class="flex items-center justify-between">
                            <label for="remember_me" class="inline-flex items-center gap-2 text-sm text-slate-600">
                                <input id="remember_me" type="checkbox" class="h-4 w-4 rounded border-slate-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                Remember me
                            </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Forgot your password?</a>
                            @endif
                        </div>

                        <div>
                            <x-primary-button class="w-full rounded-3xl bg-slate-900 py-3 text-sm font-semibold text-white hover:bg-slate-800">
                                {{ __('Sign In') }}
                            </x-primary-button>
                        </div>
                    </form>

                    <p class="mt-8 text-center text-sm text-slate-500">Belum punya akun? <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">Daftar di sini</a></p>
                </div>

                <div class="relative overflow-hidden bg-gradient-to-br from-rose-500 to-orange-500 text-white p-10 sm:p-14 xl:p-16">
                    <div class="absolute inset-x-0 top-0 h-40 bg-white/10 blur-3xl"></div>
                    <div class="relative z-10 flex h-full flex-col justify-between">
                        <div>
                            <h2 class="text-4xl font-extrabold">Hello, Friend!</h2>
                            <p class="mt-4 text-base leading-relaxed text-white/90">Enter your personal details and start your journey with us.</p>
                        </div>
                        <div class="mt-10">
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-full border border-white/80 bg-white/10 px-7 py-3 text-sm font-semibold text-white transition hover:bg-white/20">Register</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>

