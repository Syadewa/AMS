<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\AssetMaintenance;
use App\Models\AssetDisposal;
use Illuminate\Http\Request;


class AssetReportController extends Controller
{

    public function index()
    {
        return view('admin.reports.index');
    }


    public function assetReport()
    {
        $assets = Asset::with(
            'category',
            'department'
        )->get();

        $pdf = Pdf::loadView(
            'reports.asset-report',
            compact('assets')
        );

        return $pdf->download(
            'asset-report.pdf'
        );
    }


    public function maintenanceReport()
   {
    $maintenances = AssetMaintenance::with(
        'asset',
        'requestedBy',
        'handledBy'
    )->get();

    $pdf = Pdf::loadView(
        'reports.maintenance-report',
        compact('maintenances')
    );

    return $pdf->download(
        'maintenance-report.pdf'
    );
    }

    public function disposalReport()
    {
        $disposals = AssetDisposal::with(
            'asset',
            'requestedBy',
            'approvedBy'
        )->get();

        $pdf = Pdf::loadView(
            'reports.disposal-report',
            compact('disposals')
        );

        return $pdf->download(
            'disposal-report.pdf'
        );
    }
}
