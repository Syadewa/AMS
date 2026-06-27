<x-app-layout>

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">

        <div>

            <h2 class="text-xl font-semibold text-slate-800">
                User Management
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                Manage system users and access permissions.
            </p>

        </div>

        <a
            href="/admin/users/create"
            class="inline-flex items-center justify-center bg-slate-900 hover:bg-slate-800 text-white px-5 py-3 rounded-xl transition"
        >
            + Add User
        </a>

    </div>

    @if (session('success'))
        <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-800 text-sm font-medium flex items-center shadow-sm">
            <svg class="w-5 h-5 mr-3 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    @if (session('info'))
        <div class="mb-6 p-4 rounded-xl bg-blue-50 border border-blue-200 text-blue-800 text-sm font-medium flex items-center shadow-sm">
            <svg class="w-5 h-5 mr-3 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            {{ session('info') }}
        </div>
    @endif

    <div>
    <!-- Search -->

        <form
            method="GET"
            action="/admin/users"
            class="mb-6"
        >

            <div class="flex gap-3">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search by name, role or department..."
                    class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-slate-300 focus:outline-none"
                >

                <button
                    type="submit"
                    class="bg-slate-900 hover:bg-slate-800 text-white px-5 py-3 rounded-xl transition"
                >
                    Search
                </button>

            </div>

        </form>
        </div>

    <!-- Table -->
    <div class="overflow-x-auto">

        <table class="w-full">

            <thead class="bg-slate-50">

                <tr>

                    <th class="px-4 py-3 text-left text-sm font-semibold text-slate-600">
                        Name
                    </th>

                    <th class="px-4 py-3 text-left text-sm font-semibold text-slate-600">
                        Email
                    </th>

                    <th class="px-4 py-3 text-left text-sm font-semibold text-slate-600">
                        Role
                    </th>

                    <th class="px-4 py-3 text-left text-sm font-semibold text-slate-600">
                        Department
                    </th>

                    <th class="px-4 py-3 text-left text-sm font-semibold text-slate-600">
                        Status
                    </th>

                    <th class="px-4 py-3 text-center text-sm font-semibold text-slate-600">
                        Action
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($users as $user)

                    <tr class="border-t border-slate-100 hover:bg-slate-50 transition">

                        <td class="px-4 py-4 text-slate-700 font-medium">
                            {{ $user->name }}
                        </td>

                        <td class="px-4 py-4 text-slate-700">
                            {{ $user->email }}
                        </td>

                        <td class="px-4 py-4 text-slate-700">
                            {{ ucfirst($user->role) }}
                        </td>

                        <td class="px-4 py-4 text-slate-700">
                            {{ $user->department->nama_department ?? '-' }}
                        </td>

                        <td class="px-4 py-4">

                            @if($user->status == 'aktif')

                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-medium">
                                    Aktif
                                </span>

                            @else

                                <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm font-medium">
                                    Nonaktif
                                </span>

                            @endif

                        </td>

                        <td class="px-4 py-4 text-center">

                            <a
                                href="/admin/users/{{ $user->id }}/edit"
                                class="inline-flex items-center px-3 py-2 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200 transition text-sm font-medium"
                            >
                                Edit
                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="6"
                            class="text-center py-8 text-slate-500"
                        >
                            No users found
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>
    <div class="mt-6">

    {{ $users->links() }}

</div>

</div>

</x-app-layout>
