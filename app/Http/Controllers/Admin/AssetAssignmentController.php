<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssetAssignment;
use App\Models\Asset;
use App\Models\Department;
use App\Models\User;
use App\Models\AssetMaintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AssetAssignmentController extends Controller
{
       public function index()
    {
        $query = AssetAssignment::with([
            'asset',
            'user',
            'department',
            'assignedBy'
        ]);

        if (request('search')) {
            $search = request('search');

            $query->where(function ($mainQuery) use ($search) {
                $mainQuery->whereHas('asset', function ($q) use ($search) {
                    $q->where('nama_asset', 'like', "%{$search}%")
                      ->orWhere('kode_asset', 'like', "%{$search}%");
                })
                ->orWhereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            });
        }

        $assignments = $query->latest()
                             ->paginate(10)
                             ->withQueryString();

        return view('admin.assignments.index', compact('assignments'));
    }

    public function create()
    {
        $assets = Asset::where('status_asset', 'aktif')
            ->whereDoesntHave('assignments', function ($query) {
                $query->whereIn('status_assignment', ['pending', 'aktif']);
            })
            ->get();

        $users = User::all();
        $departments = Department::all();

        return view('admin.assignments.create', compact('assets', 'users', 'departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'tanggal_assignment' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $asset = Asset::findOrFail($request->asset_id);

        if ($asset->status_asset !== 'aktif') {
            return back()->withInput()->withErrors(['error' => 'Hanya asset dengan status aktif yang dapat di-assign.']);
        }

        if ($asset->tipe_asset == 'individual') {
            $request->validate(['user_id' => 'required|exists:users,id']);
        }

        if ($asset->tipe_asset == 'shared') {
            $request->validate(['department_id' => 'required|exists:departments,id_department']);
        }

        if ($request->user_id && $request->department_id) {
            return back()->withInput()->withErrors(['error' => 'Assignment tidak boleh memiliki user dan department sekaligus.']);
        }

        $existingAssignment = AssetAssignment::where('asset_id', $asset->id)
            ->whereIn('status_assignment', ['pending', 'aktif'])
            ->exists();
        
        if ($existingAssignment) { 
            return back()->withInput()->withErrors(['asset_id' => 'Asset sudah memiliki assignment aktif atau pending.']);
        }

        $activeMaintenance = AssetMaintenance::where('asset_id', $asset->id)
            ->whereIn('status_maintenance', ['pending', 'diproses'])
            ->exists();

        if ($activeMaintenance) {
            return back()->withInput()->withErrors(['asset_id' => 'Asset sedang dalam proses maintenance.']);
        }

        $status = 'pending';
        $acceptedAt = null;

        if ($asset->tipe_asset == 'shared') {
            $status = 'aktif';
            $acceptedAt = now();
        }

        DB::beginTransaction();
        try {
            AssetAssignment::create([
                'asset_id' => $asset->id,
                'user_id' => $request->user_id,
                'department_id' => $request->department_id,
                'assigned_by' => Auth::id(),
                'tanggal_assignment' => $request->tanggal_assignment,
                'status_assignment' => $status,
                'accepted_at' => $acceptedAt,
                'notes' => $request->notes,
            ]);

            // FIX CRITICAL SINKRONISASI: Amankan department_id di tabel assets dari awal pembuatan transaksi
            if ($asset->tipe_asset == 'shared') {
                $asset->update([
                    'department_id' => $request->department_id
                ]);
            } else {
                // Jika individual, cari departemen user tujuan dan update tabel assets saat itu juga
                $targetUser = User::find($request->user_id);
                if ($targetUser && $targetUser->department_id) {
                    $asset->update([
                        'department_id' => $targetUser->department_id
                    ]);
                }
            }

            DB::commit();
            return redirect('/admin/assignments')->with('success', 'Asset assignment berhasil dibuat.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Gagal membuat assignment: ' . $e->getMessage()]);
        }
    }

    public function returnAsset(int $id)
    {
        $assignment = AssetAssignment::findOrFail($id);

        // Berdasarkan logikamu: Aset tetap tinggal di departemen terakhir saat dikembalikan
        $assignment->update([
            'tanggal_selesai' => now(),
            'status_assignment' => 'selesai',
        ]);

        return redirect('/admin/assignments')->with('success', 'Asset berhasil dikembalikan dan menetap di departemen ini.');
    }

    public function accept(int $id)
    {
        $assignment = AssetAssignment::findOrFail($id);

        DB::beginTransaction();
        try {
            $assignment->update([
                'status_assignment' => 'aktif',
                'accepted_at' => now(),
            ]);

            // Tetap dipasang untuk memastikan validasi ulang jika ada perubahan departemen user di tengah jalan
            $user = User::find($assignment->user_id);
            if ($user && $user->department_id) {
                $assignment->asset->update([
                    'department_id' => $user->department_id
                ]);
            }

            DB::commit();
            return back()->with('success', 'Assignment berhasil diterima.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal memproses persetujuan.']);
        }
    }

    public function reject(int $id)
    {
        $assignment = AssetAssignment::findOrFail($id);

        $assignment->update([
            'status_assignment' => 'ditolak',
            'rejected_at' => now(),
        ]);

        return back()->with('success', 'Assignment telah ditolak.');
    }
}
