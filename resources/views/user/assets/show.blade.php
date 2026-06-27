@php

$currentAssignment =
    $asset->assignments
        ->where('status_assignment', 'aktif')
        ->first();

@endphp

<x-app-layout>

    <div class="space-y-6">

        {{-- Asset Information + QR Code --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                {{-- Asset Information --}}
                <div>

                    <h2 class="text-xl font-semibold mb-6">
                        Asset Information
                    </h2>

                    <div class="space-y-4">

                        <div>

                            <label class="text-sm text-slate-500">
                                Asset Code
                            </label>

                            <p class="text-lg font-semibold text-slate-900">
                                {{ $asset->kode_asset }}
                            </p>

                        </div>

                        <div>

                            <label class="text-sm text-slate-500">
                                Asset Name
                            </label>

                            <p class="text-lg font-semibold text-slate-900">
                                {{ $asset->nama_asset }}
                            </p>

                        </div>

                        <div>

                            <label class="text-sm text-slate-500">
                                Category
                            </label>

                            <p class="font-medium text-slate-800">
                                {{ $asset->category?->nama_kategori }}
                            </p>

                        </div>

                        <div>

                            <label class="text-sm text-slate-500">
                                Serial Number
                            </label>

                            <p class="font-medium text-slate-800">
                                {{ $asset->serial_number }}
                            </p>

                        </div>

                        <div>

                            <label class="text-sm text-slate-500">
                                Department
                            </label>

                            <p class="font-medium text-slate-800">
                                {{ $asset->department?->nama_department }}
                            </p>

                        </div>

                    </div>

                </div>

                {{-- QR Code --}}
                <div class="flex flex-col items-center">

                    <h2 class="text-xl font-semibold mb-6">
                        QR Code
                    </h2>

                    @if($asset->qr_code_path)

                        <img
                            src="{{ asset('storage/' . $asset->qr_code_path) }}"
                            alt="QR Code"
                            class="w-48 h-48 border border-slate-200 rounded-xl p-2 bg-white"
                        >

                        <div class="flex gap-3 mt-4">

                            <a
                                href="{{ asset('storage/' . $asset->qr_code_path) }}"
                                target="_blank"
                                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition"
                            >
                                View QR
                            </a>

                            <a
                                href="{{ asset('storage/' . $asset->qr_code_path) }}"
                                download
                                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition"
                            >
                                Download QR
                            </a>

                        </div>

                    @else

                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-6 text-slate-500">

                            QR Code not available

                        </div>

                    @endif

                </div>

            </div>

        </div>

        {{-- Current Assignment --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

            <h2 class="text-xl font-semibold mb-6">
                Current Assignment
            </h2>

            @if($currentAssignment)

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <div>

                        <label class="text-sm text-slate-500">
                            Assigned Date
                        </label>

                        <p class="font-medium text-slate-800">
                            {{ $currentAssignment->tanggal_assignment }}
                        </p>

                    </div>

                    <div>

                        <label class="text-sm text-slate-500">
                            Assigned By
                        </label>

                        <p class="font-medium text-slate-800">
                            {{ $currentAssignment->assignedBy?->name ?? '-' }}
                        </p>

                    </div>

                    <div>

                        <label class="text-sm text-slate-500">
                            Status
                        </label>

                        <p>

                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-medium">
                                Active
                            </span>

                        </p>

                    </div>

                </div>

            @else

                <p class="text-slate-500">
                    No active assignment found.
                </p>

            @endif

        </div>

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

            <h2 class="text-xl font-semibold mb-6">
                Handover Document
            </h2>

            @if(
                $currentAssignment &&
                $currentAssignment->handover_document_path
            )

                <div class="flex gap-3">

                    <a
                        href="{{ asset('storage/' . $currentAssignment->handover_document_path) }}"
                        target="_blank"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition"
                    >
                        View Document
                    </a>

                    <a
                        href="{{ asset('storage/' . $currentAssignment->handover_document_path) }}"
                        download
                        class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition"
                    >
                        Download Document
                    </a>

                </div>

            @else

                <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 text-slate-500">

                    Handover document not available.

                </div>

            @endif

        </div>

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

            <h2 class="text-xl font-semibold mb-6">
                Maintenance History
            </h2>

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead>

                        <tr class="border-b border-slate-200">

                            <th class="text-left py-3 text-sm font-semibold text-slate-600">
                                Date
                            </th>

                            <th class="text-left py-3 text-sm font-semibold text-slate-600">
                                Requested By
                            </th>

                            <th class="text-left py-3 text-sm font-semibold text-slate-600">
                                Status
                            </th>

                            <th class="text-left py-3 text-sm font-semibold text-slate-600">
                                Handled By
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse(
                            $asset->maintenances
                                ->sortByDesc('created_at')
                            as $maintenance
                        )

                            <tr class="border-b border-slate-100">

                                <td class="py-4">
                                    {{ $maintenance->tanggal_pengajuan }}
                                </td>

                                <td class="py-4">
                                    {{ $maintenance->requestedBy?->name }}
                                </td>

                                <td class="py-4">

                                    @if($maintenance->status_maintenance == 'pending')

                                        <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm">
                                            Pending
                                        </span>

                                    @elseif($maintenance->status_maintenance == 'diproses')

                                        <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm">
                                            In Process
                                        </span>

                                    @elseif($maintenance->status_maintenance == 'selesai')

                                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">
                                            Completed
                                        </span>

                                    @endif

                                </td>

                                <td class="py-4">
                                    {{ $maintenance->handledBy?->name ?? '-' }}
                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="4"
                                    class="text-center py-8 text-slate-500"
                                >
                                    No maintenance history found.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</x-app-layout>