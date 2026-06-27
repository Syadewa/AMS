<x-app-layout>

    <div class="space-y-6">

        {{-- Disposal Information --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

            <h2 class="text-xl font-semibold mb-6">
                Disposal Information
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

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
                        Requested By
                    </label>

                    <p class="font-medium text-slate-800">
                        {{ $disposal->requestedBy?->name }}
                    </p>

                </div>

                <div>

                    <label class="text-sm text-slate-500">
                        Submission Date
                    </label>

                    <p class="font-medium text-slate-800">
                        {{ \Carbon\Carbon::parse($disposal->tanggal_pengajuan)->format('d M Y') }}
                    </p>

                </div>

                <div>

                    <label class="text-sm text-slate-500">
                        Status
                    </label>

                    <p>

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

                    </p>

                </div>

            </div>

        </div>

        {{-- Disposal Reason --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

            <h2 class="text-xl font-semibold mb-4">
                Disposal Reason
            </h2>

            <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 text-slate-700">

                {{ $disposal->alasan }}

            </div>

        </div>

        {{-- Notes --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

            <h2 class="text-xl font-semibold mb-4">
                Notes
            </h2>

            <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 text-slate-700">

                {{ $disposal->notes ?? '-' }}

            </div>

        </div>

        {{-- Disposal Document --}}
        @if($disposal->berita_acara_path)

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                <h2 class="text-xl font-semibold mb-4">
                    Disposal Document
                </h2>

                <a
                    href="{{ asset('storage/' . $disposal->berita_acara_path) }}"
                    target="_blank"
                    class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition"
                >
                    View Disposal Report
                </a>

            </div>

        @endif

        {{-- Approval Action --}}
        @if($disposal->status_approval == 'pending')

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                <h2 class="text-xl font-semibold mb-4">
                    Approval Action
                </h2>

                <div class="flex gap-3">

                    <form
                        method="POST"
                        action="/manager/disposals/{{ $disposal->id }}/approve"
                    >

                        @csrf
                        @method('PUT')

                        <button
                            type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg transition"
                        >
                            Approve
                        </button>

                    </form>

                    <form
                        method="POST"
                        action="/manager/disposals/{{ $disposal->id }}/reject"
                    >

                        @csrf
                        @method('PUT')

                        <button
                            type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg transition"
                        >
                            Reject
                        </button>

                    </form>

                </div>

            </div>

        @endif

    </div>

</x-app-layout>