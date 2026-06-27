<x-app-layout>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

        {{-- Header --}}
        <div class="mb-6">

            <h1 class="text-2xl font-bold text-slate-800">
                My Assignments
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                View and manage your asset assignments.
            </p>

        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">

            <table class="w-full">

                <thead>

                    <tr class="border-b border-slate-200">

                        <th class="pb-4 text-left text-sm font-semibold text-slate-600">
                            Asset
                        </th>

                        <th class="pb-4 text-left text-sm font-semibold text-slate-600">
                            Assignment Date
                        </th>

                        <th class="pb-4 text-left text-sm font-semibold text-slate-600">
                            Status
                        </th>

                        <th class="pb-4 text-center text-sm font-semibold text-slate-600">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($assignments as $assignment)

                        <tr class="border-b border-slate-100">

                            {{-- Asset --}}
                            <td class="py-4">

                                <div class="font-medium text-slate-800">
                                    {{ $assignment->asset->nama_asset }}
                                </div>

                                <div class="text-xs text-slate-500">
                                    {{ $assignment->asset->kode_asset }}
                                </div>

                            </td>

                            {{-- Assignment Date --}}
                            <td class="py-4 text-slate-700">

                                {{ $assignment->tanggal_assignment }}

                            </td>

                            {{-- Status --}}
                            <td class="py-4">

                                @if($assignment->status_assignment == 'pending')

                                    <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm font-medium">
                                        Pending
                                    </span>

                                @elseif($assignment->status_assignment == 'aktif')

                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-medium">
                                        Active
                                    </span>

                                @elseif($assignment->status_assignment == 'ditolak')

                                    <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm font-medium">
                                        Rejected
                                    </span>

                                @elseif($assignment->status_assignment == 'selesai')

                                    <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-sm font-medium">
                                        Completed
                                    </span>

                                @endif

                            </td>

                            {{-- Action --}}
                            <td class="py-4">

                                @if($assignment->status_assignment == 'pending')

                                    <div class="flex justify-center gap-2">

                                        <form
                                            method="POST"
                                            action="{{ route('user.assignments.accept', $assignment->id) }}"
                                        >

                                            @csrf
                                            @method('PUT')

                                            <button
                                                type="submit"
                                                class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-lg text-sm transition"
                                            >
                                                Accept
                                            </button>

                                        </form>

                                        <form
                                            method="POST"
                                            action="{{ route('user.assignments.reject', $assignment->id) }}"
                                        >

                                            @csrf
                                            @method('PUT')

                                            <button
                                                type="submit"
                                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg text-sm transition"
                                            >
                                                Reject
                                            </button>

                                        </form>

                                    </div>

                                @elseif($assignment->status_assignment == 'aktif')

                                    <div class="text-center">

                                        <span class="text-green-600 font-medium">
                                            Accepted
                                        </span>

                                    </div>

                                @elseif($assignment->status_assignment == 'ditolak')

                                    <div class="text-center">

                                        <span class="text-red-600 font-medium">
                                            Rejected
                                        </span>

                                    </div>

                                @else

                                    <div class="text-center text-slate-500">
                                        -
                                    </div>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="4"
                                class="text-center py-10 text-slate-500"
                            >
                                No assignments found.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>