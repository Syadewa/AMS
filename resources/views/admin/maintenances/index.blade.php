<x-app-layout>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

        <div class="flex justify-between items-center mb-6">

        <h1 class="text-2xl font-bold">
            Asset Maintenance Requests
        </h1>

        </div>

        <div class="bg-white rounded-xl shadow-sm overflow-hidden">

            <table class="w-full">

                <thead class="bg-slate-100">

                    <tr>

                        <th class="px-4 py-3 text-left">
                            Asset
                        </th>

                        <th class="px-4 py-3 text-left">
                            Requested By
                        </th>

                        <th class="px-4 py-3 text-left">
                            Issue Description
                        </th>

                        <th class="px-4 py-3 text-left">
                            Status
                        </th>

                        <th class="px-4 py-3 text-left">
                            Date
                        </th>

                        <th class="px-4 py-3 text-left">
                            Actions 
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($maintenances as $maintenance)

                        <tr class="border-t">

                            <td class="px-4 py-3">

                                {{ $maintenance->asset?->kode_asset }}
                                -
                                {{ $maintenance->asset?->nama_asset }}

                            </td>

                            <td class="px-4 py-3">

                                {{ $maintenance->requestedBy?->name }}

                            </td>

                            <td class="px-4 py-3">

                                {{ $maintenance->keluhan }}

                            </td>

                            <td class="px-4 py-3">

                                @switch($maintenance->status_maintenance)

                                @case('pending')

                                    <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm font-medium">
                                        Pending
                                    </span>

                                    @break

                                @case('selesai')

                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-medium">
                                        Selesai
                                    </span>

                                    @break

                                @case('ditolak')

                                    <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm font-medium">
                                        Ditolak
                                    </span>

                                    @break

                                @case('diproses')

                                    <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm font-medium">
                                        Diproses
                                    </span>

                                    @break

                            @endswitch

                            </td>

                            <td class="px-4 py-3">

                                {{ $maintenance->tanggal_pengajuan }}

                            </td>

                            <td class="px-4 py-3">

                                <a
                                    href="/admin/maintenances/{{ $maintenance->id }}"
                                    class="bg-blue-600 text-white px-3 py-1 rounded-lg text-sm"
                                >
                                    View
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="5"
                                class="text-center py-6 text-slate-500"
                            >

                                No maintenance requests found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>