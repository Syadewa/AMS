<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\AssetMutation;
use App\Models\Department;
use App\Models\User;
use App\Models\AssetAssignment;
use Illuminate\Http\Request;
use App\Models\AssetMaintenance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AssetMutationController extends Controller
{
    public function index()
    {
        $mutations = AssetMutation::with([
            'asset',
            'fromUser',
            'toUser',
            'fromDepartment',
            'toDepartment',
            'requestedBy'
        ])
        ->latest()
        ->paginate(15);

        return view(
            'admin.mutations.index',
            compact('mutations')
        );
    }

    public function create()
    {
        $assets = Asset::where('status_asset','aktif')
    ->whereHas('assignments', function ($query) {
        $query->where('status_assignment','aktif');

    })
    ->with([
        'assignments' => function ($query) {

            $query->where(
                'status_assignment',
                'aktif'
            );

        }
    ])
    ->get();

        $users = User::all();

        $departments = Department::all();

        return view(
            'admin.mutations.create',
            compact(
                'assets',
                'users',
                'departments'
            ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'tanggal_mutasi' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        // Validasi Eksklusivitas Tujuan
        if (!$request->to_user_id && !$request->to_department_id) {
            return back()->withInput()->withErrors(['destination' => 'Pilih tujuan mutasi.']);
        }

        if ($request->to_user_id && $request->to_department_id) {
            return back()->withInput()->withErrors(['destination' => 'Mutasi hanya boleh ke user atau department.']);
        }

        // Amankan penarikan data Asset dengan findOrFail agar kebal dari manipulasi reques
        $asset = Asset::findOrFail($request->asset_id);

        if ($asset->status_asset !== 'aktif') {
            return back()->withInput()->withErrors(['asset_id' => 'Hanya asset dengan status aktif yang dapat dimutasikan.']);
        }

        // Validasi Kesesuaian Tipe Aset dengan Tujuan
        if ($asset->tipe_asset == 'individual' && !$request->to_user_id) {
            return back()->withInput()->withErrors(['destination' => 'Asset individual hanya dapat dimutasikan ke user.']);
        }

        if ($asset->tipe_asset == 'shared' && !$request->to_department_id) {
            return back()->withInput()->withErrors(['destination' => 'Asset department hanya dapat dimutasikan ke department.']);
        }

        // Ambil data assignment aktif saat ini
        $assignment = AssetAssignment::where('asset_id', $asset->id)
                                      ->where('status_assignment', 'aktif')
                                      ->first();
        
        

        if (!$assignment) { 
            return back()->withInput()->withErrors(['asset_id' => 'Asset tidak memiliki assignment aktif di sistem.']);
        }

                /*
        |--------------------------------------------------------------------------
        | Prevent Mutation To Same Owner
        |--------------------------------------------------------------------------
        */

        if ($assignment->user_id && $request->to_user_id && $assignment->user_id == $request->to_user_id) {
            return back()->withInput()->withErrors(['destination' => 'Asset tidak dapat dimutasikan ke user yang sama.']);
        }

        if ($assignment->department_id && $request->to_department_id && $assignment->department_id == $request->to_department_id) {
            return back()->withInput()->withErrors(['destination' => 'Asset tidak dapat dimutasikan ke department yang sama.']);
        }

        // Cek Mutasi Pending & Proses Maintenance Aktif
        if (AssetMutation::where('asset_id', $asset->id)->where('status_mutasi', 'pending')->exists()) {
            return back()->withInput()->withErrors(['asset_id' => 'Asset memiliki proses pengajuan mutasi yang masih pending.']);
        }

        $activeMaintenance = AssetMaintenance::where('asset_id', $asset->id)
            ->whereIn('status_maintenance', ['pending', 'diproses'])
            ->exists();

        if ($activeMaintenance) {
            return back()->withInput()->withErrors(['asset_id' => 'Asset tidak dapat dimutasi karena sedang dalam proses maintenance.']);
        }

        $isDepartmentMutation = !empty($request->to_department_id);

        DB::beginTransaction();

        try {
            $mutation = AssetMutation::create([
                'asset_id' => $asset->id,
                'from_user_id' => $assignment->user_id,
                'from_department_id' => $assignment->department_id,
                'to_user_id' => $request->to_user_id,
                'to_department_id' => $request->to_department_id,
                'requested_by' => Auth::id(),
                'tanggal_mutasi' => $request->tanggal_mutasi,
                'status_mutasi' => $isDepartmentMutation ? 'disetujui' : 'pending',
                'accepted_at' => $isDepartmentMutation ? now() : null,
                'notes' => $request->notes,
            ]);

            // Jika mutasi antar departemen, eksekusi pembaruan hak akses langsung (Auto-Approval)
            if ($isDepartmentMutation) {
                // 1. Selesaikan assignment lama
                $assignment->update([
                    'status_assignment' => 'selesai',
                    'tanggal_selesai' => now(), 
                ]);

                // 2. Buat lembar assignment baru untuk departemen tujuan
                AssetAssignment::create([
                    'asset_id' => $mutation->asset_id,
                    'user_id' => null,
                    'department_id' => $mutation->to_department_id,
                    'assigned_by' => Auth::id(),
                    'tanggal_assignment' => now(),
                    'status_assignment' => 'aktif',
                    'accepted_at' => now(),
                ]);

                // 3. FIX CRITICAL BUG: Sinkronisasikan kolom department_id di tabel induk assets
                $asset->update([
                    'department_id' => $mutation->to_department_id
                ]);
            }

            DB::commit();
            return redirect('/admin/mutations')->with('success', 'Data mutasi aset berhasil diproses.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Gagal memproses mutasi: ' . $e->getMessage()]);
        }
    }
}
