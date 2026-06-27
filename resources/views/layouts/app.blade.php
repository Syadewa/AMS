<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>AMS Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-slate-100 font-sans antialiased">

    <div class="flex min-h-screen">

        <!-- SIDEBAR -->
     
<aside class="w-60 shrink-0 bg-slate-900 text-white flex flex-col">

    <!-- Logo -->
    <div class="px-6 py-6 border-b border-slate-800">

        <h1 class="text-3xl font-extrabold tracking-wide">
            AMS
        </h1>

        <p class="text-xs text-slate-400 mt-1">
            Asset Management System
        </p>

    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 py-6 overflow-y-auto">

        @php

            $role = Auth::user()->role;

        @endphp

        <div class="space-y-2">

            <!-- Dashboard -->
            @if($role=='admin')
            <a 
                href="/admin/dashboard"
                class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium
                {{ request()->is('admin/dashboard')
                    ? 'bg-slate-800 text-white'
                    : 'text-slate-300 hover:bg-slate-800'
                }}"
            >
                <span>📊</span>
                <span>Dashboard</span>
            </a>
            @endif

            @if($role == 'user')

                <a
                    href="/user/dashboard"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium
                    {{ request()->is('user/dashboard')
                        ? 'bg-slate-800 text-white'
                        : 'text-slate-300 hover:bg-slate-800'
                    }}"
                >
                    <span>📊</span>
                    <span>Dashboard</span>
                </a>

                <a
                    href="/user/assets"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium
                    {{ request()->is('user/assets*')
                        ? 'bg-slate-800 text-white'
                        : 'text-slate-300 hover:bg-slate-800'
                    }}"
                >
                    <span>💻</span>
                    <span>My Assets</span>
                </a>

                <a
                    href="/user/assignments"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium
                    {{ request()->is('user/assignments*')
                        ? 'bg-slate-800 text-white'
                        : 'text-slate-300 hover:bg-slate-800'
                    }}"
                >
                    <span>📋</span>
                    <span>My Assignments</span>
                </a>

                <a
                    href="/user/mutations"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium
                    {{ request()->is('user/mutations*')
                        ? 'bg-slate-800 text-white'
                        : 'text-slate-300 hover:bg-slate-800'
                    }}"
                >
                    <span>🔄</span>
                    <span>My Mutations</span>
                </a>

                <a
                    href="/user/maintenances"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium
                    {{ request()->is('user/maintenances*')
                        ? 'bg-slate-800 text-white'
                        : 'text-slate-300 hover:bg-slate-800'
                    }}"
                >
                    <span>🛠️</span>
                    <span>My Maintenance</span>
                </a>
            @endif
            @if($role == 'manager')

            <a
                href="/manager/dashboard"
                class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium
                {{ request()->is('manager/dashboard')
                    ? 'bg-slate-800 text-white'
                    : 'text-slate-300 hover:bg-slate-800'
                }}"
            >
                <span>📊</span>
                <span>Dashboard</span>
            </a>

            <div class="mt-6">

                <p class="text-xs uppercase text-slate-500 font-semibold px-4 mb-2">
                    Approval
                </p>

                <a
                    href="/manager/disposals"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium
                    {{ request()->is('manager/disposals*')
                        ? 'bg-slate-800 text-white'
                        : 'text-slate-300 hover:bg-slate-800'
                    }}"
                >
                    <span>🗑️</span>
                    <span>Disposal Requests</span>
                </a>

            </div>

            @endif

            @if($role == 'admin')
            <!-- MASTER DATA -->
            <div>

                <!-- Parent Menu -->
                <button 
                    onclick="document.getElementById('masterDataMenu').classList.toggle('hidden')"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-xl hover:bg-slate-800 transition text-slate-300"
                >

                    <div class="flex items-center gap-3">

                        <span>🗂️</span>
                        <span>Master Data</span>

                    </div>

                    <span>⌄</span>

                </button>

                <!-- Child Menu -->
                <div 
                    id="masterDataMenu"
                    class="hidden mt-2 ml-4 space-y-1"
                >

                    <a 
                        href="/admin/users"
                        class="block px-4 py-2 rounded-lg transition text-sm
                        {{ request()->is('admin/users*')
                            ? 'bg-slate-800 text-white'
                            : 'text-slate-400 hover:bg-slate-800'
                        }}"
                    >
                        Users
                    </a>

                    <a 
                        href="/admin/departments"
                        class="block px-4 py-2 rounded-lg transition text-sm
                        {{ request()->is('admin/departments*')
                            ? 'bg-slate-800 text-white'
                            : 'text-slate-400 hover:bg-slate-800'
                        }}"
                    >
                        Departments
                    </a>

                    <a 
                        href="/admin/assets"
                        class="block px-4 py-2 rounded-lg transition text-sm
                        {{ request()->is('admin/assets*')
                            ? 'bg-slate-800 text-white'
                            : 'text-slate-400 hover:bg-slate-800'
                        }}"
                    >
                        Assets
                    </a>

                    <a 
                        href="/admin/asset-categories"
                        class="block px-4 py-2 rounded-lg transition text-sm
                        {{ request()->is('admin/asset-categories*')
                            ? 'bg-slate-800 text-white'
                            : 'text-slate-400 hover:bg-slate-800'
                        }}"
                    >
                        Categories
                    </a>

                </div>

            </div>

            <!-- TRANSACTIONS -->
            <div>

                <!-- Parent -->
                <button 
                    onclick="document.getElementById('transactionMenu').classList.toggle('hidden')"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-xl hover:bg-slate-800 transition text-slate-300"
                >

                    <div class="flex items-center gap-3">

                        <span>🔄</span>
                        <span>Transactions</span>

                    </div>

                    <span>⌄</span>

                </button>

                <!-- Child -->
                <div 
                    id="transactionMenu"
                    class="hidden mt-2 ml-4 space-y-1"
                >

                    <a 
                        href="/admin/mutations"
                        class="block px-4 py-2 rounded-lg transition text-sm
                        {{ request()->is('admin/mutations*')
                            ? 'bg-slate-800 text-white'
                            : 'text-slate-400 hover:bg-slate-800'
                        }}"
                    >
                        Asset Mutation
                    </a>

                    <a 
                        href="/admin/maintenances"
                        class="block px-4 py-2 rounded-lg transition text-sm
                        {{ request()->is('admin/maintenances*')
                            ? 'bg-slate-800 text-white'
                            : 'text-slate-400 hover:bg-slate-800'
                        }}"
                    >
                        Maintenance
                    </a>

                    <a 
                        href="/admin/assignments"
                        class="block px-4 py-2 rounded-lg transition text-sm
                        {{ request()->is('admin/assignments*')
                            ? 'bg-slate-800 text-white'
                            : 'text-slate-400 hover:bg-slate-800'
                        }}"
                    >
                        Asset Assignment
                    </a>

                    <a 
                        href="/admin/disposals"
                        class="block px-4 py-2 rounded-lg transition text-sm
                        {{ request()->is('admin/disposals*')
                            ? 'bg-slate-800 text-white'
                            : 'text-slate-400 hover:bg-slate-800'
                        }}"
                    >
                        Asset Disposal
                    </a>

                </div>

            </div>

            <!-- REPORTS -->
            <div>

                <!-- Parent -->
                <button 
                    onclick="document.getElementById('reportMenu').classList.toggle('hidden')"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-xl hover:bg-slate-800 transition text-slate-300"
                >

                    <div class="flex items-center gap-3">

                        <span>📄</span>
                        <span>Reports</span>

                    </div>

                    <span>⌄</span>

                </button>

                <!-- Child -->
                <div 
                    id="reportMenu"
                    class="hidden mt-2 ml-4 space-y-1"
                >

                    <a 
                        href="/admin/reports/"
                        class="block px-4 py-2 rounded-lg transition text-sm
                        {{ request()->is('admin/reports*')
                            ? 'bg-slate-800 text-white'
                            : 'text-slate-400 hover:bg-slate-800'
                        }}"
                    >
                        Asset Reports
                    </a>

                    
                </div>

            </div>
            @endif

            
        </div>

    </nav>

