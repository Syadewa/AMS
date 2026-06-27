<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetMutation extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_id',

        'from_user_id',
        'from_department_id',

        'to_user_id',
        'to_department_id',

        'requested_by',

        'tanggal_mutasi',

        'status_mutasi',

        'accepted_at',
        'rejected_at',

        'dokumen_mutasi',

        'notes',
    ];

    /*
    |--------------------------------------------------------------------------
    | Asset
    |--------------------------------------------------------------------------
    */

    public function asset()
    {
        return $this->belongsTo(
            Asset::class,
            'asset_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | From User
    |--------------------------------------------------------------------------
    */

    public function fromUser()
    {
        return $this->belongsTo(
            User::class,
            'from_user_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | To User
    |--------------------------------------------------------------------------
    */

    public function toUser()
    {
        return $this->belongsTo(
            User::class,
            'to_user_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | From Department
    |--------------------------------------------------------------------------
    */

    public function fromDepartment()
    {
        return $this->belongsTo(
            Department::class,
            'from_department_id',
            'id_department'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | To Department
    |--------------------------------------------------------------------------
    */

    public function toDepartment()
    {
        return $this->belongsTo(
            Department::class,
            'to_department_id',
            'id_department'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Requested By
    |--------------------------------------------------------------------------
    */

    public function requestedBy()
    {
        return $this->belongsTo(
            User::class,
            'requested_by'
        );
    }
}
