<x-app-layout>

    <div class="max-w-3xl">

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

            <div class="mb-6">
                <h1 class="text-2xl font-bold text-slate-800">
                    Create Asset Assignment
                </h1>
                <p class="text-sm text-slate-500 mt-1">
                    Assign asset to user or department.
                </p>
            </div>

            @if ($errors->any())
                <div class="mb-5 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm">
                    <strong class="block mb-1">Gagal menyimpan data:</strong>
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="/admin/assignments">
                @csrf

                <div class="mb-5">
                    <label class="block text-sm font-medium mb-2">
                        Asset
                    </label>
                    <select
                        name="asset_id"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3"
                    >
                        <option value="">
                            Select Asset
                        </option>
                        @foreach($assets as $asset)
                            <option value="{{ $asset->id }}" {{ old('asset_id') == $asset->id ? 'selected' : '' }}>
                                {{ $asset->kode_asset }} - {{ $asset->nama_asset }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-medium mb-2">
                        User (Individual Asset)
                    </label>
                    <select
                        name="user_id"
                        id="user_id" 
                        class="w-full border border-slate-300 rounded-xl px-4 py-3 disabled:bg-slate-100 disabled:cursor-not-allowed"
                    >
                        <option value="">
                            Select User
                        </option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-medium mb-2">
                        Department (Shared Asset)
                    </label>
                    <select
                        name="department_id"
                        id="department_id" 
                        class="w-full border border-slate-300 rounded-xl px-4 py-3 disabled:bg-slate-100 disabled:cursor-not-allowed"
                    >
                        <option value="">
                            Select Department
                        </option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id_department }}" {{ old('department_id') == $department->id_department ? 'selected' : '' }}>
                                {{ $department->nama_department }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-medium mb-2">
                        Assignment Date
                    </label>
                    <input
                        type="datetime-local"
                        name="tanggal_assignment"
                        value="{{ old('tanggal_assignment') }}"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3"
                    >
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2">
                        Notes
                    </label>
                    <textarea
                        name="notes"
                        rows="4"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3"
                    >{{ old('notes') }}</textarea>
                </div>

                <div class="flex gap-3">
                    <button
                        type="submit"
                        class="bg-slate-900 text-white px-6 py-3 rounded-xl hover:bg-slate-800 transition"
                    >
                        Create Assignment
                    </button>
                    <a
                        href="/admin/assignments"
                        class="bg-slate-200 text-slate-700 px-6 py-3 rounded-xl hover:bg-slate-300 transition"
                    >
                        Cancel
                    </a>
                </div>

            </form>

        </div>

    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const userInput = document.getElementById('user_id'); 
        const departmentInput = document.getElementById('department_id'); 

        function toggleFields() {
            if (userInput.value !== "") {
                departmentInput.value = "";
                departmentInput.disabled = true;
            } else if (departmentInput.value !== "") {
                userInput.value = "";
                userInput.disabled = true;
            } else {
                userInput.disabled = false;
                departmentInput.disabled = false;
            }
        }

        if(userInput && departmentInput) {
            // Jalankan saat ada perubahan input
            userInput.addEventListener('change', toggleFields);
            departmentInput.addEventListener('change', toggleFields);
            
            // Jalankan saat halaman pertama dimuat (menjaga state jika ada return back old input)
            toggleFields();
        }
    });
    </script>

</x-app-layout>