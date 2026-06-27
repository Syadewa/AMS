<x-app-layout>

    <div class="max-w-3xl">

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

            <h1 class="text-2xl font-bold mb-6">
                Create User
            </h1>

            <form method="POST" action="/admin/users" class="space-y-5">

                @csrf

                <div>
                    <label class="block mb-2 font-medium">
                        Name
                    </label>

                    <input 
                        type="text"
                        name="name"
                        required
                        class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                </div>

                <div>
                    <label class="block mb-2 font-medium">
                        Email Address
                    </label>

                    <input 
                        type="email"
                        name="email"
                        required
                        class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                </div>

                <div>
                    <label class="block mb-2 font-medium">
                        Role
                    </label>

                    <select 
                        name="role"
                        required
                        class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        <option value="admin">Admin</option>
                        <option value="manager">Manager</option>
                        <option value="user">User</option>
                    </select>
                </div>

                <div>
                    <label class="block mb-2 font-medium">
                        Department
                    </label>

                    <select 
                        name="department_id"
                        required
                        class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >

                        @foreach ($departments as $department)

                            <option value="{{ $department->id_department }}">
                                {{ $department->nama_department }}
                            </option>

                        @endforeach

                    </select>
                </div>

            <div class="flex gap-3">

                <button 
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg transition">
                    Save
                </button>

                <a 
                href="/admin/users"
                class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-6 py-3 rounded-xl transition"
                 >
                Cancel
                </a>

            <div>

            </form>

        </div>

    </div>

</x-app-layout>