<x-app-layout>

    <div class="max-w-3xl">

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

            <!-- Header -->
            <div class="mb-6">

                <h1 class="text-2xl font-bold text-slate-800">
                    Edit Asset
                </h1>

                <p class="text-sm text-slate-500 mt-1">
                    Update company asset data.
                </p>

            </div>

            <!-- Form -->
            <form method="POST" action="/admin/assets/{{ $asset->id }}">

                @csrf
                @method('PUT')

                <!-- Kode Asset -->
                <div class="mb-5">

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Kode Asset
                    </label>

                    <input 
                        type="text"
                        name="kode_asset"
                        value="{{ $asset->kode_asset }}"
                        required
                        class="w-full border border-slate-300 rounded-xl px-4 py-3"
                        placeholder="Contoh: AST-001"
                    >

                </div>

                <!-- Nama Asset -->
                <div class="mb-5">

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Nama Asset
                    </label>

                    <input 
                        type="text"
                        name="nama_asset"
                        value="{{ $asset->nama_asset }}"
                        required
                        class="w-full border border-slate-300 rounded-xl px-4 py-3"
                        placeholder="Masukkan nama asset"
                    >

                </div>

                <!-- Kategori -->
                <div class="mb-5">

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Kategori
                    </label>

                    <select 
                        name="kategori_id"
                        required
                        class="w-full border border-slate-300 rounded-xl px-4 py-3"
                    >

                        <option value="">
                            Pilih Kategori
                        </option>

                        @foreach ($categories as $category)

                            <option 
                                value="{{ $category->id }}"
                                {{ $asset->kategori_id == $category->id ? 'selected' : '' }}
                            >

                                {{ $category->nama_kategori }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- Serial Number -->
                <div class="mb-5">

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Serial Number
                    </label>

                    <input 
                        type="text"
                        name="serial_number"
                        value="{{ $asset->serial_number }}"
                        required
                        class="w-full border border-slate-300 rounded-xl px-4 py-3"
                    >

                </div>

                <!-- Tanggal Perolehan -->
                <div class="mb-5">

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Tanggal Perolehan
                    </label>

                    <input 
                        type="date"
                        name="tanggal_perolehan"
                        value="{{ $asset->tanggal_perolehan }}"
                        required
                        class="w-full border border-slate-300 rounded-xl px-4 py-3"
                    >

                </div>

                <!-- Tipe Asset -->
                <div class="mb-5">

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Tipe Asset
                    </label>

                    <select 
                        name="tipe_asset"
                        required
                        class="w-full border border-slate-300 rounded-xl px-4 py-3"
                    >

                        <option value="">
                            Pilih Tipe Asset
                        </option>

                        <option 
                            value="individual"
                            {{ $asset->tipe_asset == 'individual' ? 'selected' : '' }}
                        >
                            Individual
                        </option>

                        <option 
                            value="shared"
                            {{ $asset->tipe_asset == 'shared' ? 'selected' : '' }}
                        >
                            Shared
                        </option>

                    </select>

                </div>

                <!-- Status Asset -->
                <div class="mb-5">

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Status Asset
                    </label>

                    <select 
                        name="status_asset"
                        required
                        class="w-full border border-slate-300 rounded-xl px-4 py-3"
                    >

                        <option value="">
                            Pilih Status
                        </option>

                        <option 
                            value="aktif"
                            {{ $asset->status_asset == 'aktif' ? 'selected' : '' }}
                        >
                            Aktif
                        </option>

                        <option 
                            value="nonaktif"
                            {{ $asset->status_asset == 'nonaktif' ? 'selected' : '' }}
                        >
                            Nonaktif
                        </option>

                        <option 
                            value="rusak"
                            {{ $asset->status_asset == 'rusak' ? 'selected' : '' }}
                        >
                            Rusak
                        </option>

                        <option 
                            value="dilepas"
                            {{ $asset->status_asset == 'dilepas' ? 'selected' : '' }}
                        >
                            Dilepas
                        </option>

                    </select>

                </div>

                <!-- Department -->
                <div class="mb-5">

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Department
                    </label>

                    <select 
                        name="department_id"
                        required
                        class="w-full border border-slate-300 rounded-xl px-4 py-3"
                    >

                        <option value="">
                            Pilih Department
                        </option>

                        @foreach ($departments as $department)

                            <option 
                                value="{{ $department->id_department }}"
                                {{ $asset->department_id == $department->id_department ? 'selected' : '' }}
                            >

                                {{ $department->nama_department }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- Deskripsi -->
                <div class="mb-6">

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Deskripsi
                    </label>

                    <textarea 
                        name="deskripsi"
                        rows="4"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3"
                    >{{ $asset->deskripsi }}</textarea>

                </div>

                <!-- Button -->
                <div class="flex gap-3">

                    <button 
                        type="submit"
                        class="bg-slate-900 hover:bg-slate-800 text-white px-6 py-3 rounded-xl transition"
                    >
                        Update Asset
                    </button>

                    <a 
                        href="/admin/assets"
                        class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-6 py-3 rounded-xl transition"
                    >
                        Batal
                    </a>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>