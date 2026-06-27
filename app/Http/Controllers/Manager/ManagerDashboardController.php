<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\AssetDisposal;
use App\Models\AssetMaintenance;


use Illuminate\Http\Request;

class ManagerDashboardController extends Controller
{
    public function index()
    {
        $totalAssets = Asset::count();

        $maintenanceAssets = AssetMaintenance::whereIn(
            'status_maintenance',
            [
                'pending',
                'diproses'
            ]
        )->count();

        $pendingDisposals = AssetDisposal::where(
            'status_approval',
            'pending'
        )->count();

        $disposedAssets = Asset::where(
            'status_asset',
            'dilepas'
        )->count();

        return view(
            'manager.dashboard',
            compact(
                'totalAssets',
                'maintenanceAssets',
                'pendingDisposals',
                'disposedAssets'
            )
        );
    }
}
