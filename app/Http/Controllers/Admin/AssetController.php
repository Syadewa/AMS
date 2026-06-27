<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\AssetCategory;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Validation\Rule;

class AssetController extends Controller
{
    public function index()
    {
        $query = Asset::with(
        'category',
        'department'
    );

    if(request('search')) {

        $search = request('search');

        $query->where(function($q) use ($search){

            $q->where(
                'kode_asset',
                'like',
                "%{$search}%"
            )

            ->orWhere(
                'nama_asset',
                'like',
                "%{$search}%"
            )

            ->orWhere(
                'serial_number',
                'like',
                "%{$search}%"
            );

        });

    }

    $assets = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();

    return view(
        'admin.assets.index',
        compact('assets')
    );
    }

    public function create()
    {
        $categories = AssetCategory::all();
        $departments = Department::all();
        return view('admin.assets.create', compact('categories', 'departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_asset' => 'required|unique:assets,kode_asset',
            'nama_asset' => 'required|string|max:255',
            'kategori_id' => 'required|exists:asset_categories,id',
            'serial_number' => 'required|unique:assets,serial_number',
            'tanggal_perolehan' => 'required|date',
            'tipe_asset' => 'required|in:individual,shared',
            'status_asset' => 'required|in:aktif,nonaktif,rusak,dilepas',
            'department_id' => 'required|exists:departments,id_department',
            'deskripsi' => 'nullable|string',
        ]);
        
        $asset = Asset::create(array_merge($validated, [
            'created_by' => Auth::id(),
        ]));

        $qrContent = url('/assets/public/' . $asset->getKey());
        $qrImage = QrCode::format('svg')
            ->size(300)
            ->generate($qrContent);

        $fileName = 'qr_codes/' . $asset->getKey() . '.svg';
        Storage::disk('public')->put($fileName, $qrImage);

        $asset->update(['qr_code_path' => $fileName]);

        return redirect('admin/assets')->with('success', 'Asset created successfully.');
    }

    public function edit(int $id)
        {
            $asset = Asset::findOrFail($id);
            $categories = AssetCategory::all();
            $departments = Department::all();
            return view('admin.assets.edit', compact('asset', 'categories', 'departments'));
        }

    public function update(Request $request, int $id)
    {   
        $asset = Asset::findOrFail($id);

        $validated = $request->validate([
            'kode_asset' => [
                'required',
                Rule::unique('assets', 'kode_asset')->ignore($asset->getKey(), $asset->getKeyName())
            ],
            'nama_asset' => 'required|string|max:255',
            'kategori_id' => 'required|exists:asset_categories,id', // Sesuaikan key jika custom
            'serial_number' => [
                'required',
                Rule::unique('assets', 'serial_number')->ignore($asset->getKey(), $asset->getKeyName())
            ],
            'tanggal_perolehan' => 'required|date',
            'tipe_asset' => 'required|in:individual,shared',
            'status_asset' => 'required|in:aktif,nonaktif,rusak,dilepas',
            'department_id' => 'required|exists:departments,id_department',
            'deskripsi' => 'nullable|string',
        ]);

        $asset->fill($validated);

        if ($asset->isDirty()) {
            $asset->save();
            return redirect('admin/assets')->with('success', 'Data asset berhasil diperbarui.');
        }

        return redirect('admin/assets/')->with('info', 'Tidak ada perubahan data asset yang disimpan.');
    }

    public function showPublic(int $id)
    {
        $asset = Asset::with('category', 'department')
        ->findOrFail($id);
        return view('public.asset-detail', compact('asset'));
    }

        public function show(int $id)
        {
            $asset = Asset::with(
            'category', 
            'department',
            'creator', 

            'assignments.user', 
            'assignments.department',
            'assignments.assignedBy',

            'mutations.fromUser', 
            'mutations.toUser',
            'mutations.fromDepartment', 
            'mutations.toDepartment',
            'mutations.requestedBy',
            
            'maintenances.requestedBy',
            'maintenances.handledBy',

            'disposal.requestedBy',
            'disposal.approvedBy'
            
            )->findOrFail($id);
            return view('admin.assets.show', compact('asset'));
        }   

}
