<x-app-layout>

    <div class="max-w-3xl">

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

            <!-- Header -->
            <div class="mb-6">

                <h1 class="text-2xl font-bold text-slate-800">
                    Edit Asset Category
                </h1>

                <p class="text-sm text-slate-500 mt-1">
                    Update asset category information.
                </p>

            </div>

            <!-- Form -->
            <form method="POST" action="/admin/asset-categories/{{ $category->id }}">

                @csrf
                @method('PUT')

                <!-- Kode Kategori -->
                <div class="mb-5">

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Kode Kategori
                    </label>

                    <input 
                        type="text"
                        name="kode_kategori"
                        value="{{ $category->kode_kategori }}"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-slate-400"
                    >

                </div>

                <!-- Nama Kategori -->
                <div class="mb-5">

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Nama Kategori
                    </label>

                    <input 
                        type="text"
                        name="nama_kategori"
                        value="{{ $category->nama_kategori }}"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-slate-400"
                    >

                </div>

                <!-- Deskripsi -->
                <div class="mb-6">

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Deskripsi
                    </label>

                    <textarea 
                        name="deskripsi"
                        rows="4"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-slate-400"
                    >{{ $category->deskripsi }}</textarea>

                </div>

                <!-- Button -->
                <div class="flex gap-3">

                    <button 
                        type="submit"
                        class="bg-slate-900 hover:bg-slate-800 text-white px-6 py-3 rounded-xl transition"
                    >
                        Update Kategori
                    </button>

                    <a 
                        href="/admin/asset-categories"
                        class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-6 py-3 rounded-xl transition"
                    >
                        Batal
                    </a>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>