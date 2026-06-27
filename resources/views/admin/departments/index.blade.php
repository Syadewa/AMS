<x-app-layout>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">

            <div>

                <h2 class="text-xl font-semibold text-slate-800">
                    Department Management
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Manage department data for AMS.
                </p>

            </div>

            <a
                href="/admin/departments/create"
                class="inline-flex items-center justify-center bg-slate-900 hover:bg-slate-800 text-white px-5 py-3 rounded-xl transition"
            >
                + Add Department
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

        <!-- Table -->
        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-600">
                            Code
                        </th>

                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-600">
                            Department Name
                        </th>

                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-600">
                            Location
                        </th>

                        <th class="px-4 py-3 text-center text-sm font-semibold text-slate-600">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($departments as $department)

                        <tr class="border-t border-slate-100 hover:bg-slate-50 transition">

                            <td class="px-4 py-4 text-slate-700 font-medium">
                                {{ $department->kode_department }}
                            </td>

                            <td class="px-4 py-4 text-slate-700">
                                {{ $department->nama_department }}
                            </td>

                            <td class="px-4 py-4 text-slate-700">
                                {{ $department->lokasi }}
                            </td>

                            <td class="px-4 py-4 text-center">

                                <a
                                    href="/admin/departments/{{ $department->id_department }}/edit"
                                    class="inline-flex items-center px-3 py-2 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200 transition text-sm font-medium"
                                >
                                    Edit
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="4"
                                class="text-center py-8 text-slate-500"
                            >
                                No departments found
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>