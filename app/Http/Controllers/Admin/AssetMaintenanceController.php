<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\AssetMaintenance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssetMaintenanceController extends Controller
{
    public function index()
    {
        $maintenances = AssetMaintenance::with(['asset', 'requestedBy', 'handledBy'])
            ->latest()
            ->paginate(10);

        return view('admin.maintenances.index', compact('maintenances'));
    }

    public function show(int $id)
    {
        $maintenance = AssetMaintenance::with(['asset', 'requestedBy', 'handledBy'])
            ->findOrFail($id);

        return view('admin.maintenances.show', compact('maintenance'));
    }

    public function process(int $id)
    {
        $maintenance = AssetMaintenance::findOrFail($id);

        if ($maintenance->status_maintenance != 'pending') {
            return back()->withErrors(['error' => 'Maintenance sudah diproses atau dibatalkan.']);
        }

        DB::beginTransaction();
        try {
            $maintenance->update([
                'status_maintenance' => 'diproses',
                'handled_by' => Auth::id(),
            ]);

            // SINKRONISASI: Pastikan status aset terkunci sebagai 'rusak'
            if ($maintenance->asset) {
                $maintenance->asset->update([
                    'status_asset' => 'rusak'
                ]);
            }

            DB::commit();
            return back()->with('success', 'Maintenance is now in progress and asset status updated.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal memproses perbaikan: ' . $e->getMessage()]);
        }
    }

    public function reject(int $id)
    {
        $maintenance = AssetMaintenance::findOrFail($id);

        if ($maintenance->status_maintenance != 'pending') {
            return back()->withErrors(['error' => 'Maintenance sudah tidak berstatus pending.']);
        }

        // REVISI CRITICAL: Tambah transaksi dan kembalikan status aset induk menjadi aktif
        DB::beginTransaction();
        try {
            $maintenance->update([
                'status_maintenance' => 'ditolak',
                'handled_by' => Auth::id(),
            ]);

            // PEMULIHAN STATUS: Bebaskan kembali aset menjadi 'aktif' karena laporan ditolak admin
            if ($maintenance->asset) {
                $maintenance->asset->update([
                    'status_asset' => 'aktif'
                ]);
            }

            DB::commit();
            return back()->with('success', 'Maintenance request rejected. Asset status restored to active.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal menolak laporan maintenance: ' . $e->getMessage()]);
        }
    }

    public function complete(Request $request, int $id)
    {
        $request->validate([
            'tindakan' => 'required|string',
            'hasil' => 'required|in:sukses,gagal', 
            'notes' => 'nullable|string',
        ]);

        $maintenance = AssetMaintenance::findOrFail($id);

        if ($maintenance->status_maintenance != 'diproses') {
            return back()->withErrors(['error' => 'Hanya maintenance yang sedang diproses yang dapat diselesaikan.']);
        }

        if ($maintenance->handled_by !== Auth::id()) {
            return back()->withErrors(['error' => 'Anda tidak memiliki hak akses untuk menyelesaikan perbaikan ini.']);
        }

        DB::beginTransaction();
        try {
            $maintenance->update([
                'tindakan' => $request->tindakan,
                'hasil' => $request->hasil,
                'notes' => $request->notes,
                'status_maintenance' => 'selesai',
                'tanggal_selesai' => now(),
            ]);

            // SINKRONISASI AKHIR: 'aktif' jika sukses, 'nonaktif' jika gagal (siap untuk disposal)
            $finalAssetStatus = ($request->hasil === 'sukses') ? 'aktif' : 'nonaktif'; 
            
            if ($maintenance->asset) {
                $maintenance->asset->update([
                    'status_asset' => $finalAssetStatus
                ]);

            // PROTEKSI AUTOMATIS: Jika perbaikan gagal (nonaktif), otomatis selesaikan assignment lamanya
            if ($finalAssetStatus === 'nonaktif') {
                \App\Models\AssetAssignment::where('asset_id', $maintenance->asset_id)
                    ->whereIn('status_assignment', ['pending', 'aktif'])
                    ->update([
                        'status_assignment' => 'dilepas', // atau 'selesai' sesuai enum milikmu
                    ]);
    }
            }

            DB::commit();
            return back()->with('success', 'Maintenance completed successfully. Asset status updated to: ' . $finalAssetStatus);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal menyelesaikan perbaikan: ' . $e->getMessage()]);
        }
    }
}