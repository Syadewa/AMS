<x-app-layout>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

        <div class="flex justify-between items-center mb-6">

            <h1 class="text-2xl font-bold">
                Disposal Approval
            </h1>

        </div>

        @if(session('success'))

            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">

                {{ session('success') }}

            </div>

        @endif

        <div class="bg-white rounded-xl shadow-sm overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-100">

                    <tr>

                        <th class="px-4 py-3 text-left">
                            Asset
                        </th>

                        <th class="px-4 py-3 text-left">
                            Disposal Type
                        </th>

                        <th class="px-4 py-3 text-left">
                            Status
                        </th>

                        <th class="px-4 py-3 text-left">
                            Requested By
                        </th>

                        <th class="px-4 py-3 text-left">
                            Submission Date
                        </th>

                        <th class="px-4 py-3 text-center">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($disposals as $disposal)

                        <tr class="border-t">

                            <td class="px-4 py-3">

                                {{ $disposal->asset?->kode_asset }}
                                -
                                {{ $disposal->asset?->nama_asset }}

                            </td>

                            <td class="px-4 py-3">

                                {{ ucfirst($disposal->jenis_pelepasan) }}

                            </td>

                            <td class="px-4 py-3">

                                @if($disposal->status_approval == 'pending')

                                    <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm font-medium">
                                        Pending
                                    </span>

                                @elseif($disposal->status_approval == 'disetujui')

                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-medium">
                                        Approved
                                    </span>

                                @elseif($disposal->status_approval == 'ditolak')

                                    <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm font-medium">
                                        Rejected
                                    </span>

                                @endif

                            </td>

                            <td class="px-4 py-3">

                                {{ $disposal->requestedBy?->name }}

                            </td>

                            <td class="px-4 py-3">

                                {{ \Carbon\Carbon::parse($disposal->tanggal_pengajuan)->format('d M Y') }}

                            </td>

                            <td class="px-4 py-3 text-center">

                                <a
                                    href="/manager/disposals/{{ $disposal->id }}"
                                    class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-sm transition"
                                >
                                    View
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="text-center py-6 text-slate-500"
                            >

                                No disposal requests found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>