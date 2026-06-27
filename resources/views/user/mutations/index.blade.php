<x-app-layout>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

        {{-- Header --}}
        <div class="mb-6">

            <h1 class="text-2xl font-bold text-slate-800">
                My Mutations
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                View and manage asset mutation requests.
            </p>

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
                            From
                        </th>

                        <th class="pb-4 text-left text-sm font-semibold text-slate-600">
                            Mutation Date
                        </th>

                        <th class="pb-4 text-left text-sm font-semibold text-slate-600">
                            Status
                        </th>

                        <th class="pb-4 text-center text-sm font-semibold text-slate-600">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($mutations as $mutation)

                        <tr class="border-b border-slate-100">

                            {{-- Asset --}}
                            <td class="py-4">

                                <div class="font-medium text-slate-800">

                                    {{ $mutation->asset->nama_asset }}

                                </div>

                                <div class="text-xs text-slate-500">

                                    {{ $mutation->asset->kode_asset }}

                                </div>

                            </td>

                            {{-- From --}}
                            <td class="py-4 text-slate-700">

                                {{
                                    $mutation->fromUser?->name
                                    ??
                                    $mutation->fromDepartment?->nama_department
                                    ??
                                    '-'
                                }}

                            </td>

                            {{-- Mutation Date --}}
                            <td class="py-4 text-slate-700">

                                {{ $mutation->tanggal_mutasi }}

                            </td>

                            {{-- Status --}}
                            <td class="py-4">

                                @if($mutation->status_mutasi == 'pending')

                                    <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm font-medium">
                                        Pending
                                    </span>

                                @elseif($mutation->status_mutasi == 'disetujui')

                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-medium">
                                        Approved
                                    </span>

                                @elseif($mutation->status_mutasi == 'ditolak')

                                    <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm font-medium">
                                        Rejected
                                    </span>

                                @endif

                            </td>

                            {{-- Action --}}
                            <td class="py-4">

                                @if($mutation->status_mutasi == 'pending')

                                    <div class="flex justify-center gap-2">

                                        <form
                                            method="POST"
                                            action="/user/mutations/{{ $mutation->id }}/accept"
                                        >

                                            @csrf
                                            @method('PUT')

                                            <button
                                                type="submit"
                                                class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-lg text-sm transition"
                                            >
                                                Accept
                                            </button>

                                        </form>

                                        <form
                                            method="POST"
                                            action="/user/mutations/{{ $mutation->id }}/reject"
                                        >

                                            @csrf
                                            @method('PUT')

                                            <button
                                                type="submit"
                                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg text-sm transition"
                                            >
                                                Reject
                                            </button>

                                        </form>

                                    </div>

                                @elseif($mutation->status_mutasi == 'disetujui')

                                    <div class="text-center">

                                        <span class="text-green-600 font-medium">
                                            Approved
                                        </span>

                                    </div>

                                @elseif($mutation->status_mutasi == 'ditolak')

                                    <div class="text-center">

                                        <span class="text-red-600 font-medium">
                                            Rejected
                                        </span>

                                    </div>

                                @else

                                    <div class="text-center text-slate-500">
                                        -
                                    </div>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="5"
                                class="text-center py-10 text-slate-500"
                            >
                                No mutations found.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>