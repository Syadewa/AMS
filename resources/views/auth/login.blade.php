<x-guest-layout>

    <div class="min-h-screen flex bg-slate-50">

        {{-- Left Branding --}}
        <div
            class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-[#0A2342] via-[#0F3D73] to-[#0077D9] relative overflow-hidden">

            <div
                class="relative z-10 flex flex-col justify-center px-20 text-white">

                <img
                    src="{{ asset('images/ams-logo.png') }}"
                    alt="AMS Logo"
                    class="w-100 mb-30"
                >

                <h2
                    class="text-4xl font-bold mb-4 leading-tight">
                    Asset Management System
                </h2>

                <p
                    class="text-lg text-white/80 max-w-lg">
                    Manage company assets efficiently through
                    assignment management, maintenance tracking,
                    asset mutation, and disposal approval in one
                    integrated platform.
                </p>

            </div>

        </div>

        {{-- Login Form --}}
        <div
            class="w-full lg:w-1/2 flex items-center justify-center px-6 py-12">

            <div
                class="w-full max-w-md bg-white rounded-3xl border border-slate-200 shadow-xl p-8">

                <div class="text-center mb-8">

                    <img
                        src="{{ asset('images/ams-logo.png') }}"
                        alt="AMS"
                        class="h-16 mx-auto mb-4 lg:hidden"
                    >

                    <h2
                        class="text-3xl font-bold text-slate-900">
                        Welcome Back
                    </h2>

                    <p
                        class="text-slate-500 mt-2">
                        Sign in to continue to AMS
                    </p>

                </div>

                <x-auth-session-status
                    class="mb-4"
                    :status="session('status')" />

                <form
                    method="POST"
                    action="{{ route('login') }}"
                    class="space-y-5">

                    @csrf

                    <div>

                        <x-input-label
                            for="email"
                            :value="__('Email Address')" />

                        <x-text-input
                            id="email"
                            class="block mt-2 w-full rounded-xl border-slate-300"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
                            autofocus
                            autocomplete="username" />

                        <x-input-error
                            :messages="$errors->get('email')"
                            class="mt-2" />

                    </div>

                    <div>

                        <x-input-label
                            for="password"
                            :value="__('Password')" />

                        <x-text-input
                            id="password"
                            class="block mt-2 w-full rounded-xl border-slate-300"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password" />

                        <x-input-error
                            :messages="$errors->get('password')"
                            class="mt-2" />

                    </div>

                    <div
                        class="flex items-center justify-between">

                        <label
                            for="remember_me"
                            class="inline-flex items-center">

                            <input
                                id="remember_me"
                                type="checkbox"
                                class="rounded border-slate-300"
                                name="remember">

                            <span
                                class="ml-2 text-sm text-slate-600">
                                Remember me
                            </span>

                        </label>

                       {{-- @if(Route::has('password.request'))

                            <a
                                href="{{ route('password.request') }}"
                                class="text-sm text-[#0077D9] hover:text-[#0A2342]">

                                Forgot Password?

                            </a>

                        @endif --}}

                    </div>

                    <button
                        type="submit"
                        class="w-full bg-[#0F3D73] hover:bg-[#0A2342] text-white py-3 rounded-xl font-medium transition">

                        Sign In

                    </button>

                </form>

            </div>

        </div>

    </div>

</x-guest-layout>