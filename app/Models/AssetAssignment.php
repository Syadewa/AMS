<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_id',
        'user_id',
        'department_id',
        'assigned_by',
        'tanggal_assignment',
        'tanggal_selesai',
        'status_assignment',
        'accepted_at',
        'rejected_at',
        'handover_document_path',
        'notes',
    ];

    protected $casts = [

    'tanggal_assignment' => 'datetime',
    'tanggal_selesai' => 'datetime',
    'accepted_at' => 'datetime',
    'rejected_at' => 'datetime',

    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id_department');
    }

    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    public function getFormattedAssignmentDateAttribute()
{
    return $this->tanggal_assignment?->format('d M Y');
}

    public function getFormattedCompletedDateAttribute()
    {
        return $this->tanggal_selesai?->format('d M Y');
    }

    public function getFormattedAcceptedDateAttribute()
    {
        return $this->accepted_at?->format('d M Y');
    }

    public function getFormattedRejectedDateAttribute()
    {
        return $this->rejected_at?->format('d M Y');
    }

}
