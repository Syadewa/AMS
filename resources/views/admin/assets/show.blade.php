<x-app-layout>

    <div class="space-y-6">

         <h1 class="text-2xl font-bold mb-6">
            Asset Detail
        </h1>

        {{-- Asset Information --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <div class="space-y-4">

                    <h2 class="text-xl font-semibold mb-4">
                        Asset Information
                    </h2>

                    <div>

                        <label class="text-sm text-slate-500">
                        Kode Asset
                        </label>

                        <p class="text-lg font-semibold text-slate-900">
                            {{ $asset->kode_asset }}
                        </p>

                    </div>
                    
                    <div>

                        <label class="text-sm text-slate-500">
                            Nama Asset
                        </label>

                        <p class="text-lg font-semibold text-slate-900">
                            {{ $asset->nama_asset }}
                        </p>

                    </div>

                    <div>

                        <label class="text-sm text-slate-500">
                        Nama Kategori
                        </label>

                        <p class="font-medium text-slate-800">
                            
                            {{ $asset->category?->nama_kategori }}
                        </p>

                    </div>

                    <div>

                        <label class="text-sm text-slate-500">
                            Tipe Asset
                        </label>

                        <p class="font-medium text-slate-800">
                            {{ ucfirst($asset->tipe_asset) }}
                        </p>

                    </div>

                    <div>
                    <label class = "text-sm text-slate-500">
                      Status
                      </label>

                      <p>
                             @switch($asset->status_asset)

                            @case('aktif')

                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-medium">
                                    Aktif
                                </span>

                                @break

                            @case('nonaktif')

                                <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm font-medium">
                                    Nonaktif
                                </span>

                                @break

                            @case('rusak')

                                <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm font-medium">
                                    Rusak
                                </span>

                                @break

                            @case('dilepas')

                                <span class="px-3 py-1 rounded-full bg-slate-200 text-slate-700 text-sm font-medium">
                                    Dilepas
                                </span>

                                @break

                            @default

                                <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-500 text-sm font-medium">
                                    Unknown
                                </span>

                        @endswitch

                    </p>
                    </div>

                    <div>
                    <label class="text-sm text-slate-500">
                    Serial Number
                    </label>

                    <p class="font-medium text-slate-800">
                        {{ $asset->serial_number }}
                    </p>
                    </div>


                    <div>
                    <label class="text-sm text-slate-500">
                    Department
                    </label>

                    <p class="font-medium text-slate-800">
                        {{ $asset->department?->nama_department }}
                    </p>

                    </div>

                </div>

                <div class="flex flex-col items-center">

                    @if($asset->qr_code_path)

                        <img
                            src="{{ asset('storage/' . $asset->qr_code_path) }}"
                            alt="QR Code"
                            class="w-48 h-48 border border-slate-200 rounded-xl p-2 bg-white"
                        >

                    <div class="flex gap-3 mt-4">
                        <a
                            href="{{ asset('storage/' . $asset->qr_code_path) }}"
                            target="_blank"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700"
                        >
                            View QR Code
                        </a>

                        <a href="{{ asset('storage/' . $asset->qr_code_path) }}"
                            download
                            class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700"
                        >
                            Download QR Code
                        </a>
                    </div>

                    @endif

                    

                </div>

            </div>

        </div>

        {{-- Current Assignment --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

            <h2 class="text-xl font-semibold mb-4">
                Current Assignment
            </h2>

            @php

                $currentAssignment =
                    $asset->assignments
                        ->where('status_assignment', 'aktif')
                        ->first();

            @endphp

            @if($currentAssignment)

            <div class="space-y-4">

                @if($asset->tipe_asset == 'individual')

                <div>

                    <label class="text-sm text-slate-500">
                        Assigned User
                    </label>

                    <p class="font-medium text-slate-800">

                        {{ $currentAssignment->user?->name }}

                    </p>
                </div>    

                @else

                <div>

                    <label class="text-sm text-slate-500">
                    Assigned Department
                    </label>

                    <p class="font-medium text-slate-800">

                        {{ $currentAssignment->department?->nama_department }}

                    </p>
                </div>

                @endif

                <div>

                <label class="text-sm text-slate-500">
                Assignment Date 
                </label>

                <p class="font-medium text-slate-800">

                    {{ $currentAssignment->tanggal_assignment }}

                </p>
                </div>
                </div>

            @else
                <div class="bg-slate-50 border border-slate-200 rounded-xl p-4">
                <p class="text-slate-500">

                    No active assignment

                </p>
                </div>

            @endif
            

        </div>

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

    <h2 class="text-xl font-semibold mb-4">
        Assignment History
    </h2>

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead class="bg-slate-100">

                <tr>

                    <th class="px-4 py-3 text-left">
                        Holder
                    </th>

                    <th class="px-4 py-3 text-left">
                        Assigned At
                    </th>

                    <th class="px-4 py-3 text-left">
                        Completed At
                    </th>

                    <th class="px-4 py-3 text-left">
                        Status
                    </th>

                    <th class="px-4 py-3 text-left">
                        Document
                    </th>

                </tr>

            </thead>

            <tbody>

                @foreach(
                    $asset->assignments
                        ->sortByDesc('created_at')
                    as $assignment
                )

                    <tr class="border-t">

                        <td class="px-4 py-3">

                            {{
                                $assignment->user?->name
                                ??
                                $assignment->department?->nama_department
                                ??
                                '-'
                            }}

                        </td>

                        <td class="px-4 py-3">

                            {{ $assignment->tanggal_assignment }}

                        </td>

                        <td class="px-4 py-3">

                            {{ $assignment->tanggal_selesai ?? '-' }}

                        </td>

                        <td class="px-4 py-3">

                            @if($assignment->status_assignment == 'pending')

                                <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm font-medium">
                                    Pending
                                </span>

                            @elseif($assignment->status_assignment == 'aktif')

                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-medium">
                                    Aktif
                                </span>

                            @elseif($assignment->status_assignment == 'ditolak')

                                <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm font-medium">
                                    Ditolak
                                </span>

                            @elseif($assignment->status_assignment == 'selesai')

                                <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-sm font-medium">
                                    Selesai
                                </span>

                            @endif

                        </td>

                        <td class="px-4 py-3">

                            @if($assignment->handover_document_path)

                                <a
                                    href="{{ asset('storage/' . $assignment->handover_document_path) }}"
                                    target="_blank"
                                    class="px-3 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-sm transition"
                                >
                                    View BASTA
                                </a>

                            @else

                                <span class="text-slate-400">
                                    -
                                </span>

                            @endif

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

    <h2 class="text-xl font-semibold mb-4">
        Mutation History
    </h2>

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead class="bg-slate-100">

                <tr>

                    <th class="px-4 py-3 text-left">
                        From
                    </th>

                    <th class="px-4 py-3 text-left">
                        To
                    </th>

                    <th class="px-4 py-3 text-left">
                        Date
                    </th>

                    <th class="px-4 py-3 text-left">
                        Status
                    </th>

                    <th class="px-4 py-3 text-left">
                        Document
                    </th>

                </tr>

            </thead>

            <tbody>

                @foreach(
                    $asset->mutations
                        ->sortByDesc('created_at')
                    as $mutation
                )

                    <tr class="border-t">

                        <td class="px-4 py-3">

                            {{
                                $mutation->fromUser?->name
                                ??
                                $mutation->fromDepartment?->nama_department
                                ??
                                '-'
                            }}

                        </td>

                        <td class="px-4 py-3">

                            {{
                                $mutation->toUser?->name
                                ??
                                $mutation->toDepartment?->nama_department
                                ??
                                '-'
                            }}

                        </td>

                        <td class="px-4 py-3">

                            {{ $mutation->tanggal_mutasi }}

                        </td>

                        <td class="px-4 py-3">

                            @if($mutation->status_mutasi == 'pending')

                                <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm font-medium">
                                    Pending
                                </span>

                            @elseif($mutation->status_mutasi == 'ditolak')

                                <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm font-medium">
                                    Ditolak
                                </span>

                            @elseif($mutation->status_mutasi == 'disetujui')

                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-medium">
                                    Disetujui
                                </span>

                            @endif

                        </td>

                        <td class="px-4 py-3">
                        @if($mutation->dokumen_mutasi)

                        <a
                            href="{{ asset('storage/' . $mutation->dokumen_mutasi) }}"
                            target="_blank"
                            class="px-3 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-sm transition"
                        >
                            View BA Mutasi
                        </a>

                            @else

                                <span class="text-slate-400">
                                    -
                                </span>

                            @endif
                                

                                </td>

                        

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

    <h2 class="text-xl font-semibold mb-4">
        Maintenance History
    </h2>

    <div class="overflow-x-auto">

    <table class="w-full">

        <thead class="bg-slate-100">

            <tr>

                <th class="px-4 py-3 text-left"> 
                    Date 
                </th> 
                
                <th class="px-4 py-3 text-left"> 
                    Requested By 
                </th> 
                
                <th class="px-4 py-3 text-left"> 
                    Status 
                </th> 
                
                <th class="px-4 py-3 text-left"> 
                    Handled By 
                </th> 
                
                <th class="px-4 py-3 text-center"> 
                
                    Action 
                </th>
            </tr>

        </thead>

        <tbody>

            @forelse($asset->maintenances 
                    ->sortByDesc('created_at')
            
            as $maintenance)

                <tr class="border-t">

                    <td class="px-4 py-3">

                        {{ $maintenance->tanggal_pengajuan }}

                    </td>

                    <td class="px-4 py-3">

                        {{ $maintenance->requestedBy?->name }}

                    </td>

                    <td class="px-4 py-3">

                        @if($maintenance->status_maintenance == 'pending') 
                        
                            <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm font-medium">
                                 Pending 
                            </span> 
                            
                        @elseif($maintenance->status_maintenance == 'diproses') 
                            
                            <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm font-medium"> 
                                  Diproses 
                            </span> 
                        
                        @elseif($maintenance->status_maintenance == 'selesai') 
                            
                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-medium"> 
                                  Selesai 
                            </span> 
                        
                        @elseif($maintenance->status_maintenance == 'ditolak') 

                            <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm font-medium"> 
                            Ditolak 
                            </span> 
                        @endif

                    </td>

                    <td class="px-4 py-3">

                        {{ $maintenance->handledBy?->name ?? '-' }}

                    </td>

                    <td class="px-4 py-3 text-center">

                    <a
                        href="/admin/maintenances/{{ $maintenance->id }}"
                        class="inline-flex items-center px-3 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
                    >
                        View
                    </a>

                </td>

                </tr>

            @empty

                <tr>

                    <td colspan="5" class="text-center py-8 text-slate-500">

                        No maintenance history found.

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>
    </div>

</div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

    <h2 class="text-xl font-semibold mb-4">
        Disposal Information
    </h2>

    @if($asset->disposal)
    <div class="space-y-4">

        <div>

        <label class="text-sm text-slate-500">
            Jenis Pelepasan
        </label>

        <p class="font-medium text-slate-800">

            {{ ucfirst($asset->disposal->jenis_pelepasan) }}

        </p>

        </div>

        <div>

        <label class="text-sm text-slate-500">

            Status
        </label>

            <div class="mt-1">

            @if($asset->disposal->status_approval == 'pending')

                <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm font-medium">
                    Pending 
                </span>
            @elseif($asset->disposal->status_approval == 'disetujui')

                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-medium">
                    Disetujui
                </span>
            
            @else
                <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm font-medium">
                    Ditolak
                </span>
            @endif

            </div>
        </div>

        <div>

        <label class="text-sm text-slate-500">
            Requested By
        </label>

        <p class="font-medium text-slate-800">

            {{ $asset->disposal->requestedBy?->name }}

        </p>

        </div>

        <div>

            <label class="text-sm text-slate-500">
             Approved By 
            </label> 
            
            <p class="font-medium text-slate-800"> 
            {{ $asset->disposal->approvedBy?->name ?? '-' }} 
            </p>

        </div>

        <div>

            <label class="text-sm text-slate-500"> 
                Date Request
            </label> 
            
            <p class="font-medium text-slate-800"> 
                {{ $asset->disposal->tanggal_pengajuan }} 
            </p>

        </div>

        <div>

            <label class="text-sm text-slate-500"> 
                Disposal Reason 
            </label> 
            
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 mt-1"> 
                {{ $asset->disposal->alasan }}
            </div>

        </div>

        @if($asset->disposal->berita_acara_path)

            <div> 
                
                <label class="text-sm text-slate-500 block mb-3"> 
                    Disposal Report 
                </label> 
                
                <div class="flex gap-3"> 
                
                    <a 
                        href="{{ asset('storage/' . $asset->disposal->berita_acara_path) }}" 
                        target="_blank" 
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition" 
                    > View Document 
                    </a> 
                    
                    <a 
                        href="{{ asset('storage/' . $asset->disposal->berita_acara_path) }}"
                        download 
                        class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition" 
                    > Download Document 
                    </a> 
                </div>
            </div>

        @endif

    @else
        <div class="bg-slate-50 border border-slate-200 rounded-xl p-4">
        <p class="text-slate-500">

            No disposal record found.

        </p>

    @endif

</div>
    </div>


</x-app-layout>