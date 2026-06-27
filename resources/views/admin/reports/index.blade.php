<x-app-layout>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

        <h1 class="text-3xl font-bold mb-6">
            Reports
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-white rounded-xl shadow-sm p-6">

                <h2 class="text-xl font-semibold mb-3">
                    Asset Report
                </h2>

                <p class="text-slate-500 mb-4">
                    Download laporan seluruh aset.
                </p>

                <a
                    href="/admin/reports/assets"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg"
                >
                    Generate PDF
                </a>

            </div>

            <div class="bg-white rounded-xl shadow-sm p-6">

                <h2 class="text-xl font-semibold mb-3">
                    Maintenance Report
                </h2>

                <p class="text-slate-500 mb-4">
                    Download laporan maintenance aset.
                </p>

                <a
                    href="/admin/reports/maintenances"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg"
                >
                    Generate PDF
                </a>

            </div>

            <div class="bg-white rounded-xl shadow-sm p-6">

                <h2 class="text-xl font-semibold mb-3">
                    Disposal Report
                </h2>

                <p class="text-slate-500 mb-4">
                    Download laporan disposal aset.
                </p>

                <a
                    href="/admin/reports/disposals"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg"
                    
                >
                    Generate PDF
                </a>

            </div>

        </div>

    </div>

</x-app-layout>