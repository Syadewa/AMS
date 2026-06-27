<x-app-layout>

    <div class="max-w-3xl">

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

            <!-- Header -->
            <div class="mb-6">

                <h1 class="text-2xl font-bold text-slate-800">
                    Register Asset
                </h1>

            </div>

            <!-- Form -->
            <form method="POST" action="/admin/assets">

                @csrf

                <!-- Kode Asset -->
                <div class="mb-5">

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Asset Code
                    </label>

                    <input 
                        type="text"
                        name="kode_asset"
                        Required
                        class="w-full border border-slate-300 rounded-xl px-4 py-3"
                    >

                </div>

                <!-- Nama Asset -->
                <div class="mb-5">

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Asset Name
                    </label>

                    <input 
                        type="text"
                        name="nama_asset"
                            Required
                        class="w-full border border-slate-300 rounded-xl px-4 py-3"
                    >

                </div>

                <!-- Kategori -->
                <div class="mb-5">

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Asset Category
                    </label>

                    <select 
                        name="kategori_id"
                        Required
                        class="w-full border border-slate-300 rounded-xl px-4 py-3"
                    >

                        <option value="">
                            Select Category 
                        </option>

                        @foreach ($categories as $category)

                            <option value="{{ $category->id }}">

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
                        Required
                        class="w-full border border-slate-300 rounded-xl px-4 py-3"
                    >

                </div>

                <!-- Tanggal Perolehan -->
                <div class="mb-5">

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Acquisition Date
                    </label>

                    <input 
                        type="date"
                        name="tanggal_perolehan"
                        Required
                        class="w-full border border-slate-300 rounded-xl px-4 py-3"
                    >

                </div>

                <!-- Tipe Asset -->
                <div class="mb-5">

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Asset Type
                    </label>

                    <select 
                        name="tipe_asset"
                        Required
                        class="w-full border border-slate-300 rounded-xl px-4 py-3"
                    >

                        <option value="">
                            Select Type
                        </option>

                        <option value="individual">
                            Individual
                        </option>

                        <option value="shared">
                            Shared
                        </option>

                    </select>

                </div>

                <!-- Status Asset -->
                <div class="mb-5">

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Asset Status
                    </label>

                    <select 
                        name="status_asset"
                        Required
                        class="w-full border border-slate-300 rounded-xl px-4 py-3"
                    >

                        <option value="">
                            Select Status
                        </option>

                        <option value="aktif">
                            Aktif
                        </option>

                        <option value="nonaktif">
                            Nonaktif
                        </option>

                        <option value="rusak">
                            Rusak
                        </option>

                        <option value="dilepas">
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
                        Required
                        class="w-full border border-slate-300 rounded-xl px-4 py-3"
                    >

                        <option value="">
                            Select Department
                        </option>

                        @foreach ($departments as $department)

                            <option value="{{ $department->id_department }}">

                                {{ $department->nama_department }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- Deskripsi -->
                <div class="mb-6">

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Description
                    </label>

                    <textarea 
                        name="deskripsi"
                        rows="4"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3"
                    ></textarea>

                </div>

                <!-- Button -->
                <div class="flex gap-3">

                    <button 
                        type="submit"
                        class="bg-slate-900 hover:bg-slate-800 text-white px-6 py-3 rounded-xl transition"
                    >
                        Save
                    </button>

                    <a 
                        href="/admin/assets"
                        class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-6 py-3 rounded-xl transition"
                    >
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>