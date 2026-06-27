<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AssetAssignment;
use App\Models\Asset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserAssetController extends Controller
{
    public function index()
    {
         $assignments = AssetAssignment::with(
            'asset.category',
            'asset.department'
        )
        ->where('user_id', Auth::id())
        ->where('status_assignment', 'aktif')
        ->latest()
        ->get();

        return view(
            'user.assets.index',
            compact('assignments')
        );
    }

        public function show(int $id)
    {
        
            $asset = Asset::with([
            'category',
            'department',
            'assignments.user', 
            'assignments.assignedBy',
            'maintenances.requestedBy',
            'maintenances.handledBy',
            'disposal',
        ])
        ->whereHas('assignments', function ($query) {

            $query->where(
                'user_id',
                auth()->id()
            )
            ->where(
                'status_assignment',
                'aktif'
            );

        })
        ->findOrFail($id);

        return view(
            'user.assets.show',
            compact('asset')
        );
    }
}
