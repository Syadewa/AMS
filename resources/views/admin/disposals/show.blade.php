<x-app-layout>

<div class="space-y-6">

    @if(session('success'))

        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl">

            {{ session('success') }}

        </div>

    @endif

    <!-- Header -->

    <div>

        <h2 class="text-xl font-semibold text-slate-800">
            Disposal Information
        </h2>

        <p class="text-sm text-slate-500 mt-1">
            View disposal request details
        </p>

    </div>

    <!-- Main Card -->

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Left -->

            <div class="space-y-4">

                <div>

                    <label class="text-sm text-slate-500">
                        Asset
                    </label>

                    <p class="font-medium text-slate-800">
                        {{ $disposal->asset?->kode_asset }}
                        -
                        {{ $disposal->asset?->nama_asset }}
                    </p>

                </div>

                <div>

                    <label class="text-sm text-slate-500">
                        Disposal Type
                    </label>

                    <p class="font-medium text-slate-800">
                        {{ ucfirst($disposal->jenis_pelepasan) }}
                    </p>

                </div>

                <div>

                    <label class="text-sm text-slate-500">
                        Status
                    </label>

                    <div class="mt-1">

                        @if($disposal->status_approval == 'pending')

                            <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm font-medium">
                                Pending
                            </span>

                        @elseif($disposal->status_approval == 'disetujui')

                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-medium">
                                Disetujui
                            </span>

                        @elseif($disposal->status_approval == 'ditolak')

                            <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm font-medium">
                                Ditolak
                            </span>

                        @endif

                    </div>

                </div>

                <div>

                    <label class="text-sm text-slate-500">
                        Request Date
                    </label>

                    <p class="font-medium text-slate-800">
                        {{ $disposal->tanggal_pengajuan }}
                    </p>

                </div>

            </div>

            <!-- Right -->

            <div class="space-y-4">

                <div>

                    <label class="text-sm text-slate-500">
                        Requested By
                    </label>

                    <p class="font-medium text-slate-800">
                        {{ $disposal->requestedBy?->name }}
                    </p>

                </div>

                <div>

                    <label class="text-sm text-slate-500">
                        Approved By
                    </label>

                    <p class="font-medium text-slate-800">
                        {{ $disposal->approvedBy?->name ?? '-' }}
                    </p>

                </div>

                <div>

                    <label class="text-sm text-slate-500">
                        Approved At
                    </label>

                    <p class="font-medium text-slate-800">
                        {{ $disposal->approved_at ?? '-' }}
                    </p>

                </div>

            </div>

        </div>

    </div>

    <!-- Reason -->

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

        <h3 class="font-semibold text-slate-800 mb-3">
            Disposal Reason
        </h3>

        <div class="bg-slate-50 border border-slate-200 p-4 rounded-xl">

            {{ $disposal->alasan }}

        </div>

    </div>

    <!-- Notes -->

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

        <h3 class="font-semibold text-slate-800 mb-3">
            Notes
        </h3>

        <div class="bg-slate-50 border border-slate-200 p-4 rounded-xl">

            {{ $disposal->notes ?? '-' }}

        </div>

    </div>

    <!-- Berita Acara -->

    @if($disposal->berita_acara_path)

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

            <h3 class="font-semibold text-slate-800 mb-4">
                Disposal Report
            </h3>

            <div class="flex gap-3">

                <a
                    href="{{ asset('storage/' . $disposal->berita_acara_path) }}"
                    target="_blank"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700"
                >
                    View Document
                </a>

                <a
                    href="{{ asset('storage/' . $disposal->berita_acara_path) }}"
                    download
                    class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700"
                >
                    Download Document
                </a>

            </div>

        </div>

    @endif

</div>

</x-app-layout>
