<x-app-layout>

    <div class="max-w-3xl">

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

            <h1 class="text-2xl font-bold mb-6">
                Edit User
            </h1>

            <form method="POST" action="/admin/users/{{ $user->id }}">

                @csrf
                @method('PUT')

                <div class="mb-4">

                    <label class="block mb-2 font-medium">
                        Nama
                    </label>

                    <input 
                        type="text"
                        name="name"
                        value="{{ $user->name }}"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                </div>

                <div class="mb-4">

                    <label class="block mb-2 font-medium">
                        Email
                    </label>

                    <input 
                        type="email"
                        name="email"
                        value="{{ $user->email }}"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                </div>

                <div class="mb-4">

                    <label class="block mb-2 font-medium">
                        Role
                    </label>

                    <select 
                        name="role"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>
                            Admin
                        </option>

                        <option value="manager" {{ $user->role == 'manager' ? 'selected' : '' }}>
                            Manager
                        </option>

                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>
                            User
                        </option>

                    </select>

                </div>

                <div class="mb-4">

                    <label class="block mb-2 font-medium">
                        Status
                    </label>

                    <select 
                        name="status"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                        <option value="aktif" {{ $user->status == 'aktif' ? 'selected' : '' }}>
                            Aktif
                        </option>

                        <option value="nonaktif" {{ $user->status == 'nonaktif' ? 'selected' : '' }}>
                            Nonaktif
                        </option>

                    </select>

                </div>

                <div class="mb-6">

                    <label class="block mb-2 font-medium">
                        Department
                    </label>

                    <select 
                        name="department_id"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                        @foreach ($departments as $department)

                            <option 
                                value="{{ $department->id_department }}"
                                {{ $user->department_id == $department->id_department ? 'selected' : '' }}
                            >
                                {{ $department->nama_department }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <button 
                    type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded-lg"
                >
                    Update User
                </button>

            </form>

        </div>

    </div>

</x-app-layout>