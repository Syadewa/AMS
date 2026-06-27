<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\AssetDisposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminAssetDisposalController extends Controller
{
    public function index()
    {
        $disposals = AssetDisposal::with('asset', 'requestedBy', 'approvedBy')
            ->latest()
            ->get();

        return view('admin.disposals.index', compact('disposals'));
    }

    public function create()
    {
        $assets = Asset::where('status_asset', 'nonaktif') 
        // Menggunakan relational check murni tanpa mengecek kolom 'status_disposal' yang gaib
        ->whereDoesntHave('disposal') 
        ->whereDoesntHave('maintenances', function ($query) {
            // Tetap pastikan tidak ada proses maintenance yang sedang berjalan bersamanya
            $query->whereIn('status_maintenance', ['pending', 'diproses']);
        })
        ->get();

    return view('admin.disposals.create', compact('assets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'jenis_pelepasan' => 'required|in:dijual,dihibahkan,dimusnahkan',
            'alasan' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        // Proteksi Race Condition: Validasi ulang kecocokan status aset di database
        $asset = Asset::where('id', $request->asset_id)
            ->where('status_asset', 'aktif')
            ->whereDoesntHave('disposal')
            ->whereDoesntHave('assignments', function ($query) {
                $query->where('status_assignment', 'aktif');
            })
            ->whereDoesntHave('maintenances', function ($query) {
                $query->whereIn('status_maintenance', ['pending', 'diproses']);
            })
            ->first();

        if (!$asset) {
            return back()
                ->withInput()
                ->withErrors(['asset_id' => 'Aset sudah tidak valid, memiliki penugasan aktif, atau sedang dalam pemeliharaan.']);
        }

        DB::beginTransaction();
        try {
            AssetDisposal::create([
                'asset_id' => $request->asset_id,
                'jenis_pelepasan' => $request->jenis_pelepasan,
                'alasan' => $request->alasan,
                'status_approval' => 'pending',
                'requested_by' => Auth::id(),
                'tanggal_pengajuan' => now(),
                'notes' => $request->notes, 
            ]);

            // PENGONDISIAN 1: Kunci sementara ke 'nonaktif' selama menunggu persetujuan manager
            $asset->update([
                'status_asset' => 'nonaktif'
            ]);

            DB::commit();
            return redirect('/admin/disposals')->with('success', 'Disposal request created successfully and asset status locked.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Gagal memproses disposal: ' . $e->getMessage()]);
        }
    }

    public function show(int $id)
    {
        $disposal = AssetDisposal::with('asset', 'requestedBy', 'approvedBy')
            ->findOrFail($id);

        return view('admin.disposals.show', compact('disposal'));
    }

    public function approve(Request $request, int $id)
    {
        $disposal = AssetDisposal::findOrFail($id);

        if ($disposal->status_approval !== 'pending') {
            return back()->withErrors(['error' => 'Pengajuan disposal ini sudah diproses sebelumnya.']);
        }

        DB::beginTransaction();
        try {
            $disposal->update([
                'status_approval' => 'disetujui',
                'approved_by' => Auth::id(),
                'approved_at' => now(),
                'notes' => $request->notes ?? $disposal->notes,
            ]);

            // PENGONDISIAN 2: Ubah status aset ke 'dilepas' karena penghapusan disetujui secara resmi
            if ($disposal->asset) {
                $disposal->asset->update([
                    'status_asset' => 'dilepas'
                ]);
            }

            DB::commit();
            return back()->with('success', 'Disposal request approved successfully and asset status updated to released.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal menyetujui disposal: ' . $e->getMessage()]);
        }
    }

    public function reject(Request $request, int $id)
    {
        $disposal = AssetDisposal::findOrFail($id);

        if ($disposal->status_approval !== 'pending') {
            return back()->withErrors(['error' => 'Pengajuan disposal ini sudah diproses sebelumnya.']);
        }

        DB::beginTransaction();
        try {
            $disposal->update([
                'status_approval' => 'ditolak',
                'approved_by' => Auth::id(),
                'approved_at' => now(),
                'notes' => $request->notes ?? $disposal->notes,
            ]);

            // PENGONDISIAN 3: Pemulihan status kembali menjadi 'aktif' karena pengajuan ditolak
            if ($disposal->asset) {
                $disposal->asset->update([
                    'status_asset' => 'aktif'
                ]);
            }

            DB::commit();
            return back()->with('success', 'Disposal request rejected. Asset status restored to active.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal menolak disposal: ' . $e->getMessage()]);
        }
    }
}