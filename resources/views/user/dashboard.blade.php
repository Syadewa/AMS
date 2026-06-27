<x-app-layout>

    <div class="space-y-6">

        {{-- Header --}}
        <div>

            <h1 class="text-2xl font-bold text-slate-800">
                Dashboard
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Overview of your asset activities.
            </p>

        </div>

        {{-- Statistics --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

            {{-- My Assets --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                <p class="text-sm text-slate-500">
                    My Assets
                </p>

                <h2 class="text-3xl font-bold text-slate-800 mt-2">
                    {{ $myAssets }}
                </h2>

            </div>

            {{-- Pending Assignments --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                <p class="text-sm text-slate-500">
                    Pending Assignments
                </p>

                <h2 class="text-3xl font-bold text-yellow-600 mt-2">
                    {{ $pendingAssignments }}
                </h2>

            </div>

            {{-- Pending Mutations --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                <p class="text-sm text-slate-500">
                    Pending Mutations
                </p>

                <h2 class="text-3xl font-bold text-blue-600 mt-2">
                    {{ $pendingMutations }}
                </h2>

            </div>

            {{-- Maintenance Requests --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                <p class="text-sm text-slate-500">
                    Maintenance Requests
                </p>

                <h2 class="text-3xl font-bold text-green-600 mt-2">
                    {{ $maintenanceRequests }}
                </h2>

            </div>

        </div>

    </div>

</x-app-layout>