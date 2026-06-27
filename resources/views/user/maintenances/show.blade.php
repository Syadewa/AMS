<x-app-layout>

    <div class="space-y-6">

        {{-- Maintenance Information --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

            <h2 class="text-xl font-semibold mb-6">
                Maintenance Information
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>

                    <label class="text-sm text-slate-500">
                        Asset
                    </label>

                    <p class="font-medium text-slate-800">
                        {{ $maintenance->asset?->kode_asset }}
                        -
                        {{ $maintenance->asset?->nama_asset }}
                    </p>

                </div>

                <div>

                    <label class="text-sm text-slate-500">
                        Category
                    </label>

                    <p class="font-medium text-slate-800">
                        {{ $maintenance->asset?->category?->nama_kategori }}
                    </p>

                </div>

                <div>

                    <label class="text-sm text-slate-500">
                        Request Date
                    </label>

                    <p class="font-medium text-slate-800">
                        {{ $maintenance->tanggal_pengajuan }}
                    </p>

                </div>

                <div>

                    <label class="text-sm text-slate-500">
                        Status
                    </label>

                    <p>

                        @if($maintenance->status_maintenance == 'pending')

                            <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm font-medium">
                                Pending
                            </span>

                        @elseif($maintenance->status_maintenance == 'diproses')

                            <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm font-medium">
                                In Process
                            </span>

                        @elseif($maintenance->status_maintenance == 'selesai')

                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-medium">
                                Completed
                            </span>

                        @elseif($maintenance->status_maintenance == 'ditolak')

                            <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm font-medium">
                                Rejected
                            </span>

                        @endif

                    </p>

                </div>

                <div>

                    <label class="text-sm text-slate-500">
                        Requested By
                    </label>

                    <p class="font-medium text-slate-800">
                        {{ $maintenance->requestedBy?->name }}
                    </p>

                </div>

                <div>

                    <label class="text-sm text-slate-500">
                        Handled By
                    </label>

                    <p class="font-medium text-slate-800">
                        {{ $maintenance->handledBy?->name ?? '-' }}
                    </p>

                </div>

            </div>

        </div>

        {{-- Complaint --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

            <h2 class="text-xl font-semibold mb-4">
                Complaint
            </h2>

            <div class="bg-slate-50 border border-slate-200 rounded-xl p-4">

                {{ $maintenance->keluhan }}

            </div>

        </div>

        {{-- Result --}}
        @if($maintenance->status_maintenance == 'selesai')

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                <h2 class="text-xl font-semibold mb-6">
                    Maintenance Result
                </h2>

                <div class="space-y-6">

                    <div>

                        <label class="text-sm text-slate-500">
                            Action Taken
                        </label>

                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 mt-2">

                            {{ $maintenance->tindakan }}

                        </div>

                    </div>

                    <div>

                        <label class="text-sm text-slate-500">
                            Result
                        </label>

                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 mt-2">

                            {{ $maintenance->hasil }}

                        </div>

                    </div>

                    <div>

                        <label class="text-sm text-slate-500">
                            Notes
                        </label>

                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 mt-2">

                            {{ $maintenance->notes ?? '-' }}

                        </div>

                    </div>

                    <div>

                        <label class="text-sm text-slate-500">
                            Completion Date
                        </label>

                        <p class="font-medium text-slate-800 mt-1">
                            {{ $maintenance->tanggal_selesai }}
                        </p>

                    </div>

                </div>

            </div>

        @endif

    </div>

</x-app-layout>