<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>
        AMS - Asset Management System
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>

<body class="bg-slate-50">

    {{-- Navbar --}}
    <nav class="bg-white border-b border-slate-200">

        <div
            class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <img
                src="{{ asset('images/ams-logo-1.png') }}"
                alt="AMS"
                class="h-12"
            >

            <a
                href="{{ route('login') }}"
                class="bg-[#0F3D73] hover:bg-[#0A2342] text-white px-5 py-2 rounded-xl">

                Login

            </a>

        </div>

    </nav>

    {{-- Hero --}}
    <section
        class="bg-gradient-to-br from-[#0A2342] via-[#0F3D73] to-[#0077D9]">

        <div
            class="max-w-7xl mx-auto px-6 py-28 text-center text-white">

            <h1
                class="text-5xl md:text-6xl font-bold mb-6">

                Asset Management System

            </h1>

            <p
                class="text-xl text-white/80 max-w-3xl mx-auto mb-10">

                Manage assignments, maintenance,
                asset mutation, and disposal processes
                in one centralized platform.

            </p>

            <a
                href="{{ route('login') }}"
                class="bg-white text-[#0A2342] px-8 py-4 rounded-xl font-semibold hover:bg-slate-100">

                Get Started

            </a>

        </div>

    </section>

    {{-- Features --}}
    <section class="py-20">

        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-12">

                <h2
                    class="text-3xl font-bold mb-3">

                    Core Features

                </h2>

                <p
                    class="text-slate-500">

                    Complete asset lifecycle management.

                </p>

            </div>

            <div
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                    <div class="text-4xl mb-4">📦</div>

                    <h3 class="font-semibold mb-2">
                        Asset Management
                    </h3>

                    <p class="text-slate-500">
                        Manage company assets efficiently.
                    </p>

                </div>

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                    <div class="text-4xl mb-4">👤</div>

                    <h3 class="font-semibold mb-2">
                        Assignments
                    </h3>

                    <p class="text-slate-500">
                        Track asset ownership and responsibility.
                    </p>

                </div>

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                    <div class="text-4xl mb-4">🛠️</div>

                    <h3 class="font-semibold mb-2">
                        Maintenance
                    </h3>

                    <p class="text-slate-500">
                        Monitor maintenance requests and repairs.
                    </p>

                </div>

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                    <div class="text-4xl mb-4">🗑️</div>

                    <h3 class="font-semibold mb-2">
                        Disposal Approval
                    </h3>

                    <p class="text-slate-500">
                        Control asset disposal processes.
                    </p>

                </div>

            </div>

        </div>

    </section>

    {{-- Footer --}}
    <footer
        class="bg-[#0A2342] text-white py-8">

        <div
            class="text-center">

            <p>
                © {{ date('Y') }} AMS - Asset Management System
            </p>

        </div>

    </footer>

</body>

</html>