<x-app-layout>

    <div class="max-w-3xl">

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

            <div class="mb-6">

                <h1 class="text-2xl font-bold text-slate-800">
                    Edit Department
                </h1>

                <p class="text-sm text-slate-500 mt-1">
                    Update department information.
                </p>

            </div>

            <form method="POST" action="/admin/departments/{{ $department->id_department }}">

                @csrf
                @method('PUT')

                <!-- Kode -->
                <div class="mb-5">

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Kode Department
                    </label>

                    <input 
                        type="text"
                        name="kode_department"
                        value="{{ $department->kode_department }}"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3"
                    >

                </div>

                <!-- Nama -->
                <div class="mb-5">

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Nama Department
                    </label>

                    <input 
                        type="text"
                        name="nama_department"
                        value="{{ $department->nama_department }}"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3"
                    >

                </div>

                <!-- Lokasi -->
                <div class="mb-6">

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Lokasi
                    </label>

                    <input 
                        type="text"
                        name="lokasi"
                        value="{{ $department->lokasi }}"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3"
                    >

                </div>

                <div class="flex gap-3">

                    <button 
                        type="submit"
                        class="bg-slate-900 hover:bg-slate-800 text-white px-6 py-3 rounded-xl transition"
                    >
                        Update Department
                    </button>

                    <a 
                        href="/admin/departments"
                        class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-6 py-3 rounded-xl transition"
                    >
                        Batal
                    </a>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>