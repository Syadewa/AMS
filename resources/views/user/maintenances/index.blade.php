<x-app-layout>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">

            <div>

                <h1 class="text-2xl font-bold text-slate-800">
                    My Maintenance Requests
                </h1>

                <p class="text-sm text-slate-500 mt-1">
                    View and monitor your maintenance requests.
                </p>

            </div>

            <a
                href="/user/maintenances/create"
                class="bg-slate-900 hover:bg-slate-800 text-white px-5 py-3 rounded-xl transition"
            >
                + Create Request
            </a>

        </div>

        {{-- Success Message --}}
        @if(session('success'))

            <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6">

                {{ session('success') }}

            </div>

        @endif

        {{-- Table --}}
        <div class="overflow-x-auto">

            <table class="w-full">

                <thead>

                    <tr class="border-b border-slate-200">

                        <th class="pb-4 text-left text-sm font-semibold text-slate-600">
                            Asset
                        </th>

                        <th class="pb-4 text-left text-sm font-semibold text-slate-600">
                            Complaint
                        </th>

                        <th class="pb-4 text-left text-sm font-semibold text-slate-600">
                            Status
                        </th>

                        <th class="pb-4 text-left text-sm font-semibold text-slate-600">
                            Request Date
                        </th>

                        <th class="pb-4 text-center text-sm font-semibold text-slate-600">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($maintenances as $maintenance)

                        <tr class="border-b border-slate-100">

                            {{-- Asset --}}
                            <td class="py-4">

                                <div class="font-medium text-slate-800">

                                    {{ $maintenance->asset?->nama_asset }}

                                </div>

                                <div class="text-xs text-slate-500">

                                    {{ $maintenance->asset?->kode_asset }}

                                </div>

                            </td>

                            {{-- Complaint --}}
                            <td class="py-4 text-slate-700">

                                {{ Str::limit($maintenance->keluhan, 60) }}

                            </td>

                            {{-- Status --}}
                            <td class="py-4">

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

                            </td>

                            {{-- Request Date --}}
                            <td class="py-4 text-slate-700">

                                {{ $maintenance->tanggal_pengajuan }}

                            </td>

                            {{-- Action --}}
                            <td class="py-4">

                                <div class="flex justify-center">

                                    <a
                                        href="/user/maintenances/{{ $maintenance->id }}"
                                        class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 transition text-sm text-white"
                                    >
                                        View
                                    </a>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="5"
                                class="text-center py-10 text-slate-500"
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