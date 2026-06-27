<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AssetAssignment;
use App\Models\AssetMaintenance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserMaintenanceController extends Controller
{
    public function index()
{
    $maintenances = AssetMaintenance::with('asset')

        ->where(
            'requested_by',
            Auth::id()
        )

        ->latest()

        ->get();

    return view(
        'user.maintenances.index',
        compact('maintenances')
    );
}

    public function create()
    {
        $assignments = AssetAssignment::with([
        'asset'
    ])

    ->whereHas('asset', function ($query) {

        $query->whereIn(
            'status_asset',
            [
                'aktif',
                'nonaktif',
                'rusak'
            ]
        );

    })

            ->where('status_assignment', 'aktif')

            ->where(function ($query) {

                $query->where(
                    'user_id',
                    Auth::id()
                )

                ->orWhere(
                    'department_id',
                    Auth::user()->department_id
                );

            })

            ->get();

        return view(
            'user.maintenances.create',
            compact('assignments')
        );
    }

    public function store(Request $request)
    {
    $request->validate([

        'asset_id' => 'required|exists:assets,id',

        'keluhan' => 'required|string',

    ]);

    /*
    |--------------------------------------------------------------------------
    | Security Check
    |--------------------------------------------------------------------------
    | User hanya boleh membuat maintenance untuk:
    | - Asset individual miliknya
    | - Asset shared milik departmentnya
    */

    $assignment = AssetAssignment::where('asset_id', $request->asset_id)

        ->where('status_assignment', 'aktif')

        ->where(function ($query) {

            $query->where(
                'user_id',
                Auth::id()
            )

            ->orWhere(
                'department_id',
                Auth::user()->department_id
            );

        })

        ->first();

    if (!$assignment) {

        abort(403);

    }

    $asset = $assignment->asset;

            if ($asset->status_asset === 'dilepas') {

            return back()

                ->withInput()

                ->withErrors([

                    'asset_id' =>
                        'Asset yang sudah dilepas tidak dapat diajukan maintenance.'

                ]);

        }

    /*
    |--------------------------------------------------------------------------
    | Prevent Duplicate Active Maintenance
    |--------------------------------------------------------------------------
    */

    $existingMaintenance = AssetMaintenance::where(
            'asset_id',
            $request->asset_id
        )

        ->whereIn(
            'status_maintenance',
            [
                'pending',
                'diproses',
            ]
        )

        ->exists();

    if ($existingMaintenance) {

        return back()

            ->withInput()

            ->withErrors([

                'asset_id' =>
                    'Asset sedang memiliki maintenance aktif.',

            ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Create Maintenance Request
    |--------------------------------------------------------------------------
    */

    AssetMaintenance::create([

        'asset_id' =>
            $request->asset_id,

        'requested_by' =>
            Auth::id(),

        'keluhan' =>
            $request->keluhan,

        'status_maintenance' =>
            'pending',

        'tanggal_pengajuan' =>
            now(),

    ]);

    return redirect('/user/maintenances')

        ->with(
            'success',
            'Maintenance request submitted successfully.'
        );
    }

    public function show(int $id)
    {
    $maintenance = AssetMaintenance::with([
        'asset.category',
        'asset.department',
        'requestedBy',
        'handledBy',
    ])
    ->where(
        'requested_by',
        Auth::id()
    )
    ->findOrFail($id);

    return view(
        'user.maintenances.show',
        compact('maintenance')
    );
    }
}
