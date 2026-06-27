<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetMaintenance extends Model
{
    use HasFactory;

    protected $fillable = [

    'asset_id',

    'requested_by',

    'handled_by',

    'keluhan',

    'tindakan',

    'hasil',

    'status_maintenance',

    'tanggal_pengajuan',

    'tanggal_selesai',

    'notes',

];

    public function asset()
    {
    return $this->belongsTo(
        Asset::class,
        'asset_id'
    );
    }

    public function requestedBy()
    {
        return $this->belongsTo(
            User::class,
            'requested_by'
        );
    }

    public function handledBy()
    {
        return $this->belongsTo(
            User::class,
            'handled_by'
        );
    }   
}
