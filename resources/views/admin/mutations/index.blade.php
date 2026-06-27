<x-app-layout>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
            
            <h2 class="text-xl font-semibold text-slate-800">
                Asset Mutations
            </h2>
            

            <a
                href="/admin/mutations/create"
                class="inline-flex items-center justify-center bg-slate-900 hover:bg-slate-800 text-white px-5 py-3 rounded-xl transition"
            >
                + Create Mutation
            </a>

        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl mb-4 text-sm font-medium flex items-center gap-2">
                <span>✅</span>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        @if($errors->has('error'))
            <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-xl mb-4 text-sm font-medium flex items-center gap-2">
                <span>❌</span>
                <div>{{ $errors->first('error') }}</div>
            </div>
        @endif

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="px-4 py-3 text-left">
                            Asset
                        </th>

                        <th class="px-4 py-3 text-left">
                            From
                        </th>

                        <th class="px-4 py-3 text-left">
                            To
                        </th>

                        <th class="px-4 py-3 text-left">
                            Requested By
                        </th>

                        <th class="px-4 py-3 text-left">
                            Mutation Date
                        </th>

                        <th class="px-4 py-3 text-left">
                            Status
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($mutations as $mutation)

                        <tr class="border-t border-slate-100 hover:bg-slate-50 transition">

                            {{-- Asset --}}
                            <td class="px-4 py-3">

                               <div class="font-medium text-slate-700">
                                  {{ $mutation->asset->nama_asset }}
                               </div>

                                <div class="text-xs text-slate-500">
                                    {{ $mutation->asset->kode_asset }}
                                </div>

                            </td>

                            {{-- From --}}
                            <td class="px-4 py-3">

                                {{
                                    $mutation->fromUser?->name
                                    ??
                                    $mutation->fromDepartment?->nama_department
                                    ??
                                    '-'
                                }}

                            </td>

                            {{-- To --}}
                            <td class="px-4 py-3">

                                {{
                                    $mutation->toUser?->name
                                    ??
                                    $mutation->toDepartment?->nama_department
                                    ??
                                    '-'
                                }}

                            </td>

                            {{-- Requested By --}}
                            <td class="px-4 py-3">

                                {{ $mutation->requestedBy?->name }}

                            </td>

                            {{-- Date --}}
                            <td class="px-4 py-3">

                                {{ $mutation->tanggal_mutasi }}

                            </td>

                            {{-- Status --}}
                            <td class="px-4 py-3">

                                @switch($mutation->status_mutasi)

                                @case('pending')

                                    <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm font-medium">
                                        Pending
                                    </span>

                                    @break

                                @case('disetujui')

                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-medium">
                                        Disetujui
                                    </span>

                                    @break

                                @case('ditolak')

                                    <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm font-medium">
                                        Ditolak
                                    </span>

                                    @break

                            @endswitch
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="text-center py-8 text-slate-500"
                            >

                                No mutations found

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>