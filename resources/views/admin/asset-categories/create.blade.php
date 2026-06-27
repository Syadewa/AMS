<x-app-layout>

    <div class="max-w-3xl">

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

            <div class="mb-6">

                <h1 class="text-2xl font-bold text-slate-800">
                    Create Asset Category
                </h1>

            </div>

            <form method="POST" action="/admin/asset-categories">

                @csrf

                <!-- Kode -->
                <div class="mb-5">

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Category Code
                    </label>

                    <input 
                        type="text"
                        Required
                        name="kode_kategori"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3"
                    >

                </div>

                <!-- Nama -->
                <div class="mb-5">

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Category Name
                    </label>

                    <input 
                        type="text"
                        required
                        name="nama_kategori"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3"
                    >

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
            <div class="flex gap-3" >
                <button 
                    type="submit"
                    class="bg-slate-900 hover:bg-slate-800 text-white px-6 py-3 rounded-xl transition"
                >
                    Save
                </button>

                <a 
                    href="/admin/asset-categories"
                    class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-6 py-3 rounded-xl transition"
                >
                    Cancel
                </a>
            </div>


            </form>

            

        </div>

    </div>

</x-app-layout>