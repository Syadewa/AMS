<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\AssetDisposal;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ManagerAssetDisposalController extends Controller
{
    public function index()
    {
        $disposals = AssetDisposal::with('asset',
            'requestedBy', 'approvedBy')
            ->latest()
            ->get();

        return view('manager.disposals.index', compact('disposals'));
    }

    public function show(int $id)
    {
        $disposal = AssetDisposal::with('asset', 'requestedBy', 'approvedBy')
            ->findOrFail($id);

        return view('manager.disposals.show', compact('disposal'));
    }

    public function approve(int $id)
    {
        $disposal = AssetDisposal::with(
            'asset',
            'requestedBy',
        )->findOrFail($id);

        if ($disposal->status_approval !== 'pending') {
            return back()->withErrors(['disposal' => 'Disposal sudah diproses.']);
        }

        $disposal->update([
            'status_approval' => 'disetujui',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        $disposal->load(
            'asset',
            'requestedBy',
            'approvedBy'
        );

         // Generate PDF
         $pdf = Pdf::loadView('pdf.disposal-ba', ['disposal' => $disposal]);

         $fileName = 'disposals/BA-DSL-' . date('Y') . '-' . str_pad($disposal->id, 4, '0', STR_PAD_LEFT) . '.pdf';

         Storage::disk('public')->put($fileName, $pdf->output());

         $disposal->update([
             'berita_acara_path' => $fileName
         ]);

         $disposal->asset->update([
             'status_asset' => 'dilepas'
         ]);


        return back()
            ->with('success', 'Disposal approved successfully.');
    }

    public function reject(int $id)
    {
        $disposal = AssetDisposal::findOrFail($id);

        if ($disposal->status_approval !== 'pending') {
            return back()->withErrors(['disposal' => 'Disposal sudah diproses.']);
        }

        $disposal->update([
            'status_approval' => 'ditolak',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        return back()
            ->with('success', 'Disposal rejected successfully.');
    }
}