</aside>

        <!-- MAIN -->
        <div class="flex-1 flex flex-col">

            <!-- TOPBAR -->
            <header class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-8">

                <!-- Left -->
                <div>

                    @php

                        $pageTitle = 'Dashboard';
                        $pageDescription = 'Asset Management System';

                        /*
                        |--------------------------------------------------------------------------
                        | ADMIN
                        |--------------------------------------------------------------------------
                        */

                        if(request()->is('admin/dashboard')) {

                            $pageTitle = 'Dashboard';
                            $pageDescription = 'AMS Administrator Panel';

                        }

                        elseif(request()->is('admin/assets*')) {

                            $pageTitle = 'Assets';
                            $pageDescription = 'Manage company assets';

                        }

                        elseif(request()->is('admin/users*')) {

                            $pageTitle = 'Users';
                            $pageDescription = 'Manage system users';

                        }

                        elseif(request()->is('admin/departments*')) {

                            $pageTitle = 'Departments';
                            $pageDescription = 'Manage departments';

                        }

                        elseif(request()->is('admin/asset-categories*')) {

                            $pageTitle = 'Asset Categories';
                            $pageDescription = 'Manage asset categories';

                        }

                        elseif(request()->is('admin/assignments*')) {

                            $pageTitle = 'Assignments';
                            $pageDescription = 'Manage asset assignments';

                        }

                        elseif(request()->is('admin/mutations*')) {

                            $pageTitle = 'Mutations';
                            $pageDescription = 'Manage asset mutations';

                        }

                        elseif(request()->is('admin/maintenances*')) {

                            $pageTitle = 'Maintenances';
                            $pageDescription = 'Manage maintenance requests';

                        }

                        elseif(request()->is('admin/disposals*')) {

                            $pageTitle = 'Disposals';
                            $pageDescription = 'Manage disposal requests';

                        }

                        elseif(request()->is('admin/reports*')) {

                            $pageTitle = 'Reports';
                            $pageDescription = 'Generate system reports';

                        }

                        /*
                        |--------------------------------------------------------------------------
                        | USER
                        |--------------------------------------------------------------------------
                        */

                        elseif(request()->is('user/dashboard')) {

                            $pageTitle = 'Dashboard';
                            $pageDescription = 'Overview of your asset activities';

                        }

                        elseif(request()->is('user/assets*')) {

                            $pageTitle = 'My Assets';
                            $pageDescription = 'View assets assigned to you';

                        }

                        elseif(request()->is('user/assignments*')) {

                            $pageTitle = 'My Assignments';
                            $pageDescription = 'Review your asset assignments';

                        }

                        elseif(request()->is('user/mutations*')) {

                            $pageTitle = 'My Mutations';
                            $pageDescription = 'Review asset transfer requests';

                        }

                        elseif(request()->is('user/maintenances*')) {

                            $pageTitle = 'My Maintenance';
                            $pageDescription = 'Manage maintenance requests';

                        }

                                            /*
                    |--------------------------------------------------------------------------
                    | MANAGER
                    |--------------------------------------------------------------------------
                    */

                    elseif(request()->is('manager/dashboard')) {

                        $pageTitle = 'Manager Dashboard';

                        $pageDescription =
                            'Asset monitoring and disposal approval overview';

                    }

                    elseif(request()->is('manager/disposals*')) {

                        $pageTitle = 'Disposal Requests';

                        $pageDescription =
                            'Review and approve asset disposal requests';

                    }

                    @endphp

                        <h2 class="text-2xl font-bold text-slate-800">
                            {{ $pageTitle }}
                        </h2>

                        <p class="text-sm text-slate-500">
                            {{ $pageDescription }}
                        </p>

                </div>

                <!-- Right -->
                <div class="relative">

                    <!-- Dropdown Button -->
                    <button 
                        onclick="document.getElementById('profileDropdown').classList.toggle('hidden')"
                        class="flex items-center gap-3 hover:bg-slate-100 px-3 py-2 rounded-xl transition"
                    >

                        <div class="text-right hidden sm:block">

                            <p class="text-sm font-semibold text-slate-800">
                                {{ Auth::user()->name }}
                            </p>

                            <p class="text-xs text-slate-500">
                                {{ Auth::user()->role }}
                            </p>

                        </div>

                        <div class="w-11 h-11 rounded-full bg-slate-300"></div>

                    </button>

                    <!-- Dropdown -->
                    <div 
                        id="profileDropdown"
                        class="hidden absolute right-0 mt-3 w-52 bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden z-50"
                    >

                        <a 
                            href="/profile"
                            class="block px-5 py-3 text-sm hover:bg-slate-100 transition"
                        >
                            Profile
                        </a>

                        <form method="POST" action="{{ route('logout') }}">

                            @csrf

                            <button 
                                type="submit"
                                class="w-full text-left px-5 py-3 text-sm hover:bg-slate-100 transition"
                            >
                                Logout
                            </button>

                        </form>

                    </div>

                </div>

            </header>

            <!-- CONTENT -->
            <main class="flex-1 px-8 py-5 overflow-y-auto">

                {{ $slot }}

            </main>

        </div>

    </div>

</body>
</html>