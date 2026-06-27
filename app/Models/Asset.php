<?php

namespace App\Models;

use App\Models\AssetMutation;
use App\Models\AssetCategory;
use App\Models\Department;
use App\Models\User;    
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_asset',
        'nama_asset',
        'kategori_id',
        'deskripsi',
        'serial_number',
        'tanggal_perolehan',
        'tipe_asset',
        'status_asset',
        'qr_code_path',
        'department_id',
        'created_by',
    ];

    public function category()
    {
        return $this->belongsTo(AssetCategory::class, 'kategori_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id_department');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function assignments()
    {
        return $this->hasMany(AssetAssignment::class);
    }

    public function mutations()
    {
        return $this->hasMany(AssetMutation::class, 'asset_id');
    }

    public function maintenances()
    {
        return $this->hasMany(AssetMaintenance::class, 'asset_id');
    }

    public function disposal()
    {
        return $this->hasOne(AssetDisposal::class, 'asset_id');
    }
}
