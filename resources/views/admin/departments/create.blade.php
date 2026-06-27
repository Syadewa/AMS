<x-app-layout>

    <div class="max-w-3xl">

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

            <!-- Header -->
            <div class="mb-6">

                <h1 class="text-2xl font-bold text-slate-800">
                    Create Department
                </h1>

            </div>

            <!-- Form -->
            <form method="POST" action="/admin/departments">

                @csrf

                <div class="mb-5">

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Department Code
                    </label>

                    <input 
                        type="text"
                        name="kode_department"
                        required
                        class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-slate-400"
                       
                    >

                </div>

                <!-- Nama Department -->
                <div class="mb-5">

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Department Name
                    </label>

                    <input 
                        type="text"
                        name="nama_department"
                        required
                        class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-slate-400"
                        
                    >

                </div>

                <!-- Lokasi -->
                <div class="mb-6">

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Location
                    </label>

                    <input 
                        type="text"
                        name="lokasi"
                        required
                        class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-slate-400"
                    >

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
                        href="/admin/departments"
                        class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-6 py-3 rounded-xl transition"
                    >
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>