<x-app-layout>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

        <!-- Header -->
        <div class="mb-6">

            <h2 class="text-xl font-semibold text-slate-800">
                My Assets
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                Assets currently assigned to you.
            </p>

        </div>

        <!-- Table -->
        <div class="overflow-x-auto">

            <table class="w-full">

                <thead>

                    <tr class="border-b border-slate-200">

                        <th class="text-left pb-4 text-sm font-semibold text-slate-600">
                            Asset Code
                        </th>

                        <th class="text-left pb-4 text-sm font-semibold text-slate-600">
                            Asset Name
                        </th>

                        <th class="text-left pb-4 text-sm font-semibold text-slate-600">
                            Category
                        </th>

                        <th class="text-left pb-4 text-sm font-semibold text-slate-600">
                            Serial Number
                        </th>

                        <th class="text-left pb-4 text-sm font-semibold text-slate-600">
                            Assigned Date
                        </th>

                        <th class="text-left pb-4 text-sm font-semibold text-slate-600">
                            Status
                        </th>

                        <th class="text-left pb-4 text-sm font-semibold text-slate-600">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($assignments as $assignment)

                        <tr class="border-b border-slate-100">

                            <td class="py-4">
                                {{ $assignment->asset->kode_asset }}
                            </td>

                            <td class="py-4">
                                {{ $assignment->asset->nama_asset }}
                            </td>

                            <td class="py-4">
                                {{ $assignment->asset->category?->nama_kategori }}
                            </td>

                            <td class="py-4">
                                {{ $assignment->asset->serial_number }}
                            </td>

                            <td class="py-4">
                                {{ $assignment->tanggal_assignment }}
                            </td>

                            <td class="py-4">

                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">

                                    Aktif

                                </span>

                            </td>
                            
                            <td class="py-4">

                                <a
                                    href="/user/assets/{{ $assignment->asset->id }}"
                                    class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-sm"
                                >
                                    View
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="text-center py-8 text-slate-500"
                            >

                                No active assets found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>