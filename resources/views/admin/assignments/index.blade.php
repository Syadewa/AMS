<x-app-layout>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

        <div class="flex justify-between items-center mb-6">

            <div>
                <h1 class="text-2xl font-bold text-slate-800">
                    Asset Assignments
                </h1>

                <p class="text-sm text-slate-500">
                    Manage asset assignment records
                </p>
            </div>

            <a href="/admin/assignments/create"
               class="bg-slate-900 text-white px-4 py-2 rounded-lg">
                + Create Assignment
            </a>

        </div>

        <div>
        <!-- Search -->

            <form
                method="GET"
                action="/admin/assignments"
                class="mb-6"
            >

                <div class="flex gap-3">

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search by asset, assigned to, or status..."
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

        @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl mb-4 text-sm font-medium">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if($errors->has('error'))
            <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-xl mb-4 text-sm font-medium">
                ❌ {{ $errors->first('error') }}
            </div>
        @endif

        <div class="bg-white shadow-sm rounded-xl overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-100">

                    <tr>

                        <th class="px-4 py-3 text-left">
                            Asset
                        </th>

                        <th class="px-4 py-3 text-left">
                            Assigned To
                        </th>

                        <th class="px-4 py-3 text-center">
                            Assigned By
                        </th>

                        <th class="px-4 py-3 text-left">
                            Assignment Date
                        </th>

                        <th class="px-4 py-3 text-center">
                            Status
                        </th>

                        <th class="px-4 py-3 text-center">
                            Accepted At
                        </th>

                        <th class="px-4 py-3 text-left">
                            Rejected At
                        </th>

                        <th class="px-4 py-3 text-left">
                            Completed At
                        </th>

                        <th class="px-4 py-3 text-center">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($assignments as $assignment)

                        <tr class="border-t">

                            {{-- Asset --}}
                            <td class="px-4 py-3">

                                <div class="font-medium">
                                    {{ $assignment->asset->nama_asset }}
                                </div>

                                <div class="text-xs text-slate-500">
                                    {{ $assignment->asset->kode_asset }}
                                </div>

                            </td>


                            {{-- Assigned To --}}
                            <td class="px-4 py-3">

                                @if($assignment->user)

                                    {{ $assignment->user->name }}

                                @elseif($assignment->department)

                                    {{ $assignment->department->nama_department }}

                                @else

                                    -

                                @endif

                            </td>

                            {{-- Assigned By --}}
                            <td class="px-4 py-3">

                                {{ $assignment->assignedBy->name ?? '-' }}

                            </td>

                            {{-- Date --}}
                            <td class="px-4 py-3">

                                {{ $assignment->tanggal_assignment }}

                            </td>

                            {{-- Status --}}
                            <td class="px-4 py-3 text-center">

                                @if($assignment->status_assignment == 'pending')

                                    <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm">
                                        Pending
                                    </span>

                                @elseif($assignment->status_assignment == 'aktif')

                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">
                                        Aktif
                                    </span>

                                @elseif($assignment->status_assignment == 'ditolak')

                                    <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm">
                                        Ditolak
                                    </span>

                                @elseif($assignment->status_assignment == 'selesai')

                                    <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-sm">
                                        Selesai
                                    </span>

                                @endif

                            </td>

                            {{-- Accepted At --}}
                            <td class="px-4 py-3">

                                @if($assignment->accepted_at)

                                    {{ \Carbon\Carbon::parse($assignment->accepted_at)
                                        ->format('d M Y H:i') }}

                                @else

                                    -

                                @endif

                            </td>

                            {{-- Rejected At --}}
                            <td class="px-4 py-3">

                                @if($assignment->rejected_at)

                                    {{ \Carbon\Carbon::parse($assignment->rejected_at)
                                        ->format('d M Y H:i') }}

                                @else

                                    -

                                @endif

                            </td>


                            {{-- Completed At --}}
                            <td class="px-4 py-3">

                                @if($assignment->tanggal_selesai)

                                    {{ \Carbon\Carbon::parse($assignment->tanggal_selesai)
                                        ->format('d M Y H:i') }}

                                @else

                                    -

                                @endif

                            </td>
                            

                            {{-- Action --}}
                            <td class="px-4 py-3 text-center">

                                @if($assignment->status_assignment == 'pending')

                                    <span class="text-yellow-600 text-sm">
                                        Waiting User Response
                                    </span>

                                @elseif($assignment->status_assignment == 'aktif')

                                    <form method="POST"
                                          action="/admin/assignments/{{ $assignment->id }}/return">

                                        @csrf
                                        @method('PUT')

                                        <button
                                            type="submit"
                                            class="bg-blue-600 text-white px-3 py-1 rounded-lg text-sm">
                                            Return Asset
                                        </button>

                                    </form>

                                @else

                                    <span class="text-slate-500 text-sm">
                                        -
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7"
                                class="text-center py-8 text-slate-500">

                                No assignments found

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>