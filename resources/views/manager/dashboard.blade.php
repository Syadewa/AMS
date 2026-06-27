<x-app-layout>

    <div class="space-y-6">

        <div>

            <h1 class="text-2xl font-bold text-slate-800">
                Manager Dashboard
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Asset monitoring and disposal approval overview.
            </p>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

            {{-- Total Assets --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                <p class="text-sm text-slate-500">
                    Total Assets
                </p>

                <h2 class="text-3xl font-bold text-slate-800 mt-2">
                    {{ $totalAssets }}
                </h2>

            </div>

            {{-- Under Maintenance --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                <p class="text-sm text-slate-500">
                    Under Maintenance
                </p>

                <h2 class="text-3xl font-bold text-yellow-600 mt-2">
                    {{ $maintenanceAssets }}
                </h2>

            </div>

            {{-- Pending Disposal --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                <p class="text-sm text-slate-500">
                    Pending Disposal
                </p>

                <h2 class="text-3xl font-bold text-red-600 mt-2">
                    {{ $pendingDisposals }}
                </h2>

            </div>

            {{-- Disposed Assets --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                <p class="text-sm text-slate-500">
                    Disposed Assets
                </p>

                <h2 class="text-3xl font-bold text-slate-800 mt-2">
                    {{ $disposedAssets }}
                </h2>

            </div>

        </div>

    </div>

</x-app-layout>