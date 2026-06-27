<x-app-layout>

    <div class="space-y-6">

        <h1 class="text-2xl font-bold mb-6">
            Maintenance Detail
        </h1>

        @if(session('success'))

            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">

                {{ session('success') }}

            </div>

        @endif

        @if($errors->any())

            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">

                <ul>

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <div class="bg-white rounded-xl shadow-sm p-6">

                <div class="space-y-4">

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
            Reported By
            </label>

            <p class="font-medium text-slate-800">
                {{ $maintenance->requestedBy?->name }}

            </p>

            </div>

            <div>

                <label class="text-sm text-slate-500">
                  Status
                 </label>
            
            <div class="mt-1">

            @if($maintenance->status_maintenance == 'pending')

                <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm font-medium">
                    Pending
                </span>

            @elseif($maintenance->status_maintenance == 'diproses')

                <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm font-medium">
                    Diproses
                </span>

            @elseif($maintenance->status_maintenance == 'selesai')

                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-medium">
                    Selesai
                </span>

            @elseif($maintenance->status_maintenance == 'ditolak')

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

                {{ $maintenance->tanggal_pengajuan }}

            </p>

            </div>

            @if($maintenance->handledBy)

                <div>

                    <label class="text-sm text-slate-500">
                        Handled By
                    </label>

                    <p class="font-medium text-slate-800">
                        {{ $maintenance->handledBy->name }}
                    </p>

             </div>

            @endif

            </div>

            <hr class="my-6">

            <h2 class="font-semibold mb-3">
                Issue Description
            </h2>

            <div class="bg-slate-50 border border-slate-200 p-4 rounded-xl">

                {{ $maintenance->keluhan }}

            </div>

        </div>

        {{-- Pending Actions --}}
        @if($maintenance->status_maintenance == 'pending')

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

            <h3 class="font-semibold text-slate-800 mb-4">
                Maintenance Actions
            </h3>

            <div class="flex gap-3">

                <form
                    method="POST"
                    action="/admin/maintenances/{{ $maintenance->id }}/process"
                >

                    @csrf
                    @method('PUT')

                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg"
                    >
                        Process
                    </button>

                </form>

                <form
                    method="POST"
                    action="/admin/maintenances/{{ $maintenance->id }}/reject"
                >

                    @csrf
                    @method('PUT')

                    <button
                        type="submit"
                        class="bg-red-600 text-white px-4 py-2 rounded-lg"
                    >
                        Reject
                    </button>

                </form>

            </div>

        </div>

        @endif

        {{-- Complete Form --}}
        @if($maintenance->status_maintenance == 'diproses')

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                <h2 class="text-xl font-semibold mb-4">
                    Complete Maintenance
                </h2>

                <form
                    method="POST"
                    action="/admin/maintenances/{{ $maintenance->id }}/complete"
                >

                    @csrf
                    @method('PUT')

                    <div class="mb-4">

                        <label class="block mb-2">
                            Action Taken
                        </label>

                        <textarea
                            name="tindakan"
                            rows="4"
                            class="w-full border border-slate-300 rounded-xl"
                        >{{ old('tindakan') }}</textarea>

                    </div>

                    <div class="mb-4">

                        <label class="block mb-2 font-medium text-slate-700">
                    Outcome
                </label>
                        <select
                            name="hasil"
                            class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-slate-300 focus:outline-none bg-white text-slate-800"
                            required
                        >
                            <option value="" disabled {{ old('hasil') ? '' : 'selected' }}>-- Pilih Hasil Perbaikan --</option>
                            <option value="sukses" {{ old('hasil') == 'sukses' ? 'selected' : '' }}>Sukses (Aset Kembali Aktif)</option>
                            <option value="gagal" {{ old('hasil') == 'gagal' ? 'selected' : '' }}>Gagal (Aset Menjadi Nonaktif)</option>
                        </select>
                        <p class="mt-1 text-xs text-slate-400">
                            *Jika memilih Sukses, aset bisa langsung digunakan kembali. Jika Gagal, aset dibekukan untuk disposal.
                        </p>
                    </div>

                    <div class="mb-4">

                        <label class="block mb-2">
                            Notes
                        </label>

                        <textarea
                            name="notes"
                            rows="3"
                            class="w-full border border-slate-300 rounded-xl"
                        >{{ old('notes') }}</textarea>

                    </div>

                    <button
                        type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded-lg"
                    >
                        Complete Maintenance
                    </button>

                </form>

            </div>

        @endif

        {{-- Completed Result --}}
        @if($maintenance->status_maintenance == 'selesai')

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                <h2 class="text-xl font-semibold text-slate-800 mb-6">
                    Maintenance Result
                </h2>

                <div class="space-y-6">

                    <div>

                        <label class="text-sm text-slate-500">
                            Tindakan
                        </label>

                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 mt-1">

                            {{ $maintenance->tindakan }}

                        </div>
                    </div>

                <div>

                    <label class="text-sm text-slate-500">
                        Hasil
                    </label>

                    <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 mt-1">

                        {{ $maintenance->hasil }}

                    </div>

                </div>

                <div>

                    <label class="text-sm text-slate-500">
                        Notes
                    </label>

                    <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 mt-1">

                        {{ $maintenance->notes ?? '-' }}

                    </div>

                </div>

               <div>

                    <label class="text-sm text-slate-500">
                        Tanggal Selesai
                    </label>

                    <p class="font-medium text-slate-800">
                        {{ $maintenance->tanggal_selesai }}
                    </p>

             </div>

            </div>
        </div>

        @endif


</x-app-layout>