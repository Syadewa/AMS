<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Department;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

   
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'must_change_password',
        'department_id',
        'session_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'must_change_password' => 'boolean',
    ];
    /**
     * Get the department that the user belongs to.
     */
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id','id_department');
    }

    public function assetAssignments()
    {
        return $this->hasMany(AssetAssignment::class, 'user_id');
    }

    public function maintenanceRequests()
    {
        return $this->hasMany(AssetMaintenance::class, 'requested_by');
    }

    public function handledMaintenances()
    {
        return $this->hasMany(AssetMaintenance::class, 'handled_by');
    }

    public function disposalRequests()
    {
        return $this->hasMany(AssetDisposal::class, 'requested_by');
    }

    public function approvedDisposals()
    {
        return $this->hasMany(AssetDisposal::class, 'approved_by');
    }

}
