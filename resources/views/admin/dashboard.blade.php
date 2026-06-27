<x-app-layout>

    <div class="p-6">

        <h1 class="text-3xl font-bold mb-6">
            Dashboard Admin
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition">

                <h2 class="text-slate-500 text-sm">
                    Total Asset
                </h2>

                <p class="text-3xl font-bold mt-2">
                    {{ $totalAssets }}
                </p>

            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition">

                <h2 class="text-slate-500 text-sm">
                    Asset Aktif
                </h2>

                <p class="text-3xl font-bold mt-2">
                    {{ $activeAssets }}
                </p>

            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition">

                <h2 class="text-slate-500 text-sm">
                    Asset Dilepas
                </h2>

                <p class="text-3xl font-bold mt-2">
                    {{ $disposedAssets }}
                </p>

            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition">

                <h2 class="text-slate-500 text-sm">
                    Total Department
                </h2>

                <p class="text-3xl font-bold mt-2">
                    {{ $totalDepartments }}
                </p>

            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition">

                <h2 class="text-slate-500 text-sm">
                    Assignment Aktif
                </h2>

                <p class="text-3xl font-bold mt-2">
                    {{ $activeAssignments }}
                </p>

            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition">

                <h2 class="text-slate-500 text-sm">
                    Maintenance Pending
                </h2>

                <p class="text-3xl font-bold mt-2">
                    {{ $pendingMaintenances }}
                </p>

            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition">

                <h2 class="text-slate-500 text-sm">
                    Disposal Pending
                </h2>

                <p class="text-3xl font-bold mt-2">
                    {{ $pendingDisposals }}
                </p>

            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition">

                <h2 class="text-slate-500 text-sm">
                    User Aktif
                </h2>

                <p class="text-3xl font-bold mt-2">
                    {{ $activeUsers }}
                </p>

            </div>

        </div>

    </div>

</x-app-layout>