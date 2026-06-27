<?php

namespace App\Http\Controllers\User;

use App\Models\AssetAssignment;
use App\Models\AssetMutation;
use App\Models\AssetMaintenance;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
        public function index()
    {
        $userId = Auth::id();

        $myAssets = AssetAssignment::where(
            'user_id',
            $userId
        )
        ->where(
            'status_assignment',
            'aktif'
        )
        ->count();

        $pendingAssignments = AssetAssignment::where(
            'user_id',
            $userId
        )
        ->where(
            'status_assignment',
            'pending'
        )
        ->count();

        $pendingMutations = AssetMutation::where(
            'to_user_id',
            $userId
        )
        ->where(
            'status_mutasi',
            'pending'
        )
        ->count();

        $maintenanceRequests = AssetMaintenance::where(
            'requested_by',
            $userId
        )->count();

        return view(
            'user.dashboard',
            compact(
                'myAssets',
                'pendingAssignments',
                'pendingMutations',
                'maintenanceRequests'
            )
        );
    }
}
