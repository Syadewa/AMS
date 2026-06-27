<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Department extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_department';

    protected $fillable = [
        'kode_department',
        'nama_department',
        'lokasi',
    ];

    /**
     * Get the users that belong to the department.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'department_id', 'id_department');
    }

    public function assetAssignments()
    {
        return $this->hasMany(AssetAssignment::class, 'department_id', 'id_department');
    }
}
