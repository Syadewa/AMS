<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AssetAssignment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserAssignmentController extends Controller
{
    public function index()
    {
        $assignments = AssetAssignment::with('asset')
        ->where('user_id', Auth::id())
        ->latest()
        ->get();

        return view('user.assignments.index', compact('assignments'));
    }

    public function accept(int $id)
{
    $assignment = AssetAssignment::findOrFail($id);

    if ($assignment->user_id !== Auth::id()) {
        abort(403);
    }

    $assignment->update([
        'status_assignment' => 'aktif',
        'accepted_at' => now(),
    ]);

    // Load relasi untuk PDF
    $assignment->load(
        'asset.category',
        'user.department',
        'assignedBy'
    );

    // Generate PDF
    $pdf = Pdf::loadView(
        'pdf.handover-document',
        [
            'assignment' => $assignment
        ]
    );

    // Nama file
    $fileName =
        'handover/BASTA-' .
        date('Y') .
        '-' .
        str_pad(
            $assignment->id,
            4,
            '0',
            STR_PAD_LEFT
        ) .
        '.pdf';

    // Simpan PDF
    Storage::disk('public')->put(
        $fileName,
        $pdf->output()
    );

    // Simpan path
    $assignment->update([
        'handover_document_path' => $fileName
    ]);

    return back()->with(
        'success',
        'Assignment accepted successfully.'
    );
}

    public function reject(int $id)
    {
        $assignment = AssetAssignment::findOrFail($id);

        if ($assignment->user_id !== Auth::id()) {
            abort(403);
        }

        $assignment->update([
            'status_assignment' => 'ditolak',
            'rejected_at' => now(),
        ]);

        return back()->with('success', 'Assignment rejected successfully.');
    }
}
