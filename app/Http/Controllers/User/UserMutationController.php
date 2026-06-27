<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AssetMutation;
use App\Models\AssetAssignment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserMutationController extends Controller
{
    public function index()
    {
        $mutations = AssetMutation::with([
            'asset',
            'fromUser',
            'toUser',
            'fromDepartment',
            'toDepartment'
        ])
        ->where('to_user_id', Auth::id())
        ->latest()
        ->get();

        return view(
            'user.mutations.index',
            compact('mutations')
        );
    }

    public function accept(int $id)
    {
    $mutation = AssetMutation::findOrFail($id);

    /*
    |--------------------------------------------------------------------------
    | Security Check
    |--------------------------------------------------------------------------
    */

    if ($mutation->to_user_id != Auth::id()) {

        abort(403);
    }

    /*
    |--------------------------------------------------------------------------
    | Only Pending Mutation Can Be Accepted
    |--------------------------------------------------------------------------
    */

    if ($mutation->status_mutasi != 'pending') {

        return back()->withErrors([
            'mutation' =>
            'Mutation sudah diproses.'
        ]);
    }

    DB::transaction(function () use ($mutation) {

        /*
        |--------------------------------------------------------------------------
        | Close Old Assignment
        |--------------------------------------------------------------------------
        */

        $oldAssignment = AssetAssignment::where(
            'asset_id',
            $mutation->asset_id
        )
        ->where(
            'status_assignment',
            'aktif'
        )
        ->first();

        if ($oldAssignment) {

            $oldAssignment->update([

                'status_assignment' => 'selesai',

                'tanggal_selesai' => now(),

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Create New Assignment
        |--------------------------------------------------------------------------
        */

        AssetAssignment::create([

            'asset_id' => $mutation->asset_id,

            'user_id' => $mutation->to_user_id,

            'department_id' => $mutation->to_department_id,

            'assigned_by' => $mutation->requested_by,

            'tanggal_assignment' => now(),

            'status_assignment' => 'aktif',

            'accepted_at' => now(),

        ]);

        $asset = $mutation->asset;
            if ($asset) {
                if ($mutation->to_user_id) {
                    // Cari tahu Ari (penerima) itu divisi apa (misal: Accounting)
                    $receiver = \App\Models\User::find($mutation->to_user_id);
                    if ($receiver && $receiver->department_id) {
                        $asset->update([
                            'department_id' => $receiver->department_id
                        ]);
                    }
                } else {
                    $asset->update([
                        'department_id' => $mutation->to_department_id
                    ]);
                }
            }

         /*
        |--------------------------------------------------------------------------
        | Approve Mutation
        |--------------------------------------------------------------------------
        */

        $mutation->update([

            'status_mutasi' => 'disetujui',

            'accepted_at' => now(),

        ]);

        $mutation->load([
            'asset.category',
            'fromUser.department',
            'toUser.department'
        ]);

        $pdf = Pdf::loadView(
            'pdf.mutation-bast',
            [
                'mutation' => $mutation
            ]
        );

        

        $fileName = 
            'mutations/BAST-MTN-'
        . date('Y')
        . '-'
        . str_pad(
            $mutation->id,
            4,
            '0',
            STR_PAD_LEFT
        )
        . '.pdf';

    Storage::disk('public')
        ->put(
            $fileName,
            $pdf->output()
        );

    $mutation->update([

        'dokumen_mutasi' => $fileName,

    ]);


        });

    return back()->with(
        'success',
        'Mutation approved successfully.'
    );
}

    public function reject(int $id)
    {
        $mutation = AssetMutation::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Security Check
        |--------------------------------------------------------------------------
        */

        if ($mutation->to_user_id != Auth::id()) {

            abort(403);

        }

        /*
        |--------------------------------------------------------------------------
        | Only Pending Mutation Can Be Rejected
        |--------------------------------------------------------------------------
        */

        if ($mutation->status_mutasi != 'pending') {

            return back()->withErrors([
                'mutation' => 'Mutation sudah diproses.'
            ]);

        }

        $mutation->update([

            'status_mutasi' => 'ditolak',

            'rejected_at' => now(),

        ]);

        return back()->with(
            'success',
            'Mutation rejected successfully.'
        );
}
}
