<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Department;
use App\Models\AssetAssignment;
use App\Models\User;
use App\Models\AssetMaintenance;
use App\Models\AssetDisposal;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalAssets = Asset::count();

        $activeAssets = Asset::where('status_asset', 'aktif')->count();

        $disposedAssets = Asset::where('status_asset', 'dilepas')->count();

        $totalDepartments = Department::count();

        $activeAssignments = AssetAssignment::where(
            'status_assignment',
            'aktif'
        )->count();

        $pendingMaintenances = AssetMaintenance::where(
            'status_maintenance',
            'pending'
        )->count();

        $pendingDisposals = AssetDisposal::where(
            'status_approval',
            'pending'
        )->count();

        $activeUsers = User::where(
            'status',
            'aktif'
        )->count();

        return view(
            'admin.dashboard',
            compact('totalAssets', 'activeAssets', 
            'disposedAssets', 
            'totalDepartments', 'activeAssignments', 'pendingMaintenances', 'pendingDisposals', 'activeUsers')
        );

       
    }

    
}
